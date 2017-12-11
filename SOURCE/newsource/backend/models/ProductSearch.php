<?php

namespace backend\models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\data\ActiveDataProvider;

/**
 * Description of ProductSearch
 *
 * @author khanhnq16
 */
class ProductSearch extends Product {

    //put your code here
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['VAS_SERVICE_ID', 'CATEGORY'], 'integer'],
            [['NAME', 'CREATED_TIME', 'UPDATED_TIME'], 'safe']
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
        $query = Product::find();
        $service = $params['ProductSearch']['VAS_SERVICE_ID'];
        if ($service != null) {
            $query->andWhere(['VAS_SERVICE_ID' => $service]);
        }
//        var_dump($params);die;
        $endfrom = $params['ProductSearch']['end_time_from'];
        $endto = $params['ProductSearch']['end_time_to'];
        if ($endfrom != null) {
            $query->andWhere('END_TIME >= :from ', ['from' => date('Y-m-d', strtotime($endfrom))]);
        }
        if ($endto != null) {
            $query->andWhere('END_TIME <= :to ', ['to' => date('Y-m-d', strtotime($endto))]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

//        var_dump($params);die;
        if ($params['ProductSearch']['NAME'] != null) {
            $query->andWhere(['like','NAME',$params['ProductSearch']['NAME']]);
        }
        if ($params['ProductSearch']['CATEGORY'] != null) {
            $query->andWhere(['like','CATEGORY',$params['ProductSearch']['CATEGORY']]);
        }
        if ($params['ProductSearch']['STATUS'] != null) {
            $query->andWhere(['STATUS' => $params['ProductSearch']['STATUS']]);
        }

        return $dataProvider;
    }

    public function getVasService() {
        $query = VasService::find()->all();
        $list = [];
        if ($query) {
            foreach ($query as $vasService) {
                $list[$vasService->ID] = $vasService->NAME;
            }
        }
        return $list;
    }  

}
