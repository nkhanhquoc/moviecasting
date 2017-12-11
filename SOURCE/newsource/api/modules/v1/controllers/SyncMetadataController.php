<?php
/**
 * Created by PhpStorm.
 * User: hoangl
 * Date: 10/21/2016
 * Time: 5:14 PM
 */

namespace api\modules\v1\controllers;


use api\controllers\ApiController;
use api\libs\ApiHelper;
use api\libs\ApiResponseCode;
use api\modules\v1\models\CsmAttributeTypeV1;
use api\modules\v1\models\CsmAttributeV1;
use api\modules\v1\models\CsmItemDeletedV1;
use common\helpers\api\GenerateItem;
use Yii;
use yii\base\Exception;

class SyncMetadataController extends ApiController
{
    protected $requiredAuth = true;
    protected $requiredPost = true;
    protected $permissionAction = 'sync_metadata';

    function actionGetAttributeType()
    {
        $startTime = Yii::$app->request->post('start_time');
        $dateTimeFormat = Yii::$app->params['datetime_format'];
        if ($startTime) {
            if ($startTime != date($dateTimeFormat, strtotime($startTime))) {
                return ApiHelper::formatResponse(
                    ApiResponseCode::SYNC_MEDIA_INVALID_PARAMS, [
                        'error_field' => 'start_time'
                    ]
                );
            }
        }
        $endTime = Yii::$app->request->post('end_time');
        if ($endTime) {
            if ($endTime != date($dateTimeFormat, strtotime($endTime))) {
                return ApiHelper::formatResponse(
                    ApiResponseCode::SYNC_MEDIA_INVALID_PARAMS, [
                        'error_field' => 'end_time'
                    ]
                );
            }
        }
        $offset = Yii::$app->request->post('offset');
        if ($offset && '' . intval($offset) != $offset) {
            return ApiHelper::formatResponse(
                ApiResponseCode::SYNC_MEDIA_INVALID_PARAMS, [
                    'error_field' => 'offset'
                ]
            );
        }
        $limit = Yii::$app->request->post('limit');
        if ($limit && '' . intval($limit) != $limit) {
            return ApiHelper::formatResponse(
                ApiResponseCode::SYNC_MEDIA_INVALID_PARAMS, [
                    'error_field' => 'limit'
                ]
            );
        }
        if (!$offset) $offset = 0;
        if (!$limit) $limit = Yii::$app->params['sync_media_limit'] ? Yii::$app->params['sync_media_limit'] : 20;

        $data = [];
        try {
            $count = CsmAttributeTypeV1::countAttributeType($startTime, $endTime);
            $data['total'] = $count;
            $data['items'] = [];
            $items = CsmAttributeTypeV1::getAttributeType($startTime, $endTime, $offset, $limit);
            foreach ($items as $item) {
                $data['items'][] = GenerateItem::generateAttributeType($item);
            }
        } catch (Exception $ex) {
            return ApiHelper::errorResponse();
        }
        return ApiHelper::formatResponse(
            ApiResponseCode::SUCCESS, $data
        );
    }

