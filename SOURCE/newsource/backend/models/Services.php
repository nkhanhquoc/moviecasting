<?php
namespace backend\models;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use common\models\ServicesBase;
use yii\db\ActiveRecord;
use yii\db\Expression;
/**
 * Description of Services
 *
 * @author khanhnq16
 */
class Services extends ServicesBase{
    //put your code here
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
    
    public static function getAllService(){
        $query = Services::find()->all();
        $list = [];
        if ($query) {
            foreach ($query as $vasService) {
                $list[$vasService->ID] = $vasService->SERVICE;
            }
        }
        return $list;        
    }
    
    public static function getAllServiceCode(){
        $query = Services::find()->all();
        $list = [];
        if ($query) {
            foreach ($query as $vasService) {
                $list[$vasService->SERVICE] = $vasService->SERVICE;
            }
        }
        return $list;        
    }
    
    public static function getByCode($code){
        $query = Services::find()->where(['SERVICE' => $code])->one();
        return $query;
    }
}
