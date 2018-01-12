<?php
namespace frontend\models;
#Created by  Nguyen Quoc Khanh
#Created on Dec 25, 2017, 3:20:31 PM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.
use Yii;
use common\models\RegisterBase;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\FileHelper;
use common\libs\Images;
/**
 * Description of Register
 *
 * @author Nguyen Quoc Khanh
 */
class Register extends RegisterBase{
    //put your code here
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
            [['name','casting_id','genre','birth_year','msisdn','location','weight','height'
                ,'chest','waist','butt','facebook', 'product'], 'required'],            
            [['genre', 'msisdn', 'weight','height', 'chest', 'waist','butt'], 'integer']           
        ];
    }
    
    public function uploadImage($attr) {
        $structure = 'register';
        $struc_path = Yii::getAlias('@webroot') . '/' . Yii::$app->params['upload_dir'][$structure];

        if ($this->isNewRecord) {
            if (!is_dir($structure)) {
                FileHelper::createDirectory($struc_path);
            }
            $imagepath = Images::uploadFile($this, $attr, $structure);
            if ($imagepath['errorCode'] == 0) {
                // file is uploaded successfully
                $this->$attr = $imagepath['fileFronted'];
                return true;
            }  
            return false;
        } 
    }
}
