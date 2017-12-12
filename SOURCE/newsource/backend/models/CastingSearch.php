<?php
namespace backend\models;
#Created by  Nguyen Quoc Khanh
#Created on Dec 12, 2017, 10:31:54 PM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.
use yii\data\ActiveDataProvider;
/**
 * Description of CastingSearch
 *
 * @author Nguyen Quoc Khanh
 */
class CastingSearch extends Casting{
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
        $query = Casting::find();
        $name = $params['CastingSearch']['name'];
        if ($name != null) {
            $query->andWhere(['like','name',$name]);
        }
//        var_dump($params);die;
        $endfrom = $params['CastingSearch']['end_time_from'];
        $endto = $params['CastingSearch']['end_time_to'];
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
