<?php 
namespace ValahIvanMaulana\Core;

use ValahIvanMaulana\Core\Database;
include_once 'config.php';

abstract class Model {
    protected $connect;
    protected $table;
    private $where = [];
    private $group;
    private $order;
    private $select;
    private $join;
    private string $sql = "SELECT * FROM ";
    
    public function __construct() {
        $db = new Database(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $connect = $db->connectToDb();
        return $this->connect = $connect;
    }

    public function where($column, $operator, $value) {
        $this->where[] = "$column $operator " . "'" .mysqli_escape_string($this->connect, $value). "'";
        return $this;
    }

    public function groupBy($column) {
        $this->group = " GROUP BY $column";
        return $this;
    }

    public function orderBy($column, $order) {
        $this->order = " ORDER BY $column $order";
        return $this;
    }

    public function select(array $selectTables = []) {
        $this->select.= implode(",", $selectTables);
        return $this;
    }

    public function innerJoin(array $join_query) {
        $this->join .= " INNER JOIN " . implode(" AND ", $join_query);
        return $this;
    }

    public function leftJoin(array $join_query) {
        $this->join .= " LEFT JOIN " . implode(" AND ", $join_query);
        return $this;
    }

    public function get() {
        $this->sql = !empty($this->join) ? str_replace('*', $this->select, $this->sql) .$this->table. $this->join : "SELECT * FROM {$this->table}";
        $this->sql .= !empty($this->where) ? " WHERE ". implode(" AND ", $this->where) : "";
        $this->sql .= $this->group;
        $this->sql .= $this->order;

        return mysqli_query($this->connect, $this->sql);
    }

    public function pluck(string $column) {
        $this->sql = "SELECT * FROM {$this->table}";
        $this->sql .= !empty($this->where) ? " WHERE ". implode(" AND ", $this->where) : "";
        $this->sql .= $this->group;
        $this->sql .= $this->order;

        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        return $row[$column];
    }

    public function findOrFails(string $col, string $id) {
        $this->sql .= "{$this->table } WHERE  $col = '$id'";
        $result = mysqli_query($this->connect, $this->sql);
        return mysqli_fetch_assoc($result);
    }

    public function insertData(array $requests) {
        $setKeys = [];
        $setValues = [];
        foreach ($requests as $key => $value) {
            $setKeys[] = $key;
            $keys = implode(',', $setKeys);
            $setValues[] = "'".mysqli_escape_string($this->connect, $value)."'";
            $values = implode(',', $setValues);
            $this->sql = "INSERT INTO {$this->table} ($keys) VALUES($values)";
        }
        return mysqli_query($this->connect, $this->sql);
    }

    public function creates(array $requests) {
        $values = [];
        $columns = array_keys($requests);

        $row_counts = count($requests[$columns[0]]);
        for ($i= 0; $i < $row_counts; $i++) {
           $row_values = [];
           foreach ($columns as $k) {
                $row_values[] = "'".mysqli_escape_string($this->connect, $requests[$k][$i])."'";
           }
           $values[] = "(".implode(",", $row_values).")";
        }

        $columns = "(".implode(",", $columns).")";
        $value_list = implode(",", $values);

        $this->sql = "INSERT INTO {$this->table} $columns VALUES $value_list";
        return mysqli_query($this->connect, $this->sql);
    }

    public function updateData(array $requests) {
        $setKeyValues = [];

        foreach ($requests as $key => $value) {
            $setKeyValues[] = "$key = " ."'".mysqli_escape_string($this->connect, $value)."'";
            $keyValues = implode(',', $setKeyValues);
        }

        $this->sql = !empty($this->where) ? "UPDATE {$this->table} SET $keyValues WHERE " . implode(" AND ", $this->where) : "UPDATE {$this->table} SET $keyValues";

        return mysqli_query($this->connect, $this->sql);
    }

    public function deleteData() {
        $this->sql = !empty($this->where) ? "DELETE FROM {$this->table} WHERE " . implode(" OR ", $this->where) : "DELETE FROM {$this->table}";

        return mysqli_query($this->connect, $this->sql);
    }

    public function destroys($col, array $ids) {
        $colVals = [];
        $whereString = "";

        foreach ($ids as $id) {
            $colVals[] = "$col = '$id'";
            $whereString = implode(" OR ", $colVals);
        }
        $this->sql = "DELETE FROM {$this->table} WHERE $whereString";

        return mysqli_query($this->connect, $this->sql);
    }

    public function numRows($query) {
        return mysqli_num_rows($query);
    }

    public function fetchAssoc($result) {
        return mysqli_fetch_assoc($result);
    }
}