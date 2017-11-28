<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ModuleStatus;

/**
 * ModuleStatusSearch represents the model behind the search form about `backend\models\ModuleStatus`.
 */
class ModuleStatusSearch extends ModuleStatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'module_id'], 'integer'],
            [['bom_doi_luu_1', 'bom_doi_luu_2', 'bom_cap_nuoc_lanh_1', 'bom_cap_nuoc_lanh_2', 'bom_hoi_duong_ong_1', 'bom_hoi_duong_ong_2', 'bom_tang_ap_1', 'bom_tang_ap_2', 'bom_ha_nhiet_bon_gia_nhiet_1', 'bom_ha_nhiet_bon_gia_nhiet_2', 'van_dien_tu_ba_nga', 'van_dien_tu_mot_chieu'], 'safe'],
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
        $query = ModuleStatus::find();

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

        $query->andFilterWhere(['like', 'bom_doi_luu_1', $this->bom_doi_luu_1])
            ->andFilterWhere(['like', 'bom_doi_luu_2', $this->bom_doi_luu_2])
            ->andFilterWhere(['like', 'bom_cap_nuoc_lanh_1', $this->bom_cap_nuoc_lanh_1])
            ->andFilterWhere(['like', 'bom_cap_nuoc_lanh_2', $this->bom_cap_nuoc_lanh_2])
            ->andFilterWhere(['like', 'bom_hoi_duong_ong_1', $this->bom_hoi_duong_ong_1])
            ->andFilterWhere(['like', 'bom_hoi_duong_ong_2', $this->bom_hoi_duong_ong_2])
            ->andFilterWhere(['like', 'bom_tang_ap_1', $this->bom_tang_ap_1])
            ->andFilterWhere(['like', 'bom_tang_ap_2', $this->bom_tang_ap_2])
            ->andFilterWhere(['like', 'bom_ha_nhiet_bon_gia_nhiet_1', $this->bom_ha_nhiet_bon_gia_nhiet_1])
            ->andFilterWhere(['like', 'bom_ha_nhiet_bon_gia_nhiet_2', $this->bom_ha_nhiet_bon_gia_nhiet_2])
            ->andFilterWhere(['like', 'van_dien_tu_ba_nga', $this->van_dien_tu_ba_nga])
            ->andFilterWhere(['like', 'van_dien_tu_mot_chieu', $this->van_dien_tu_mot_chieu]);

        return $dataProvider;
    }
}
