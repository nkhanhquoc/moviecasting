<?php
namespace backend\models;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use common\models\RegProductBase;
use Yii;
/**
 * Description of RegProduct
 *
 * @author khanhnq16
 */
class RegProduct extends RegProductBase{
    //put your code here
    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'MSISDN' => Yii::t('backend', 'Số điện thoại'),
            'PRODUCT_ID' => Yii::t('backend', 'Sản phẩm'),
            'NEXT_TIME_RETRY' => Yii::t('backend', 'Thời điểm retry tiếp theo'),
            'EXPIRED_RETRY' => Yii::t('backend', 'Thời điểm dừng retry'),
            'CREATED_TIME' => Yii::t('backend', 'Thời gian'),
            'ERROR_CODE' => Yii::t('backend', 'Kết quả')
            
        ];
    }
}
