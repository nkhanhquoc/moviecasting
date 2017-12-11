<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\models;
use yii\data\ActiveDataProvider;
/**
 * Description of ServicesSearch
 *
 * @author khanhnq16
 */
class ServicesSearch extends Services{
    //put your code here
    public function rules() {
        return [
            [['USERNAME','SERVICE'], 'safe']
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
        $query = Services::find();
        if ($params['ServicesSearch']['USERNAME'] != null) {
            $query->andWhere(['like','USERNAME',$params['ServicesSearch']['USERNAME']]);
        }    
        if ($params['ServicesSearch']['SERVICE'] != null) {
            $query->andWhere(['like','SERVICE',$params['ServicesSearch']['SERVICE']]);
        }    
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }          
        
        return $dataProvider;
    }
}
