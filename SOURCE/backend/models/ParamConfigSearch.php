<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ParamConfig;

/**
 * ParamConfigSearch represents the model behind the search form about `backend\models\ParamConfig`.
 */
class ParamConfigSearch extends ParamConfig
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'module_id', 'updated_by', 'created_by'], 'integer'],
            [['convection_pump', 'cold_water_supply_pump', 'return_pump', 'incresed_pressure_pump', 'heat_pump', 'heat_resistor', 'three_way_valve', 'backflow_valve', 'updated_at', 'created_at'], 'safe'],
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
        $query = ParamConfig::find();

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
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'convection_pump', $this->convection_pump])
            ->andFilterWhere(['like', 'cold_water_supply_pump', $this->cold_water_supply_pump])
            ->andFilterWhere(['like', 'return_pump', $this->return_pump])
            ->andFilterWhere(['like', 'incresed_pressure_pump', $this->incresed_pressure_pump])
            ->andFilterWhere(['like', 'heat_pump', $this->heat_pump])
            ->andFilterWhere(['like', 'heat_resistor', $this->heat_resistor])
            ->andFilterWhere(['like', 'three_way_valve', $this->three_way_valve])
            ->andFilterWhere(['like', 'backflow_valve', $this->backflow_valve]);

        return $dataProvider;
    }
}
