<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RuntimeStatistics;

/**
 * RuntimeStatisticsSearch represents the model behind the search form about `backend\models\RuntimeStatistics`.
 */
class RuntimeStatisticsSearch extends RuntimeStatistics
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'module_id'], 'integer'],
            [['time_bom_doi_luu_1', 'time_bom_doi_luu_2', 'time_chay_bom_cap_nuoc_lanh_1', 'time_chay_bom_cap_nuoc_lanh_2', 'time_chay_bom_hoi_duong_ong_1', 'time_chay_bom_hoi_duong_ong_2', 'time_chay_bom_tang_ap_1', 'time_chay_bom_tang_ap_2', 'time_chay_bom_nhiet_bon_gia_nhiet_1', 'time_chay_bom_nhiet_bon_gia_nhiet_2', 'time_chay_van_dien_tu_ba_nga', 'time_chay_van_dien_tu_mot_chieu', 'du_phong'], 'safe'],
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
        $query = RuntimeStatistics::find();

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

        $query->andFilterWhere(['like', 'time_bom_doi_luu_1', $this->time_bom_doi_luu_1])
            ->andFilterWhere(['like', 'time_bom_doi_luu_2', $this->time_bom_doi_luu_2])
            ->andFilterWhere(['like', 'time_chay_bom_cap_nuoc_lanh_1', $this->time_chay_bom_cap_nuoc_lanh_1])
            ->andFilterWhere(['like', 'time_chay_bom_cap_nuoc_lanh_2', $this->time_chay_bom_cap_nuoc_lanh_2])
            ->andFilterWhere(['like', 'time_chay_bom_hoi_duong_ong_1', $this->time_chay_bom_hoi_duong_ong_1])
            ->andFilterWhere(['like', 'time_chay_bom_hoi_duong_ong_2', $this->time_chay_bom_hoi_duong_ong_2])
            ->andFilterWhere(['like', 'time_chay_bom_tang_ap_1', $this->time_chay_bom_tang_ap_1])
            ->andFilterWhere(['like', 'time_chay_bom_tang_ap_2', $this->time_chay_bom_tang_ap_2])
            ->andFilterWhere(['like', 'time_chay_bom_nhiet_bon_gia_nhiet_1', $this->time_chay_bom_nhiet_bon_gia_nhiet_1])
            ->andFilterWhere(['like', 'time_chay_bom_nhiet_bon_gia_nhiet_2', $this->time_chay_bom_nhiet_bon_gia_nhiet_2])
            ->andFilterWhere(['like', 'time_chay_van_dien_tu_ba_nga', $this->time_chay_van_dien_tu_ba_nga])
            ->andFilterWhere(['like', 'time_chay_van_dien_tu_mot_chieu', $this->time_chay_van_dien_tu_mot_chieu])
            ->andFilterWhere(['like', 'du_phong', $this->du_phong]);

        return $dataProvider;
    }
}
