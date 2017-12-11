<?php

namespace api\modules\v1\models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use common\models\GrouponBiBase;
use Yii;

/**
 * Description of GrouponBi
 *
 * @author khanhnq16
 */
class GrouponBi extends GrouponBiBase {

    //put your code here
    public static function getArrBi($msisdn) {
        $arrCat = array();
        $query = GrouponBi::find()->where(['msisdn' => $msisdn])->one();
        if ($query && $query->bi) {
            $objBi = json_decode($query->bi, true);
            foreach ($objBi as $k => $v) {
                foreach ($v as $k1 => $v1) {
                    $a = explode(",",$v1);
                    $arrCat = array_merge($arrCat,$a);
                }
            }
        }
        return $arrCat;
    }

}
