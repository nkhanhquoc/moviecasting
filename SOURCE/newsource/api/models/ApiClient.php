<?php

namespace api\models;

use Yii;

class ApiClient extends \common\models\ApiClientBase
{
    public static function getByIds($ids)
    {
        return ApiClient::find()
            ->where([
                'id' => $ids,
            ])
            ->all();
    }
}