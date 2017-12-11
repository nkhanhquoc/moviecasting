<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "groupon_bi".
 *
 * @property string $id
 * @property string $msisdn
 * @property string $bi
 * @property string $created_time
 * @property string $updated_time
 */
class GrouponBiDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'groupon_bi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msisdn', 'bi'], 'required'],
            [['created_time', 'updated_time'], 'safe'],
            [['msisdn'], 'string', 'max' => 15],
            [['bi'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'msisdn' => Yii::t('backend', 'Msisdn'),
            'bi' => Yii::t('backend', 'Bi'),
            'created_time' => Yii::t('backend', 'Created Time'),
            'updated_time' => Yii::t('backend', 'Updated Time'),
        ];
    }
}
