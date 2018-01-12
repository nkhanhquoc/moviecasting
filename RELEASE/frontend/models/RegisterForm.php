<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
#Created by  Nguyen Quoc Khanh
#Created on Dec 26, 2017, 4:02:01 PM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.

/**
 * Description of RegisterForm
 *
 * @author Nguyen Quoc Khanh
 */
class RegisterForm extends Model {
    //put your code here
    public $castingid;
    public $name;
    public $genre;
    public $birthYear;
    public $msisdn;
    public $location;
    public $outfit;
    public $height;
    public $weight;
    public $chest;
    public $waist;
    public $butt;
    public $portrait;
    public $facebook;
    public $product;
    public $star;
    public $status;
    public $captcha;
    
     /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // username and password are both required
            [['castingid', 'name','genre','birthYear', 'msisdn','location'
                ,'outfit','height','weight','chest','waist','butt','portrait',
                'facebook','captcha'], 'required'],
            [['name', 'msisdn', 'location','outfit', 'height', 'weight',
                'chest', 'waist', 'butt','portrait', 'facebook', 'captcha'], 'trim'],
            ['captcha', 'captcha'],
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
            'chest' => 'Vòng một',
            'waist' => 'Vòng hai',
            'butt' => 'Vòng ba',
            'portrait' => 'Chân dung',
            'facebook' => 'Facebook',
            'product' => 'Sản phẩm',
            'star' => 'Đánh giá',
            'created_time' => 'Thời gian đăng ký',
            'status' => 'Trạng thái kích hoạt',
            'sodo' => 'Số đo ba vòng'
        ];
    }
}
