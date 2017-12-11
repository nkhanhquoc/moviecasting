<?php

namespace api\controllers;

use api\libs\ApiHelper;
use api\libs\ApiResponseCode;
use api\models\auth\Client;
use Yii;
use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class ApiController extends Controller
{

    protected $permission;
    protected $requiredAuth = false;
    protected $requiredPost = false;
    protected $permissionAction;

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'transparent' => true,
                'foreColor' => 0xffff00,
                'minLength' => 4,
                'maxLength' => 4,
                'offset' => 4,
            ],
        ];
    }

    public function actionError()
    {
        return ApiHelper::errorResponse();
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    public function beforeAction($action)
    {
        // validate authorization code
        Yii::$app->response->format = Response::FORMAT_JSON;
        $authorization_code = '';
        if ($this->requiredPost && !Yii::$app->request->isPost) {
            echo json_encode(ApiHelper::formatResponse(
                ApiResponseCode::POST_METHOD_IS_REQUIRED, []
            ));
            Yii::$app->end(200);
        }
        
        if(!self::checkUser(Yii::$app->request)){
            echo json_encode(ApiHelper::formatResponse(
                ApiResponseCode::AUTHORIZATION_CODE_REQUIRED, []
            ));
            Yii::$app->end(200);
        }
        
        return parent::beforeAction($action);
    }
    
    public static function checkUser($request){
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');
        
        return (Yii::$app->params['api_username'] == $username) && (Yii::$app->params['api_password'] == $password);
    }

}
