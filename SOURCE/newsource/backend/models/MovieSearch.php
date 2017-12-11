<?php
namespace backend\models;
#Created by  Nguyen Quoc Khanh
#Created on Dec 11, 2017, 4:44:50 PM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\FileHelper;
use common\libs\Images;
use yii\data\ActiveDataProvider;
/**
#Created by  Nguyen Quoc Khanh
#Created on Dec 11, 2017, 4:49:13 PM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.

/**
 * Description of MovieSearch
 *
 * @author Nguyen Quoc Khanh
 */
class MovieSearch extends Movie{
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
        $query = Movie::find();
        $name = $params['MovieSearch']['name'];
        if ($name != null) {
            $query->andWhere(['like','name',$name]);
        }
//        var_dump($params);die;
        $endfrom = $params['MovieSearch']['end_time_from'];
        $endto = $params['MovieSearch']['end_time_to'];
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
