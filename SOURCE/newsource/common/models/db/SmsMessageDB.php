<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "sms_message".
 *
 * @property integer $id
 * @property string $sms_key
 * @property string $sms_content
 */
class SmsMessageDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sms_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sms_key', 'sms_content'], 'required'],
            [['sms_key'], 'string', 'max' => 255],
            [['sms_content'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'sms_key' => Yii::t('backend', 'Sms Key'),
            'sms_content' => Yii::t('backend', 'Sms Content'),
        ];
    }
}
