<?php

namespace backend\models;

#Created by  Nguyen Quoc Khanh
#Created on Dec 13, 2017, 9:36:58 PM
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
class Register extends RegisterBase {

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
                ,'chest','waist','butt','facebook', 'product','star'], 'required'],            
            [['genre', 'msisdn', 'weight','height', 'chest', 'waist','butt'], 'integer'],
            [['blacklist_note'],'string']
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Tên',
            'casting_id' => 'Vai diễn',
            'genre' => 'Giới tính',
            'birth_year' => 'Năm sinh',
            'msisdn' => 'Số điện thoại',
            'location' => 'Nơi ở',
            'outfit' => 'Vẻ ngoài',
            'height' => 'Chiều cao(cm)',
            'weight' => 'Cân nặng(kg)',
            'chest' => 'Vòng một(cm)',
            'waist' => 'Vòng hai(cm)',
            'butt' => 'Vòng ba(cm)',
            'portrait' => 'Chân dung',
            'portrait_2' => 'Chân dung',
            'portrait_3' => 'Chân dung',
            'facebook' => 'Facebook',
            'product' => 'Sản phẩm',
            'star' => 'Đánh giá',
            'created_time' => 'Thời gian đăng ký',
            'status' => 'Trạng thái kích hoạt',
            'sodo' => 'Số đo ba vòng(cm)',
            'blacklist_note' => 'Nhận xét'
        ];
    }

    public function getCastingName() {
        $casting = Casting::findOne($this->casting_id);
        if ($casting)
            return $casting->name;
        else
            return "Không rõ";
    }

    public function getAllCasting() {
        $casting = Casting::find()->where(['status' => 1])->all();
        $rs = array();
        foreach ($casting as $cas) {
            $rs[$cas->id] = $cas->name;
        }
        return $rs;
    }

    public function getGenreName() {
        switch ($this->genre) {
            case 1: return "Nam";
            case 2: return "Nữ";
            default: return "Không rõ";
        }
    }

    public function getSodo() {
        return $this->chest . "-" . $this->waist . "-" . $this->butt;
    }
    
    public function upload() {
        $structure = 'register';
        $struc_path = Yii::getAlias('@webroot') . '/' . Yii::$app->params['upload_dir'][$structure];

        if ($this->isNewRecord) {
            if (!is_dir($structure)) {
                FileHelper::createDirectory($struc_path);
            }
            $imagepath = Images::uploadFile($this, 'outfit', $structure);
            if ($imagepath['errorCode'] == 0) {
                // file is uploaded successfully
                $this->image_path = $imagepath['file'];
                return true;
            }
            return false;
        } else {
            if ($_FILES["Register"]["name"]["outfit"] == null) {
                unset($this->image_path);
                return true;
            } else {
                if (!is_dir($structure)) {
                    FileHelper::createDirectory($struc_path);
                }
                $imagepath = Images::uploadFile($this, 'outfit', $structure);

                if ($imagepath['errorCode'] == 0) {
                    // file is uploaded successfully
                    $this->image_path = $imagepath['file'];
                    return true;
                }
                return false;
            }
        }
    }
    
    public function uploadPortrait($attr) {
        $structure = 'register';
        $struc_path = Yii::getAlias('@webroot') . '/' . Yii::$app->params['upload_dir'][$structure];

        if ($this->isNewRecord) {
            if (!is_dir($structure)) {
                FileHelper::createDirectory($struc_path);
            }
            $imagepath = Images::uploadFile($this, $attr, $structure);
            if ($imagepath['errorCode'] == 0) {
                // file is uploaded successfully
                $this->$attr = $imagepath['file'];
                return true;
            }
            return false;
        } else {
            if ($_FILES["Register"]["name"][$attr] == null) {
                unset($this->$attr);
                return true;
            } else {
                if (!is_dir($structure)) {
                    FileHelper::createDirectory($struc_path);
                }
                $imagepath = Images::uploadFile($this, $attr, $structure);

                if ($imagepath['errorCode'] == 0) {
                    // file is uploaded successfully
                    $this->$attr = $imagepath['file'];
                    return true;
                }
                return false;
            }
        }
    }

}
