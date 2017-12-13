<?php
namespace backend\models;
#Created by  Nguyen Quoc Khanh
#Created on Dec 13, 2017, 9:42:51 PM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.
use Yii;
use yii\data\ActiveDataProvider;
/**
 * Description of RegisterSearch
 *
 * @author Nguyen Quoc Khanh
 */
class RegisterSearch extends Register{
    //put your code here
     public function rules() {
        return [
            [['casting_id', 'genre','status','star'], 'integer'],
            [['created_time'], 'safe']
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
        
        $query = Register::find();
        $castingid = $params['RegisterSearch']['casting_id'];
        if ($castingid != null) {
            $query->andWhere(['casting_id' => $castingid]);
        }
//        var_dump($params);die;
        $endfrom = $params['RegisterSearch']['created_time_from'];
        $endto = $params['RegisterSearch']['created_time_to'];
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
        
        if ($params['RegisterSearch']['status'] != null) {
            $query->andWhere(['=','status',$params['RegisterSearch']['status']]);
        }  
        if ($params['RegisterSearch']['star'] != null) {
            $query->andWhere(['=','star',$params['RegisterSearch']['star']]);
        }  
        return $dataProvider;
    }
}
