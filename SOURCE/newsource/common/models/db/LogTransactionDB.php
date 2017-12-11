<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "log_transaction".
 *
 * @property string $ID
 * @property string $MSISDN
 * @property string $PRODUCT_CODE
 * @property string $ENDPOINT
 * @property string $URL
 * @property string $REQUEST
 * @property string $RESPONSE
 * @property string $ERROR_CODE
 * @property string $CREATED_TIME
 */
class LogTransactionDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CREATED_TIME'], 'safe'],
            [['MSISDN', 'PRODUCT_CODE', 'ERROR_CODE'], 'string', 'max' => 20],
            [['ENDPOINT'], 'string', 'max' => 10],
            [['URL'], 'string', 'max' => 255],
            [['REQUEST', 'RESPONSE'], 'string', 'max' => 1000]
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
            'PRODUCT_CODE' => Yii::t('backend', 'Product  Code'),
            'ENDPOINT' => Yii::t('backend', 'Endpoint'),
            'URL' => Yii::t('backend', 'Url'),
            'REQUEST' => Yii::t('backend', 'Request'),
            'RESPONSE' => Yii::t('backend', 'Response'),
            'ERROR_CODE' => Yii::t('backend', 'Error  Code'),
            'CREATED_TIME' => Yii::t('backend', 'Created  Time'),
        ];
    }
}
