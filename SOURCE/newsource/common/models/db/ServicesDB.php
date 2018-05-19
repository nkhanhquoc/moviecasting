<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property string $ID
 * @property string $CODE
 * @property string $SERVICE
 * @property string $URL
 * @property string $USERNAME
 * @property string $PASSWORD
 * @property string $REQUEST
 * @property string $RESPONSE
 * @property string $CREATED_TIME
 * @property string $UPDATED_TIME
 */
class ServicesDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CREATED_TIME', 'UPDATED_TIME'], 'safe'],
            [['CODE', 'SERVICE', 'USERNAME'], 'string', 'max' => 20],
            [['URL', 'PASSWORD'], 'string', 'max' => 255],
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
            'CODE' => Yii::t('backend', 'Code'),
            'SERVICE' => Yii::t('backend', 'Service'),
            'URL' => Yii::t('backend', 'Url'),
            'USERNAME' => Yii::t('backend', 'Username'),
            'PASSWORD' => Yii::t('backend', 'Password'),
            'REQUEST' => Yii::t('backend', 'Request'),
            'RESPONSE' => Yii::t('backend', 'Response'),
            'CREATED_TIME' => Yii::t('backend', 'Created  Time'),
            'UPDATED_TIME' => Yii::t('backend', 'Updated  Time'),
        ];
    }
}
