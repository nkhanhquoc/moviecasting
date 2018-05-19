<?php

namespace backend\models;

#Created by  Nguyen Quoc Khanh
#Created on Dec 11, 2017, 4:44:50 PM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.

use Yii;
use common\models\MovieBase;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\FileHelper;
use common\libs\Images;
use yii\behaviors\SluggableBehavior;

/**
 * Description of Movie
 *
 * @author Nguyen Quoc Khanh
 */
class Movie extends MovieBase {

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
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
//                'immutable' => true,
                'ensureUnique'=>true,
            ],
        ];
    }
    
    public function upload() {
        $structure = 'movie';

//        if ($this->validate()) {
        $struc_path = Yii::getAlias('@webroot') . '/' . Yii::$app->params['upload_dir'][$structure];

        if ($this->isNewRecord) {
            if (!is_dir($structure)) {
                FileHelper::createDirectory($struc_path);
            }
            $imagepath = Images::uploadFile($this, 'image_path', $structure);
            if ($imagepath['errorCode'] == 0) {
                // file is uploaded successfully
                $this->image_path = $imagepath['file'];
                return true;
            }
            return false;
        } else {
            if ($_FILES["Movie"]["name"]["image_path"] == null) {
                unset($this->image_path);
                return true;
            } else {
                if (!is_dir($structure)) {
                    FileHelper::createDirectory($struc_path);
                }
                $imagepath = Images::uploadFile($this, 'image_path', $structure);

                if ($imagepath['errorCode'] == 0) {
                    // file is uploaded successfully
                    $this->image_path = $imagepath['file'];
                    return true;
                }
                return false;
            }
        }
    }

    public function attributeLabels() {
        return [
            'name' => 'Tên Dự án',
            'type' => 'Loại',
            'short_description' => 'Mô tả ngắn',
            'description' => 'Mô tả',
            'image_path' => 'Ảnh',
            'status' => 'Trạng thái',
            'created_time' => 'Thời gian tạo',
            'end_time' => 'Thời gian kết thúc',
        ];
    }

}
