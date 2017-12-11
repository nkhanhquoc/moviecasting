<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "api_client".
 *
 * @property string $id
 * @property string $client_id
 * @property string $client_secret
 * @property string $permission
 * @property string $description
 */
class AppsDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'apps';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_name'], 'string'],
            [['site_code'], 'string'],
            [['is_active'], 'string'],
            [['pub_key'], 'string'],
            [['pri_key'], 'string'],
            [['site_domain'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'site_name' => Yii::t('backend', 'site_name'),
            'site_code' => Yii::t('backend', 'site_code'),
            'is_active' => Yii::t('backend', 'is_active'),
            'pub_key' => Yii::t('backend', 'pub_key'),
            'pri_key' => Yii::t('backend', 'pri_key'),
            'site_domain' => Yii::t('backend', 'site_domain'),
        ];
    }
}
