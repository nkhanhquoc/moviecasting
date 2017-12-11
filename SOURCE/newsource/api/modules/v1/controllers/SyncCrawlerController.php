<?php
/**
 * Created by PhpStorm.
 * User: hoangl
 * Date: 11/29/2016
 * Time: 9:18 AM
 */

namespace api\modules\v1\controllers;


use api\controllers\ApiController;
use api\libs\ApiHelper;
use api\libs\ApiResponseCode;
use api\modules\v1\models\CsmCrawlerV1;
use common\helpers\api\GenerateItem;
use Yii;
use yii\base\Exception;

class SyncCrawlerController extends ApiController
{
    protected $requiredAuth = true;
    protected $requiredPost = true;
    protected $permissionAction = 'sync_media';

    function actionGetCrawler()
    {
        $name = Yii::$app->request->post('name');
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
            $count = CsmCrawlerV1::countCrawler($name);
            $data['total'] = $count;
            $data['items'] = [];
            $items = CsmCrawlerV1::getCrawler($name, $offset, $limit);
            foreach ($items as $item) {
                $data['items'][] = GenerateItem::generateCrawler($item);
            }
        } catch (Exception $ex) {
            return ApiHelper::errorResponse();
        }
        return ApiHelper::formatResponse(
            ApiResponseCode::SUCCESS, $data
        );
    }
}