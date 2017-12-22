<?php

namespace frontend\models;

use Yii;

class VtLogAction extends \common\models\VtLogActionBase {

    public static function insertLog($subid, $phonenumber, $url, $type = 0, $action = 0) {
        $log = new VtLogAction();
        $log->subs_id = $subid;
        $log->phonenumber = $phonenumber;
        $log->url = $url;
        if ($action) {
            $log->action = $action;
        }
        if ($type) {
            $log->type = $type;
        }
        try{
            $log->save(false);
        }catch(\yii\db\Exception $e){
            Yii::error("error on insert action log ".$e->getMessage());
        }
    }

}
