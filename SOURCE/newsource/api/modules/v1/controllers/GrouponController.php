<?php

namespace api\modules\v1\controllers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use api\controllers\ApiController;
use Yii;
use yii\base\Exception;
use api\modules\v1\models\GrouponBi;
use api\modules\v1\models\Product;
use api\libs\ApiHelper;
use api\libs\ApiResponseCode;
use api\modules\v1\models\RegProduct;
use yii\data\Pagination;
use api\modules\v1\models\GrouponMtHis;

/**
 * Description of GrouponController
 *
 * @author khanhnq16
 */
class GrouponController extends ApiController {

    //put your code here
    protected $requiredPost = true;

    function actionGetTopProduct() {
        $msisdn = ApiHelper::convertMsisdn(trim(Yii::$app->request->post('msisdn')));
        $listCate = [];
        if ($msisdn) {
            $listCate = GrouponBi::getArrBi($msisdn);
        }
        $listProduct = Product::getTop($listCate,1,5);
        $result = array();
        foreach ($listProduct as $pro) {            
            $pro['BANNER_PATH'] = ApiHelper::imagePath($pro['BANNER_PATH'], "product");
            $pro['IMAGE_PATH'] = ApiHelper::imagePath($pro['IMAGE_PATH'], "product");
            $result[] = $pro;
        }

        return ApiHelper::formatResponse(
                        ApiResponseCode::SUCCESS, $result
        );
    }

    function actionGetDetail() {
        $id = Yii::$app->request->post('id');
        if (!$id) {
            return ApiHelper::formatResponse(
                            ApiResponseCode::PARAMS_ERROR, array()
            );
        }
        $product = Product::getDetail($id);

        if ($product) {
            $product['IMAGE_PATH'] = ApiHelper::imagePath($product['IMAGE_PATH'], "product");
            try{
                Product::updateNoView($product['ID']);
                $product['NO_VIEW'] = $product['NO_VIEW']+1;
            } catch(Exception $e){
                echo $e->getMessage();
            }

            return ApiHelper::formatResponse(
                            ApiResponseCode::SUCCESS, $product
            );
        }

        return ApiHelper::formatResponse(
                        ApiResponseCode::PRODUCT_ERROR, $product
        );
    }

    function actionOrder() {
        $id = trim(Yii::$app->request->post('id'));
        $msisdn = ApiHelper::convertMsisdn(trim(Yii::$app->request->post('msisdn')));
        if (!$id || !$msisdn) {
            return ApiHelper::formatResponse(
                            ApiResponseCode::PARAMS_ERROR, array()
            );
        }
        $product = Product::getDetail($id, 1); //them 1 de lay dang object
        if (!$product) {
            return ApiHelper::formatResponse(
                            ApiResponseCode::PRODUCT_ERROR, array()
            );
        }

        $reg = RegProduct::getReg($msisdn, $id);
        if ($reg) {
            return ApiHelper::formatResponse(
                            ApiResponseCode::REGISTERD, array()
            );
        }
        try {
            $reg = new RegProduct();
            $reg->MSISDN = $msisdn;
            $reg->PRODUCT_ID = $id;
            $reg->save(false);

            Product::updateRegProduct($id, 1);
            $content = Yii::$app->params['mps_webservice']['content'];
            $content = str_replace('__DV__',$product->NAME,$content);
            $content = str_replace('__PRICE__',$product->PRICE,$content);
            $content = str_replace('__MAINPRICE__',$product->MAIN_PRICE,$content);
            $content = str_replace('__ENDTIME__',date('d-m-Y H:i',strtotime($product->END_TIME)),$content);
            $result = ApiHelper::callMps($msisdn,$content);
            //save his
            $mtHis = new GrouponMtHis();
            $mtHis->MSISDN = $msisdn;
            $mtHis->CONTENT = $content;
            $mtHis->ERROR_CODE = $result;
            $mtHis->PROCESS_ID = 2;//api

            $mtHis->save(false);
            
        } catch (Exception $e) {
            var_dump($e->getMessage());
            die;
            return ApiHelper::formatResponse(
                            ApiResponseCode::UNKNOWN, array()
            );
        }
        return ApiHelper::formatResponse(
                        ApiResponseCode::SUCCESS, array()
        );
    }

