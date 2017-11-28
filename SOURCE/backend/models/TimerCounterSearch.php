<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TimerCounter;

/**
 * TimerCounterSearch represents the model behind the search form about `backend\models\TimerCounter`.
 */
class TimerCounterSearch extends TimerCounter
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'module_id'], 'integer'],
            [['counter', 'timer_1', 'timer_2', 'timer_3'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TimerCounter::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'module_id' => $this->module_id,
        ]);

        $query->andFilterWhere(['like', 'counter', $this->counter])
            ->andFilterWhere(['like', 'timer_1', $this->timer_1])
            ->andFilterWhere(['like', 'timer_2', $this->timer_2])
            ->andFilterWhere(['like', 'timer_3', $this->timer_3]);

        return $dataProvider;
    }
}
