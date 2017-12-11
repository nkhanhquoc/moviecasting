<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace api\modules\v1\models;
use common\models\GrouponMtHisBase;
use yii\db\ActiveRecord;
use yii\db\Expression;
/**
 * Description of GrouponMtHis
 *
 * @author khanhnq16
 */
class GrouponMtHis extends GrouponMtHisBase{
    //put your code here
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['CREATED_TIME', 'SENT_TIME']
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
