<?php

	namespace backend\models;

	use Yii;

	class SysConfig extends \common\models\SysConfigBase {

	  /**
	   * @inheritdoc
	   */
	  public function rules() {
		return [
			[['config_key', 'config_value', 'description'], 'trim'],
			[['config_key', 'config_value'], 'required'],
			[['config_value'], 'string'],
			[['config_key'], 'string', 'max' => 255],
			[['description', 'config_value'], 'string', 'max' => 1000],
			[['config_key', 'config_value'], 'trim'],
			[['config_key'], 'match', 'pattern' => '/^[a-zA-Z0-9_]*$/',
				'message' => Yii::t('backend', 'Tên cấu hình chỉ bao gồm chữ thường, HOA, ký tự số và "_"')],
			[
				['config_key'], 'unique',
				'message' => Yii::t('backend', 'Cấu hình đã tồn tại!'),
			]
		];
	  }

	  /**
	   * @inheritdoc
	   */
	  public function attributeLabels() {
		return [
			'id' => Yii::t('backend', 'ID'),
			'config_key' => Yii::t('backend', 'Config Key'),
			'config_value' => Yii::t('backend', 'Config Value'),
			'description' => Yii::t('backend', 'Description'),
		];
	  }

 		}
	