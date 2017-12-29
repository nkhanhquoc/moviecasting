<?php
namespace frontend\models;
#Created by  Nguyen Quoc Khanh
#Created on Dec 30, 2017, 2:43:22 AM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.
use Yii;
use common\models\ContactBase;
use yii\db\ActiveRecord;
use yii\db\Expression;
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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_time', 'updated_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_time'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name','msisdn','content'], 'required'],            
        ];
    }
    
}
