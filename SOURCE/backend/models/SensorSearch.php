<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Sensor;

/**
 * SensorSearch represents the model behind the search form about `backend\models\Sensor`.
 */
class SensorSearch extends Sensor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'module_id'], 'integer'],
            [['cam_bien_dan_thu', 'cam_bien_bon_solar', 'cam_bien_muc_nuoc_bon_solar', 'cam_bien_nhiet_do_bon_gia_nhiet', 'cam_bien_ap_suat_bon_gia_nhiet', 'cam_bien_ap_suat_duong_ong', 'cam_bien_nhiet_do_duong_ong', 'cam_bien_nhiet_dinh_bon_solar', 'cam_bien_tran', 'du_phong'], 'safe'],
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
        $query = Sensor::find();

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

        $query->andFilterWhere(['like', 'cam_bien_dan_thu', $this->cam_bien_dan_thu])
            ->andFilterWhere(['like', 'cam_bien_bon_solar', $this->cam_bien_bon_solar])
            ->andFilterWhere(['like', 'cam_bien_muc_nuoc_bon_solar', $this->cam_bien_muc_nuoc_bon_solar])
            ->andFilterWhere(['like', 'cam_bien_nhiet_do_bon_gia_nhiet', $this->cam_bien_nhiet_do_bon_gia_nhiet])
            ->andFilterWhere(['like', 'cam_bien_ap_suat_bon_gia_nhiet', $this->cam_bien_ap_suat_bon_gia_nhiet])
            ->andFilterWhere(['like', 'cam_bien_ap_suat_duong_ong', $this->cam_bien_ap_suat_duong_ong])
            ->andFilterWhere(['like', 'cam_bien_nhiet_do_duong_ong', $this->cam_bien_nhiet_do_duong_ong])
            ->andFilterWhere(['like', 'cam_bien_nhiet_dinh_bon_solar', $this->cam_bien_nhiet_dinh_bon_solar])
            ->andFilterWhere(['like', 'cam_bien_tran', $this->cam_bien_tran])
            ->andFilterWhere(['like', 'du_phong', $this->du_phong]);

        return $dataProvider;
    }
}
