<?php
namespace backend\models;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Yii;
use common\models\LogTransactionBase;
/**
 * Description of LogTransaction
 *
 * @author khanhnq16
 */
class LogTransaction extends LogTransactionBase{
    //put your code here
    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'MSISDN' => Yii::t('backend', 'Số điện thoại'),
            'PRODUCT_CODE' => Yii::t('backend', 'Sản phẩm'),
            'ENDPOINT' => Yii::t('backend', 'Link Webservice'),
            'CREATED_TIME' => Yii::t('backend', 'Thời gian'),
            'ERROR_CODE' => Yii::t('backend', 'Kết quả')
            
        ];
    }
}
