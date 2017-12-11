<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property string $ID
 * @property string $NAME
 * @property string $CODE
 * @property integer $STATUS
 */
class CategoryDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STATUS'], 'integer'],
            [['NAME'], 'string', 'max' => 255],
            [['CODE'], 'string', 'max' => 20]
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
            'STATUS' => Yii::t('backend', 'Status'),
        ];
    }
}
