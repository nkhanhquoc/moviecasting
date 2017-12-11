<?php

namespace backend\models;

use common\libs\Images;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\FileHelper;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author khanhnq16
 */
class Product extends \common\models\ProductBase {

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

    public function rules() {
        return [
            [['END_TIME', 'SHOT_DESCRIPTION', 'MAIN_PRICE', 'PRICE', 'CODE', 'DAY_RETRY', 'NO_MIN_REG', 'ADD_DAY', 'NAME', 'INVITE_CONTENT', 'IS_RENEW', 'PERIOD', 'VAS_SERVICE_ID'], 'required'],
            [['ADD_DAY', 'STATUS', 'NO_MIN_REG', 'SERVICE_ID', 'TYPE', 'IS_RENEW', 'CURRENT_REG', 'DAY_RETRY', 'VAS_SERVICE_ID'], 'integer'],
            [['END_TIME', 'CREATED_TIME', 'UPDATED_TIME'], 'safe'],
            [['NAME', 'SHOT_DESCRIPTION', 'BANNER_PATH', 'INVITE_CONTENT', 'CATEGORY'], 'string', 'max' => 255],
            [['CODE'], 'string', 'max' => 50],
            [['PRICE', 'MAIN_PRICE'], 'string', 'max' => 7],
            [['DESCRIPTION'], 'string', 'max' => 1000],
            [['PERIOD'], 'string', 'max' => 20],
            [['IMAGE_PATH'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,jpeg', 'mimeTypes' => 'image/jpg, image/png,image/jpeg', 'maxSize' => 1024 * 1024, 'message' => 'Dữ liệu không đúng định dạng'],
        ];
    }

    public function upload() {
        $structure = 'product';

//        if ($this->validate()) {
        $struc_path = Yii::getAlias('@webroot') . '/' . Yii::$app->params['upload_dir'][$structure];

        if ($this->isNewRecord) {
            if (!is_dir($structure)) {
                FileHelper::createDirectory($struc_path);
            }
            $imagepath = Images::uploadFile($this, 'IMAGE_PATH', $structure);
            if ($imagepath['errorCode'] == 0) {
                // file is uploaded successfully
                $this->IMAGE_PATH = $imagepath['file'];
                return true;
            }
            return false;
        } else {
            if ($_FILES["Product"]["name"]["IMAGE_PATH"] == null) {
                unset($this->IMAGE_PATH);
                return true;
            } else {
                if (!is_dir($structure)) {
                    FileHelper::createDirectory($struc_path);
                }
                $imagepath = Images::uploadFile($this, 'IMAGE_PATH', $structure);

                if ($imagepath['errorCode'] == 0) {
                    // file is uploaded successfully
                    $this->IMAGE_PATH = $imagepath['file'];
                    return true;
                }
                return false;
            }
        }
    }
    
    
    public function uploadBanner() {
        $structure = 'product';

//        if ($this->validate()) {
        $struc_path = Yii::getAlias('@webroot') . '/' . Yii::$app->params['upload_dir'][$structure];

        if ($this->isNewRecord) {
            if (!is_dir($structure)) {
                FileHelper::createDirectory($struc_path);
            }
            $imagepath = Images::uploadFile($this, 'BANNER_PATH', $structure);
            if ($imagepath['errorCode'] == 0) {
                // file is uploaded successfully
                $this->BANNER_PATH = $imagepath['file'];
                return true;
            }
            return false;
        } else {
            if ($_FILES["Product"]["name"]["BANNER_PATH"] == null) {
                unset($this->BANNER_PATH);
                return true;
            } else {
                if (!is_dir($structure)) {
                    FileHelper::createDirectory($struc_path);
                }
                $imagepath = Images::uploadFile($this, 'BANNER_PATH', $structure);

                if ($imagepath['errorCode'] == 0) {
                    // file is uploaded successfully
                    $this->BANNER_PATH = $imagepath['file'];
                    return true;
                }
                return false;
            }
        }
    }

    public function getVasService() {
        $query = VasService::find()->all();
        $list = [];
        if ($query) {
            foreach ($query as $vasService) {
                $list[$vasService->ID] = $vasService->NAME;
            }
        }
        return $list;
    }

    public function getCategory() {
        $listCat = explode("|", $this->CATEGORY);
        if (sizeof($listCat) < 1) {
            return array();
        }
        $query = Category::find()->where(['CODE' => $listCat])->all();
        $list = [];
        if ($query) {
            foreach ($query as $vasService) {
                $list[$vasService->CODE] = $vasService->NAME;
            }
        }
        return $list;
    }

    public function updateCategory() {

        $cateList = implode("|", $this->CATEGORY);
        $this->CATEGORY = $cateList;
    }

    public static function getByCode($code) {
        $query = Product::find()->where(['CODE' => $code])->one();
        return $query;
    }
    
    public static function getAllProduct(){
        $query = Product::find()->asArray()->all();
        $list = array();
        if(sizeof($query) > 0){
            foreach($query as $item){
                $list[$item['CODE']] = $item['NAME'];                
            }            
        }
        return $list;
    }
    
    public static function getAllProductByID(){
        $query = Product::find()->asArray()->all();
        $list = array();
        if(sizeof($query) > 0){
            foreach($query as $item){
                $list[$item['ID']] = $item['NAME'];                
            }            
        }
        return $list;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ID' => Yii::t('backend', 'ID'),
            'NAME' => Yii::t('backend', 'Tên Sản phẩm'),
            'PRICE' => Yii::t('backend', 'Giá'),
            'CREATED_TIME' => Yii::t('backend', 'Created At'),
            'UPDATED_TIME' => Yii::t('backend', 'Updated At'),
            'MAIN_PRICE' => Yii::t('backend', 'Giá Gốc'),
            'SHOT_DESCRIPTION' => Yii::t('backend', 'Mô tả ngắn'),
            'DESCRIPTION' => Yii::t('backend', 'Mô tả chi tiết'),
            'IMAGE_PATH' => Yii::t('backend', 'Ảnh đại diện'),
            'BANNER_PATH' => Yii::t('backend', 'Ảnh banner'),
            'STATUS' => Yii::t('backend', 'Trạng thái'),
            'NO_MIN_REG' => Yii::t('backend', 'Số đăng ký tối thiểu'),
            'END_TIME' => Yii::t('backend', 'Thời gian kết thúc'),
            'SERVICE_ID' => Yii::t('backend', 'Link đăng ký'),
            'TYPE' => Yii::t('backend', 'Loại sản phẩm'),
            'INVITE_CONTENT' => Yii::t('backend', 'Tin nhắn mời sử dụng'),
            'IS_RENEW' => Yii::t('backend', 'Gia hạn'),
            'PERIOD' => Yii::t('backend', 'chu kì Sản phẩm'),
            'DAY_RETRY' => Yii::t('backend', 'số retry'),
            'VAS_SERVICE_ID' => Yii::t('backend', 'Dịch vụ'),
            'CATEGORY' => Yii::t('backend', 'Thể loại'),
            'IS_HOT' => Yii::t('backend', 'HOT'),
            'USE_GUIDELINE' => Yii::t('backend', 'Hươn'),
        ];
    }

}
