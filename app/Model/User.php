<?php 

namespace ValahIvanMaulana\App\Model;

use ValahIvanMaulana\Core\Model;

class User extends Model {
    protected $table = "val_users";

    public function filter($query, $group_id) {
        $query->select(['val_users.*', 'val_group.nama AS nama_group'])
              ->innerJoin(['val_group ON val_users.group_id = val_group.id_group']);
        if ($group_id != '') {
            $query->where('val_users.group_id', '=', $group_id);
        }

        return $query;
    }
}