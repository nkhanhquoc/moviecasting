<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property string $id
 * @property string $name
 * @property string $msisdn
 * @property string $content
 * @property string $created_time
 * @property integer $status
 * @property string $updated_time
 */
class ContactDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_time', 'updated_time'], 'safe'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['msisdn'], 'string', 'max' => 20],
            [['content'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'name' => Yii::t('backend', 'Name'),
            'msisdn' => Yii::t('backend', 'Msisdn'),
            'content' => Yii::t('backend', 'Content'),
            'created_time' => Yii::t('backend', 'Created Time'),
            'status' => Yii::t('backend', 'Status'),
            'updated_time' => Yii::t('backend', 'Updated Time'),
        ];
    }
}
