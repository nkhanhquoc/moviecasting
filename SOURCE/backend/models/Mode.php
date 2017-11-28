<?php

namespace backend\models;

use common\models\ModeBase;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Mode extends ModeBase {

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['updated_at', 'created_at'], 'safe'],
            [['updated_by', 'created_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['image_path'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public static function getAll() {
        $country = \backend\models\Mode::find()->all();
        $data = [];
        foreach ($country as $item) {
            $data[$item->id] = \yii\helpers\Html::encode($item->name);
        }
        return $data;
    }

    public function upload() {
        if ($this->validate()) {
            if (!is_dir(\Yii::getAlias('@webroot') . '/uploads/mode')) {
                mkdir(\Yii::getAlias('@webroot') . '/uploads/mode', 0755, true);
            }
            $filePath = '/uploads/mode/' . md5(time()) . '.' . $this->image_path->extension;
            $this->image_path->saveAs(\Yii::getAlias('@webroot') . $filePath);
            return $filePath;
        }
        return '';
    }

    public function getUrlImage() {
        return \yii\helpers\Html::img($this->image_path, ['width' => 300, 'height' => 200]);
    }

}
