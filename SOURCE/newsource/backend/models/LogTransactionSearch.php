<?php
namespace backend\models;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\data\ActiveDataProvider;
/**
 * Description of LogTransactionSearch
 *
 * @author khanhnq16
 */
class LogTransactionSearch extends LogTransaction{
    //put your code here
     /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['ERROR_CODE'], 'integer'],
            [['MSISDN', 'CREATED_TIME', 'ENDPOINT'], 'safe']
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
        
        $query = LogTransaction::find();
        $service = $params['LogTransactionSearch']['ENDPOINT'];
        if ($service != null) {
            $query->andWhere(['ENDPOINT' => $service]);
        }
//        var_dump($params);die;
        $endfrom = $params['LogTransactionSearch']['created_time_from'];
        $endto = $params['LogTransactionSearch']['created_time_to'];
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
        if ($params['LogTransactionSearch']['PRODUCT_CODE'] != null) {
            $query->andWhere(['like','PRODUCT_CODE',$params['LogTransactionSearch']['PRODUCT_CODE']]);
        }        
        if ($params['LogTransactionSearch']['MSISDN'] != null) {
            $query->andWhere(['like','MSISDN',$params['LogTransactionSearch']['MSISDN']]);
        }        
        if ($params['LogTransactionSearch']['ERROR_CODE'] != null) {
            $query->andWhere(['=','ERROR_CODE',$params['LogTransactionSearch']['ERROR_CODE']]);
        }        

        return $dataProvider;
    }
    
}
