<?php
namespace backend\models;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\data\ActiveDataProvider;
/**
 * Description of RegProductSearch
 *
 * @author khanhnq16
 */
class RegProductSearch extends \backend\models\RegProduct{
    //put your code here
    public function rules() {
        return [
            [['ERROR_CODE', 'STATUS', 'PRODUCT_ID'], 'integer'],
            [['MSISDN', 'CREATED_TIME'], 'safe']
        ];
    }
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        
        $query = RegProduct::find();
        $service = $params['RegProductSearch']['PRODUCT_ID'];
        if ($service != null) {
            $query->andWhere(['PRODUCT_ID' => $service]);
        }
//        var_dump($params);die;
        $endfrom = $params['RegProductSearch']['created_time_from'];
        $endto = $params['RegProductSearch']['created_time_to'];
        if ($endfrom != null) {
            $query->andWhere('CREATED_TIME >= :from ', ['from' => date('Y-m-d', strtotime($endfrom))]);
        }
        if ($endto != null) {
            $query->andWhere('CREATED_TIME <= :to ', ['to' => date('Y-m-d', strtotime($endto))]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

//        var_dump($params);die;
        if ($params['RegProductSearch']['STATUS'] != null) {
            $query->andWhere(['=','STATUS',$params['RegProductSearch']['STATUS']]);
        }        
        if ($params['RegProductSearch']['MSISDN'] != null) {
            $query->andWhere(['like','MSISDN',$params['RegProductSearch']['MSISDN']]);
        }        
        if ($params['RegProductSearch']['ERROR_CODE'] != null) {
            $query->andWhere(['=','ERROR_CODE',$params['RegProductSearch']['ERROR_CODE']]);
        }        

        return $dataProvider;
    }
}
