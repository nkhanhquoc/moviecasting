<?php
namespace backend\models;
#Created by  Nguyen Quoc Khanh
#Created on Dec 14, 2017, 9:49:56 PM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.
use yii\data\ActiveDataProvider;
/**
 * Description of NewsSearch
 *
 * @author Nguyen Quoc Khanh
 */
class NewsSearch extends News{
    //put your code here
    //put your code here
    public function rules() {
        return [
            [['name', 'created_time'], 'safe']
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
        $query = News::find();
        $name = $params['NewsSearch']['title'];
        if ($name != null) {
            $query->andWhere(['like','title',$name]);
        }
//        var_dump($params);die;
        $endfrom = $params['NewsSearch']['end_time_from'];
        $endto = $params['NewsSearch']['end_time_to'];
        if ($endfrom != null) {
            $query->andWhere('created_time >= :from ', ['from' => date('Y-m-d', strtotime($endfrom))]);
        }
        if ($endto != null) {
            $query->andWhere('created_time <= :to ', ['to' => date('Y-m-d', strtotime($endto))]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
//     
        return $dataProvider;
    }
}
