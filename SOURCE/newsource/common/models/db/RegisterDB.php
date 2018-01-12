<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "register".
 *
 * @property string $id
 * @property string $casting_id
 * @property string $name
 * @property integer $genre
 * @property string $birth_year
 * @property string $msisdn
 * @property string $location
 * @property string $outfit
 * @property integer $height
 * @property integer $weight
 * @property integer $chest
 * @property integer $waist
 * @property integer $butt
 * @property string $portrait
 * @property string $portrait_2
 * @property string $portrait_3
 * @property string $facebook
 * @property string $product
 * @property string $created_time
 * @property integer $status
 * @property integer $star
 * @property string $updated_time
 * @property string $blacklist_note
 */
class RegisterDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'register';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['casting_id'], 'required'],
            [['casting_id', 'genre', 'height', 'weight', 'chest', 'waist', 'butt', 'status', 'star'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['name', 'location', 'outfit', 'portrait', 'portrait_2', 'portrait_3', 'facebook', 'product', 'blacklist_note'], 'string', 'max' => 255],
            [['birth_year'], 'string', 'max' => 10],
            [['msisdn'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'casting_id' => Yii::t('backend', 'Casting ID'),
            'name' => Yii::t('backend', 'Name'),
            'genre' => Yii::t('backend', 'Genre'),
            'birth_year' => Yii::t('backend', 'Birth Year'),
            'msisdn' => Yii::t('backend', 'Msisdn'),
            'location' => Yii::t('backend', 'Location'),
            'outfit' => Yii::t('backend', 'Outfit'),
            'height' => Yii::t('backend', 'Height'),
            'weight' => Yii::t('backend', 'Weight'),
            'chest' => Yii::t('backend', 'Chest'),
            'waist' => Yii::t('backend', 'Waist'),
            'butt' => Yii::t('backend', 'Butt'),
            'portrait' => Yii::t('backend', 'Portrait'),
            'portrait_2' => Yii::t('backend', 'Portrait 2'),
            'portrait_3' => Yii::t('backend', 'Portrait 3'),
            'facebook' => Yii::t('backend', 'Facebook'),
            'product' => Yii::t('backend', 'Product'),
            'created_time' => Yii::t('backend', 'Created Time'),
            'status' => Yii::t('backend', 'Status'),
            'star' => Yii::t('backend', 'Star'),
            'updated_time' => Yii::t('backend', 'Updated Time'),
            'blacklist_note' => Yii::t('backend', 'Blacklist Note'),
        ];
    }
}