    function actionGetOrderList() {
        $data = array();
        try {
            $msisdn = ApiHelper::convertMsisdn(trim(Yii::$app->request->post('msisdn')));
            $page = Yii::$app->request->post('page', 1);
            $limit = Yii::$app->request->post('limit', 5);

            if (!$msisdn) {
                return ApiHelper::formatResponse(
                                ApiResponseCode::PARAMS_ERROR, array()
                );
            }

            $query = RegProduct::getListActiveReg($msisdn);
            $count = $query->count();
            if ($count > 0) {
                $reg = $query->limit($limit)->offset(($page - 1) * $limit)->orderBy('CREATED_TIME desc')->asArray()->all();
                foreach ($reg as $r) {
                    $product = Product::getDetail($r['PRODUCT_ID']);
                    if ($product) {
                        $data[] = array(
                            'id' => $r['PRODUCT_ID'],
                            'name' => $product['NAME'],
                            'image_path' => ApiHelper::imagePath($product['IMAGE_PATH'], "product"),
                            'price' => $product['PRICE'],
                            'main_price' => $product['MAIN_PRICE'],
                            'current_reg' => $product['CURRENT_REG'],
                            'min_reg' => $product['NO_MIN_REG'],
                            'description' => $product['DESCRIPTION']
                        );
                    }
                }
            }
        } catch (Exception $e) {
            return ApiHelper::formatResponse(
                            ApiResponseCode::UNKNOWN, array()
            );
        }
        return ApiHelper::formatResponsePage(
                        ApiResponseCode::SUCCESS, $data,$count
        );
    }

    function actionGetHistoryOrder() {
        $msisdn = ApiHelper::convertMsisdn(trim(Yii::$app->request->post('msisdn')));
        $page = Yii::$app->request->post('page', 1);
        $limit = Yii::$app->request->post('limit', 5);
        $data = array();
        try {
            if (!$msisdn) {
                return ApiHelper::formatResponse(
                                ApiResponseCode::PARAMS_ERROR, array()
                );
            }

            $query = RegProduct::getListRegistered($msisdn);
            $count = $query->count();
            if ($count > 0) {
                $reg = $query->limit($limit)->offset(($page - 1) * $limit)->asArray()->all();
                foreach ($reg as $r) {
                    $product = Product::getDetailHistory($r['PRODUCT_ID']);
                    if ($product) {
                        $data[] = array(
                            'id' => $r['PRODUCT_ID'],
                            'name' => $product['NAME'],
                            'image_path' => ApiHelper::imagePath($product['IMAGE_PATH'], "product"),
                            'price' => $product['PRICE'],
                            'main_price' => $product['MAIN_PRICE'],
                            'current_reg' => $product['CURRENT_REG'],
                            'min_reg' => $product['NO_MIN_REG'],
                            'description' => $product['DESCRIPTION'],
                            'status' =>$r['STATUS']
                        );
                    }
                }
            }
            return ApiHelper::formatResponsePage(
                            ApiResponseCode::SUCCESS, $data,$count
            );
        } catch (Exception $e) {
            return ApiHelper::formatResponse(
                            ApiResponseCode::UNKNOWN, array()
            );
        }
    }

    function actionCancel() {
        $msisdn = ApiHelper::convertMsisdn(trim(Yii::$app->request->post('msisdn')));
        $id = Yii::$app->request->post('id');
        try {
            $reg = RegProduct::getReg($msisdn, $id, '1');
            if (!$reg) {
                return ApiHelper::formatResponse(
                                ApiResponseCode::PRODUCT_ERROR, array()
                );
            }
            $reg->STATUS = 0;
            $reg->save(false);

            Product::updateRegProduct($id, -1);

            return ApiHelper::formatResponse(
                            ApiResponseCode::SUCCESS, array()
            );
        } catch (Exception $e) {
            return ApiHelper::formatResponse(
                            ApiResponseCode::UNKNOWN, array()
            );
        }
    }

    function actionGetListProduct() {
        $text = trim(Yii::$app->request->post('keyword'));
        $page = Yii::$app->request->post('page', 1);
        $limit = Yii::$app->request->post('limit', 5);
        $query = Product::getList($text);
        $count = $query->count();
        $listProduct = array();
        $result = array();
        if($count){
            $listProduct = $query->limit($limit)->offset(($page - 1) * $limit)->orderBy('CREATED_TIME desc')->asArray()->all();
            foreach($listProduct as $pro){
                $pro['IMAGE_PATH'] = ApiHelper::imagePath($pro['IMAGE_PATH'], "product");
                $result[] = $pro;
            }
        }
        return ApiHelper::formatResponsePage(
                        ApiResponseCode::SUCCESS, $result, $count
        );
    }

}
