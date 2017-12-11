<?php

/**
 * Created by PhpStorm.
 * User: HoangL
 * Date: 11/20/2015
 * Time: 1:45 PM
 */

namespace api\libs;

use api\modules\v1\models\TopicV1;
use api\modules\v1\models\VtAlbumV1;
use api\modules\v1\models\VtRingBackToneV1;
use api\modules\v1\models\VtSingerV1;
use api\modules\v1\models\VtSongV1;
use api\modules\v1\models\VtVideoV1;
use common\helpers\MusicHelper;
use Yii;
use yii\base\Exception;
use yii\helpers\Url;

class ApiHelper {

    static function formatResponse($errCode, $content = []) {
        return [
            'errorCode' => $errCode,
            'message' => ApiResponseCode::getMessage($errCode),
            'data' => $content,
        ];
    }
    static function formatResponsePage($errCode, $content = [], $total) {
        return [
            'errorCode' => $errCode,
            'message' => ApiResponseCode::getMessage($errCode),
            'data' => $content,
            'total'=>$total
        ];
    }

    static function errorResponse() {
        return [
            'errorCode' => ApiResponseCode::UNKNOWN,
            'message' => ApiResponseCode::getMessage(ApiResponseCode::UNKNOWN),
            'data' => [],
        ];
    }

    static function insertArrayIndex($array, $new_element, $index) {
        /*         * * get the start of the array ** */
        $start = array_slice($array, 0, $index);
        /*         * * get the end of the array ** */
        $end = array_slice($array, $index);
        /*         * * add the new element to the array ** */
        $start[] = $new_element;
        /*         * * glue them back together and return ** */
        return array_merge($start, $end);
    }

    static function imagePath($path, $type = "album") {
        try {
            if (strlen($path) == 0) {
                return null;
//                return Yii::$app->params[$type . '_default_media_path'];
            } else {
                return Yii::$app->params['media_path'] . $path;
//                $filename = Yii::$app->params['upload_path'] . $path;
//                if (is_file($filename)) {
//                    return Yii::$app->params['media_path'] . $path;
//                } else {
////                    return Yii::$app->params[$type . '_default_media_path'];
//                    return null;
//                }
            }
        } catch (Exception $e) {
            return Yii::$app->params[$type . '_default_media_path'];
        }
    }

    static function convertMsisdn($msisdn) {
        if ($msisdn) {
            if(!is_numeric($msisdn)){
                return null;
            } if (substr($msisdn, 0, 2) == "84") {
                return substr($msisdn, 2);
            } else if(substr($msisdn, 0, 1) == "0"){
                return substr($msisdn, 1);
            }
        }
        return $msisdn;
    }
    
    public static function callMps($msisdn,$content) {
        try {
            $urlWS = \Yii::$app->params['mps_webservice']['wsdl'];
            $user = \Yii::$app->params['mps_webservice']['username'];
            $pass = \Yii::$app->params['mps_webservice']['password'];
            $shortcode = \Yii::$app->params['mps_webservice']['shortcode'];
            Yii::info('CALL MPS WS: wsdl: '. $urlWS, 'mpsws');

            $transId = date('YmdHis');
            $error = 1;
            $message = 'Hệ thống đang bận. Bạn vui lòng thử lại sau!';
//            var_dump($service);die;
            $soap_request = "<?xml version=\"1.0\"?>\n";
            $soap_request .=
                '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://mpsRegisterws/xsd">
                   <soapenv:Header/>
                   <soapenv:Body>
                      <xsd:smsRequest>
                         <xsd:username>' . $user . '</xsd:username>
                         <xsd:password>' . $pass . '</xsd:password>
                         <xsd:msisdn>' . $msisdn . '</xsd:msisdn>
                         <xsd:content>'. $content. '</xsd:content>
                         <xsd:shortcode>'.$shortcode.'</xsd:shortcode>         
                      </xsd:smsRequest>
                   </soapenv:Body>
                </soapenv:Envelope>';
//            var_dump($soap_request);die;
            Yii::info('CALL MPS WS: soap request: '. $soap_request, 'mpsws');
            $soap_do = curl_init();
            curl_setopt($soap_do, CURLOPT_URL, $urlWS);
            curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($soap_do, CURLOPT_TIMEOUT, 30);
            curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($soap_do, CURLOPT_POST, true);
            curl_setopt($soap_do, CURLOPT_POSTFIELDS, $soap_request);
            curl_setopt($soap_do, CURLOPT_HTTPHEADER,  array('Content-type: application/xml'));

            Yii::info('');

            $result = curl_exec($soap_do);
//            var_dump($result);die;
//            var_dump($soap_request);die;
            if ($result) {
                $str = explode('return>', $result);
                $code = trim(trim($str[1], '</'), '&lt;');
                $result = $code;
            } else {
                $result = -1;
            }
        } catch (\mongosoft\soapclient\Exception $ex) {
            $result = -1;
            Yii::error($ex->getMessage());
        }
        Yii::info('CALL MPS WS: soap result: '. $result, 'mpsws');
        return $result;
    }

    public static function convertCountView($count) {
        if ($count > 1000000) {
            return number_format(floor($count / 1000000)) . "M";
        }
        return number_format($count);
    }

}
