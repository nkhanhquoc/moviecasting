<?php

/**
 * Created by PhpStorm.
 * User: HoangL
 * Date: 11/20/2015
 * Time: 3:48 PM
 */

namespace api\libs;

use Yii;

class ApiResponseCode {

// xxyyzz: xx: function; yy: action; zz: error code in action
    const SUCCESS = '0';
    const PARAMS_ERROR = '4';
    const REGISTERD = '2';
    const UNKNOWN_METHOD = '3';
    const PRODUCT_ERROR = '1';
    const AUTHORIZATION_CODE_REQUIRED = '10';
    const LOGIN_IS_REQUIRED = '5';  // zz = 08 // need to login
    const CSRF_TOKEN_REQUIRED = '6'; //
    const CSRF_TOKEN_INVALID = '7'; //
    const PERMISSION_IS_REQUIRED = '8'; // need permission to execute function
    const POST_METHOD_IS_REQUIRED = '9'; // need post method to execute function

    const UNKNOWN = '999999';
// xxyyzz: xx = 30: Authenticate & Authorization; yy = 00: GetAuthorizationCode
    const AUTH_INVALID_ID = '300001'; // zz = 01 // invalid client (wrong id and secret)
    const AUTH_INVALID_AUTHORIZATION_CODE = '300002';  // zz = 02 // invalid authorization code
    const AUTH_INVALID_USERNAME_PASSWORD = '300003';  // zz = 03 // invalid username password
    const AUTH_USER_NOT_ACTIVE = '300004';  // zz = 04 // user is not active
    const AUTH_USER_IS_LOCKED = '300005';  // zz = 05 // user is locked
    const AUTH_USER_PASS_IS_REQUIRED = '300006';  // zz = 06 // username and password is required
    const AUTH_CLIENT_ID_SECRET_IS_REQUIRED = '300007';  // zz = 07 // client id and client secret is required
// xxyyzz: xx = 10: SyncMedia; yy = 00: GetMedia
    const SYNC_MEDIA_INVALID_PARAMS = '100001';


    public static function getMessage($errorCode) {
        $mess = [
            self::SUCCESS => Yii::t('api', 'Successful'),
            self::PRODUCT_ERROR => Yii::t('api', 'product không tồn tại'),
            self::PARAMS_ERROR => Yii::t('api', 'Params không hợp lệ'),
            self::REGISTERD => Yii::t('api', 'Sản phẩm đang đăng ký mua'),
            self::UNKNOWN_METHOD => Yii::t('api', 'Unknown method'),
            self::UNKNOWN => Yii::t('api', 'Unknown Error'),
            self::AUTHORIZATION_CODE_REQUIRED => Yii::t('api', 'Authorization code is required'),
            self::LOGIN_IS_REQUIRED => Yii::t('api', 'You are not authorized to perform this action'),
//            self::REQUIRE_LOGIN => Yii::t('api', 'Require login.'),
            self::PERMISSION_IS_REQUIRED => Yii::t('api', 'Need permission to execute function.'),
            self::POST_METHOD_IS_REQUIRED => Yii::t('api', 'Need post method to execute function.'),
            // Authenticate & Authorization
            self::AUTH_INVALID_ID => Yii::t('api', 'Wrong client id and client secret'),
            self::AUTH_INVALID_AUTHORIZATION_CODE => Yii::t('api', 'Invalid authorization code'),
            self::AUTH_INVALID_USERNAME_PASSWORD => Yii::t('api', 'Invalid username password'),
            self::AUTH_USER_NOT_ACTIVE => Yii::t('api', 'Your account is not active'),
            self::AUTH_USER_IS_LOCKED => Yii::t('api', 'Your account is locked'),
            self::AUTH_USER_PASS_IS_REQUIRED => Yii::t('api', 'Username and Password is required'),
            self::AUTH_CLIENT_ID_SECRET_IS_REQUIRED => Yii::t('api', 'Client id and Client secret is required'),
            // SyncMedia
            self::SYNC_MEDIA_INVALID_PARAMS => Yii::t('api', 'Invalid input parameter'),
        ];
        if ($mess[$errorCode]) {
            return $mess[$errorCode];
        }
        return '';
    }

}
