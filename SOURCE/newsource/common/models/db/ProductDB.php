<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property string $ID
 * @property string $NAME
 * @property string $CODE
 * @property double $PRICE
 * @property double $MAIN_PRICE
 * @property integer $ADD_DAY
 * @property string $SHOT_DESCRIPTION
 * @property string $DESCRIPTION
 * @property string $IMAGE_PATH
 * @property string $BANNER_PATH
 * @property integer $STATUS
 * @property integer $NO_MIN_REG
 * @property string $END_TIME
 * @property string $SERVICE_ID
 * @property integer $TYPE
 * @property string $CREATED_TIME
 * @property string $UPDATED_TIME
 * @property string $INVITE_CONTENT
 * @property integer $IS_RENEW
 * @property string $PERIOD
 * @property integer $CURRENT_REG
 * @property integer $DAY_RETRY
 * @property integer $VAS_SERVICE_ID
 * @property string $CATEGORY
 * @property integer $IS_HOT
 * @property string $USE_GUIDELINE
 * @property string $NO_VIEW
 */
class ProductDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NAME', 'INVITE_CONTENT', 'IS_RENEW', 'PERIOD', 'VAS_SERVICE_ID'], 'required'],
            [['ADD_DAY', 'STATUS', 'NO_MIN_REG', 'SERVICE_ID', 'TYPE', 'IS_RENEW', 'CURRENT_REG', 'DAY_RETRY', 'VAS_SERVICE_ID', 'IS_HOT', 'NO_VIEW'], 'integer'],
            [['END_TIME', 'CREATED_TIME', 'UPDATED_TIME'], 'safe'],
            [['NAME', 'SHOT_DESCRIPTION', 'IMAGE_PATH', 'BANNER_PATH', 'INVITE_CONTENT', 'CATEGORY'], 'string', 'max' => 255],
            [['CODE'], 'string', 'max' => 50],
            [['PRICE', 'MAIN_PRICE'], 'string', 'max' => 7],
            [['DESCRIPTION'], 'string', 'max' => 1000],
            [['PERIOD'], 'string', 'max' => 20],
            [['USE_GUIDELINE'], 'string', 'max' => 2000]
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
            'PRICE' => Yii::t('backend', 'Price'),
            'MAIN_PRICE' => Yii::t('backend', 'Main  Price'),
            'ADD_DAY' => Yii::t('backend', 'Add  Day'),
            'SHOT_DESCRIPTION' => Yii::t('backend', 'Shot  Description'),
            'DESCRIPTION' => Yii::t('backend', 'Description'),
            'IMAGE_PATH' => Yii::t('backend', 'Image  Path'),
            'BANNER_PATH' => Yii::t('backend', 'Banner  Path'),
            'STATUS' => Yii::t('backend', 'Status'),
            'NO_MIN_REG' => Yii::t('backend', 'No  Min  Reg'),
            'END_TIME' => Yii::t('backend', 'End  Time'),
            'SERVICE_ID' => Yii::t('backend', 'Service  ID'),
            'TYPE' => Yii::t('backend', 'Type'),
            'CREATED_TIME' => Yii::t('backend', 'Created  Time'),
            'UPDATED_TIME' => Yii::t('backend', 'Updated  Time'),
            'INVITE_CONTENT' => Yii::t('backend', 'Invite  Content'),
            'IS_RENEW' => Yii::t('backend', 'Is  Renew'),
            'PERIOD' => Yii::t('backend', 'Period'),
            'CURRENT_REG' => Yii::t('backend', 'Current  Reg'),
            'DAY_RETRY' => Yii::t('backend', 'Day  Retry'),
            'VAS_SERVICE_ID' => Yii::t('backend', 'Vas  Service  ID'),
            'CATEGORY' => Yii::t('backend', 'Category'),
            'IS_HOT' => Yii::t('backend', 'Is  Hot'),
            'USE_GUIDELINE' => Yii::t('backend', 'Use  Guideline'),
            'NO_VIEW' => Yii::t('backend', 'No  View'),
        ];
    }
}
