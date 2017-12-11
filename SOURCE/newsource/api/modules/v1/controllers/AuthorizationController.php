<?php
/**
 * Created by PhpStorm.
 * User: HoangL
 * Date: 11/27/2015
 * Time: 7:22 PM
 */

namespace api\modules\v1\controllers;

use api\libs\ApiHelper;
use api\libs\ApiResponseCode;
use api\models\auth\Client;
use api\modules\v1\models\ApiClientV1;
use Yii;
use yii\base\Exception;
use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\web\Response;

class AuthorizationController extends Controller
{
    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    public function actionRequiredAuthorizationCode()
    {
        return ApiHelper::formatResponse(
            ApiResponseCode::AUTHORIZATION_CODE_REQUIRED,
            []
        );
    }

    public function actionGetAuthorizationCode()
    {
        try {
            $data = [];
            $client_id = '';
            $client_secret = '';
            if (Yii::$app->request->isGet) {
                $client_id = Yii::$app->request->getQueryParam('client_id');
                $client_secret = Yii::$app->request->getQueryParam('client_secret');
            } else if (Yii::$app->request->isPost) {
                $client_id = Yii::$app->request->post('client_id');
                $client_secret = Yii::$app->request->post('client_secret');
            }
            if ($client_id && $client_secret) {
                $client = ApiClientV1::getClientBySecret($client_id, $client_secret);
                /* @var ApiClientV1 $client */
                if ($client) {
                    $authorization_code = Client::getAuthorizationCode($client->client_id, $client->permission, $client->id);
                    $data['authorization_code'] = $authorization_code;
                }
            } else {
                return ApiHelper::formatResponse(
                    ApiResponseCode::AUTH_CLIENT_ID_SECRET_IS_REQUIRED,
                    $data
                );
            }
        } catch (Exception $ex) {
            return ApiHelper::errorResponse();
        }
        return ApiHelper::formatResponse(
            ApiResponseCode::SUCCESS,
            $data
        );
    }

//    public function actionGenerateClientCode()
//    {
//        try {
//            $data = [];
//            $client = new ApiClient();
//            $client->client_id = Yii::$app->security->generateRandomString(16);
//            $client->client_secret = Yii::$app->security->generateRandomString(32);
//            $client->permission = 'sync_media sync_metadata';
//            $client->description = 'MyVideo Sync Program V1.0';
//            $client->save();
//            $data['client_id'] = $client->client_id;
//            $data['client_secret'] = $client->client_secret;
//            $data['permission'] = $client->permission;
//            $data['description'] = $client->description;
//        } catch (Exception $ex) {
//            return ApiHelper::errorResponse();
//        }
//        return ApiHelper::formatResponse(
//            ApiResponseCode::SUCCESS,
//            $data
//        );
//    }
}