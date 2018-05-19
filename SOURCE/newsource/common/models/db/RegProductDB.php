<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "reg_product".
 *
 * @property integer $ID
 * @property string $MSISDN
 * @property string $PRODUCT_ID
 * @property integer $STATUS
 * @property string $ERROR_CODE
 * @property string $CREATED_TIME
 * @property string $UPDATED_TIME
 * @property string $NEXT_TIME_RETRY
 * @property string $EXPIRED_RETRY
 */
class RegProductDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reg_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PRODUCT_ID', 'STATUS'], 'integer'],
            [['CREATED_TIME', 'UPDATED_TIME', 'NEXT_TIME_RETRY', 'EXPIRED_RETRY'], 'safe'],
            [['MSISDN', 'ERROR_CODE'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('backend', 'ID'),
            'MSISDN' => Yii::t('backend', 'Msisdn'),
            'PRODUCT_ID' => Yii::t('backend', 'Product  ID'),
            'STATUS' => Yii::t('backend', 'Status'),
            'ERROR_CODE' => Yii::t('backend', 'Error  Code'),
            'CREATED_TIME' => Yii::t('backend', 'Created  Time'),
            'UPDATED_TIME' => Yii::t('backend', 'Updated  Time'),
            'NEXT_TIME_RETRY' => Yii::t('backend', 'Next  Time  Retry'),
            'EXPIRED_RETRY' => Yii::t('backend', 'Expired  Retry'),
        ];
    }
}
