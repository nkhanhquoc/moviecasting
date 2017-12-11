<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vas_service".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 */
class VasServiceDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vas_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NAME', 'CODE'], 'required'],
            [['NAME', 'CODE'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('backend', 'ID'),
            'NAME' => Yii::t('backend', 'Name'),
            'CODE' => Yii::t('backend', 'Code'),
        ];
    }
}
