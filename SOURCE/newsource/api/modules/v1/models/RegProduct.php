<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace api\modules\v1\models;

use common\models\RegProductBase;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Description of RegProduct
 *
 * @author khanhnq16
 */
class RegProduct extends RegProductBase {

    //put your code here
    //put your code here
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['CREATED_TIME', 'UPDATED_TIME'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['UPDATED_TIME'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function getReg($msisdn, $productId, $type) {
        $query = RegProduct::find()->where(['MSISDN' => $msisdn, 'PRODUCT_ID' => $productId, 'STATUS' => array(1,4)]);
        
        if ($type != '1') {            
            $query->asArray();
        }
        return $query->one();
    }

    public static function getListActiveReg($msisdn, $page, $limit) {
        $query = RegProduct::find()->where(['MSISDN' => $msisdn, 'STATUS' => array(1,4)]);
//                        ->limit($limit)
//                        ->offset(($page - 1) * $limit)
//                        ->asArray()->all();
        return $query;
    }

    public static function getListRegistered($msisdn) {
        $query = RegProduct::find()->where(['MSISDN' => $msisdn])
                        ->andWhere(['not in', 'STATUS', array(1, 4)]);
//                        ->limit($limit)
//                        ->offset(($page - 1) * $limit)
//                        ->asArray()->all();
        return $query;
    }

}
