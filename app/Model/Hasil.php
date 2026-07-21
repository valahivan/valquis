<?php
namespace ValahIvanMaulana\App\Model;

use ValahIvanMaulana\Core\Model;

class Hasil extends Model {
    protected $table = "val_hasil" ;

    public function filter($query, $group_id, $setquis_id) {
        $query->select(['val_hasil.*', 'val_setquis.nama AS nama_quis', 'val_group.nama AS nama_group', 'val_users.nama AS nama_user'])
            ->innerJoin(['val_setquis ON val_hasil.setquis_id = val_setquis.id_setquis'])
            ->innerJoin(['val_group ON val_hasil.group_id = val_group.id_group'])
            ->innerJoin(['val_users ON val_hasil.user_id = val_users.id_user'])
            ->orderBy('val_users.nama', 'ASC');
        
        if ($group_id != '') {
            $query->where('val_hasil.group_id', '=', $group_id);
        }

        if ($setquis_id != '') {
            $query->where('val_hasil.setquis_id', '=', $setquis_id);
        }

        return $query;
    }
}