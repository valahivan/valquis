<?php

namespace ValahIvanMaulana\App\Model;

use ValahIvanMaulana\Core\Model;

class SetQuis extends Model {
    protected $table = "val_setquis";

    public function filters($query, $keyword, $group, $id_user) {
        $query->select(['val_setquis.*', 'val_hasil.status AS status', 'val_hasil.nilai AS nilai'])
        ->leftJoin(['val_hasil ON val_setquis.id_setquis = val_hasil.setquis_id', "val_hasil.user_id = $id_user"])
        ->where('val_setquis.groups', 'LIKE', "%$group%")
        ->groupBy('val_setquis.id_setquis');
        if (isset($keyword) && $keyword !='') {
            $query->where('val_setquis.nama', 'LIKE', "%$keyword%");
        }
        return $query;
    }
}

?>