    function actionGetMediaAttribute()
    {
        $name = Yii::$app->request->post('name');
        $startTime = Yii::$app->request->post('start_time');
        $dateTimeFormat = Yii::$app->params['datetime_format'];
        if ($startTime) {
            if ($startTime != date($dateTimeFormat, strtotime($startTime))) {
                return ApiHelper::formatResponse(
                    ApiResponseCode::SYNC_MEDIA_INVALID_PARAMS, [
                        'error_field' => 'start_time'
                    ]
                );
            }
        }
        $endTime = Yii::$app->request->post('end_time');
        if ($endTime) {
            if ($endTime != date($dateTimeFormat, strtotime($endTime))) {
                return ApiHelper::formatResponse(
                    ApiResponseCode::SYNC_MEDIA_INVALID_PARAMS, [
                        'error_field' => 'end_time'
                    ]
                );
            }
        }
        $type = Yii::$app->request->post('type');
        if ($type && '' . intval($type) != $type) {
            return ApiHelper::formatResponse(
                ApiResponseCode::SYNC_MEDIA_INVALID_PARAMS, [
                    'error_field' => 'type'
                ]
            );
        }
        $offset = Yii::$app->request->post('offset');
        if ($offset && '' . intval($offset) != $offset) {
            return ApiHelper::formatResponse(
                ApiResponseCode::SYNC_MEDIA_INVALID_PARAMS, [
                    'error_field' => 'offset'
                ]
            );
        }
        $limit = Yii::$app->request->post('limit');
        if ($limit && '' . intval($limit) != $limit) {
            return ApiHelper::formatResponse(
                ApiResponseCode::SYNC_MEDIA_INVALID_PARAMS, [
                    'error_field' => 'limit'
                ]
            );
        }
        if (!$offset) $offset = 0;
        if (!$limit) $limit = Yii::$app->params['sync_media_limit'] ? Yii::$app->params['sync_media_limit'] : 20;

        $data = [];
        try {
            $count = CsmAttributeV1::countMediaAttribute($name, $startTime, $endTime, $type);
            $data['total'] = $count;
            $data['items'] = [];
            $items = CsmAttributeV1::getMediaAttribute($name, $startTime, $endTime, $type, $offset, $limit);
            foreach ($items as $item) {
                $data['items'][] = GenerateItem::generateItemAttribute($item);
            }
        } catch (Exception $ex) {
            return ApiHelper::errorResponse();
        }
        return ApiHelper::formatResponse(
            ApiResponseCode::SUCCESS, $data
        );
    }

    function actionGetDeletedMedia()
    {
        $startTime = Yii::$app->request->post('start_time');
        $dateTimeFormat = Yii::$app->params['datetime_format'];
        if ($startTime) {
            if ($startTime != date($dateTimeFormat, strtotime($startTime))) {
                return ApiHelper::formatResponse(
                    ApiResponseCode::SYNC_MEDIA_INVALID_PARAMS, [
                        'error_field' => 'start_time'
                    ]
                );
            }
        }
        $endTime = Yii::$app->request->post('end_time');
        if ($endTime) {
            if ($endTime != date($dateTimeFormat, strtotime($endTime))) {
                return ApiHelper::formatResponse(
                    ApiResponseCode::SYNC_MEDIA_INVALID_PARAMS, [
                        'error_field' => 'end_time'
                    ]
                );
            }
        }
        $offset = Yii::$app->request->post('offset');
        if ($offset && '' . intval($offset) != $offset) {
            return ApiHelper::formatResponse(
                ApiResponseCode::SYNC_MEDIA_INVALID_PARAMS, [
                    'error_field' => 'offset'
                ]
            );
        }
        $limit = Yii::$app->request->post('limit');
        if ($limit && '' . intval($limit) != $limit) {
            return ApiHelper::formatResponse(
                ApiResponseCode::SYNC_MEDIA_INVALID_PARAMS, [
                    'error_field' => 'limit'
                ]
            );
        }
        if (!$offset) $offset = 0;
        if (!$limit) $limit = Yii::$app->params['sync_media_limit'] ? Yii::$app->params['sync_media_limit'] : 20;

        $typeMetadata = Yii::$app->request->post('type_metadata');
        $typeMetadata = explode(',', $typeMetadata);
        foreach ($typeMetadata as $meta) {
            if ('' . intval($meta) != $meta) {
                return ApiHelper::formatResponse(
                    ApiResponseCode::SYNC_MEDIA_INVALID_PARAMS, [
                        'error_field' => 'type_metadata'
                    ]
                );
            }
        }

        $data = [];
        try {
            $count = CsmItemDeletedV1::countItemDeleted($startTime, $endTime, [TYPE_ITEM_DELETE_ATTRIBUTE, TYPE_ITEM_DELETE_RELATIONSHIP]);
            $data['total'] = $count;
            $data['items'] = [];
            $items = CsmItemDeletedV1::getItemDeleted($startTime, $endTime, [TYPE_ITEM_DELETE_ATTRIBUTE, TYPE_ITEM_DELETE_RELATIONSHIP], $offset, $limit);
            foreach ($items as $item) {
                $data['items'][] = GenerateItem::generateItemDeleted($item);
            }
        } catch (Exception $ex) {
            return ApiHelper::errorResponse();
        }
        return ApiHelper::formatResponse(
            ApiResponseCode::SUCCESS, $data
        );
    }
}