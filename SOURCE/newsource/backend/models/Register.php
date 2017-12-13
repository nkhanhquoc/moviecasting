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
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_time'],
                ],
                'value' => new Expression('NOW()'),
            ],
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
            'height' => 'Chiều cao',
            'weight' => 'Cân nặng',
            'chest' => 'Vòng ngực',
            'waist' => 'Vòng eo',
            'butt' => 'Vòng 3',
            'portrait' => 'Chân dung',
            'facebook' => 'Facebook',
            'product' => 'Sản phẩm',
            'facebook' => 'Facebook',
            'star' => 'Đánh giá',
            'created_time' => 'Thời gian đăng ký',
            'status' => 'Active',
            'sodo'=>"Số đo"
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

}
