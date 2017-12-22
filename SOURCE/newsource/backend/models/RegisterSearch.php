<?php
namespace backend\models;
#Created by  Nguyen Quoc Khanh
#Created on Dec 13, 2017, 9:42:51 PM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.
use Yii;
use yii\data\ActiveDataProvider;
/**
 * Description of RegisterSearch
 *
 * @author Nguyen Quoc Khanh
 */
class RegisterSearch extends Register{
    //put your code here
    
    public $chest_from;
    public $chest_to;
    public $waist_from;
    public $waist_to;
    public $butt_from;
    public $butt_to;
    
    public $height_from;
    public $height_to;
    public $weight_from;
    public $weight_to;
    
     public function rules() {
        return [
            [['casting_id', 'genre','status','star','chest_from',
                'chest_to','waist_from','waist_to','butt_from','butt_to'], 'integer'],
            [['created_time','birth_year'], 'safe']
        ];
    }

    public function search($params) {
        $query = Register::find();
        $castingid = $params['RegisterSearch']['casting_id'];
        if ($castingid != null) {
            $query->andWhere(['casting_id' => $castingid]);
        }
//        var_dump($params);die;
        $endfrom = $params['RegisterSearch']['created_time_from'];
        $endto = $params['RegisterSearch']['created_time_to'];
        if ($endfrom != null) {
            $query->andWhere('created_time >= :from ', ['from' => date('Y-m-d', strtotime($endfrom))]);
        }
        if ($endto != null) {
            $query->andWhere('created_time <= :to ', ['to' => date('Y-m-d', strtotime($endto))]);
        }
        
        $birthfrom = $params['RegisterSearch']['birth_year_from'];

        $birthto = $params['RegisterSearch']['birth_year_to'];
        if ($birthfrom != null) {
//                    var_dump($params);die;
            $query->andWhere('birth_year >= :from ', ['from' => date('Y-m-d', strtotime($birthfrom))]);
        }
        if ($birthto != null) {
            $query->andWhere('birth_year <= :to ', ['to' => date('Y-m-d', strtotime($birthto))]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        if ($params['RegisterSearch']['status'] != null) {
            $query->andWhere(['=','status',$params['RegisterSearch']['status']]);
        }  
        if ($params['RegisterSearch']['star'] != null) {
            $query->andWhere(['=','star',$params['RegisterSearch']['star']]);
        }  
        if ($params['RegisterSearch']['genre'] != null) {
            $query->andWhere(['=','genre',$params['RegisterSearch']['genre']]);
        } 
        
       #so do 3 vong
         if ($params['RegisterSearch']['chest_from'] != null) {
            $query->andWhere(['>=','chest',$params['RegisterSearch']['chest_from']]);
        } 
        
        if ($params['RegisterSearch']['chest_to'] != null) {
            $query->andWhere(['<=','chest',$params['RegisterSearch']['chest_to']]);
        } 
        
        if ($params['RegisterSearch']['waist_from'] != null) {
            $query->andWhere(['>=','waist',$params['RegisterSearch']['waist_from']]);
        } 
        
        if ($params['RegisterSearch']['waist_to'] != null) {
            $query->andWhere(['<=','waist',$params['RegisterSearch']['waist_to']]);
        } 
        if ($params['RegisterSearch']['butt_from'] != null) {
            $query->andWhere(['>=','butt',$params['RegisterSearch']['butt_from']]);
        } 
        
        if ($params['RegisterSearch']['butt_to'] != null) {
            $query->andWhere(['<=','butt',$params['RegisterSearch']['butt_to']]);
        } 
        
        if ($params['RegisterSearch']['height_from'] != null) {
            $query->andWhere(['>=','height',$params['RegisterSearch']['height_from']]);
        } 
        
        if ($params['RegisterSearch']['height_to'] != null) {
            $query->andWhere(['<=','height',$params['RegisterSearch']['height_to']]);
        } 
        if ($params['RegisterSearch']['weight_from'] != null) {
            $query->andWhere(['>=','weight',$params['RegisterSearch']['weight_from']]);
        } 
        
        if ($params['RegisterSearch']['weight_to'] != null) {
            $query->andWhere(['<','weight',$params['RegisterSearch']['weight_to']]);
        } 
        
        
        
        
        return $dataProvider;
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
            'chest_from' => "Vòng một từ",
            'chest_to' => "Vòng một đến",
            'waist_from' => "Vòng hai từ",
            'waist_to' => "Vòng hai đến",
            'butt_from' => "Vòng ba từ",
            'butt_to' => "Vòng ba đến"
        ];
    }
}
