<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "groupon_mt_his".
 *
 * @property string $ID
 * @property string $MSISDN
 * @property string $CONTENT
 * @property string $ERROR_CODE
 * @property string $CREATED_TIME
 * @property integer $PROCESS_ID
 * @property string $SENT_TIME
 */
class GrouponMtHisDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'groupon_mt_his';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CREATED_TIME', 'SENT_TIME'], 'safe'],
            [['PROCESS_ID'], 'integer'],
            [['MSISDN', 'ERROR_CODE'], 'string', 'max' => 20],
            [['CONTENT'], 'string', 'max' => 1000]
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
            'CONTENT' => Yii::t('backend', 'Content'),
            'ERROR_CODE' => Yii::t('backend', 'Error  Code'),
            'CREATED_TIME' => Yii::t('backend', 'Created  Time'),
            'PROCESS_ID' => Yii::t('backend', 'Process  ID'),
            'SENT_TIME' => Yii::t('backend', 'Sent  Time'),
        ];
    }
}
