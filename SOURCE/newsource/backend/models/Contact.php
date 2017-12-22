<?php
namespace backend\models;
#Created by  Nguyen Quoc Khanh
#Created on Dec 15, 2017, 10:58:18 PM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.
use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use common\models\ContactBase;
/**
 * Description of Contact
 *
 * @author Nguyen Quoc Khanh
 */
class Contact extends ContactBase{
    //put your code here
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_time'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    
    public function attributeLabels() {
        return [
            'name' => 'Tên',
            'msisdn' => 'Số điện thoại',
            'content' => 'Nội dung',
            
        ];
    }
}
