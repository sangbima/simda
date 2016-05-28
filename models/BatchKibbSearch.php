<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BatchKibb;

/**
 * BatchKibbSearch represents the model behind the search form about `app\models\BatchKibb`.
 */
class BatchKibbSearch extends BatchKibb
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'gov_unit_id', 'product_group_sub2_id', 'code_start_num', 'province_id', 'kabupatenkota_id', 'kecamatan_id', 'desakelurahan_id', 'procure_type_id', 'excomp', 'quantity', 'room_id'], 'integer'],
            [['created_at', 'updated_at', 'code_main', 'address', 'procure_date', 'procure_doc', 'asset_recipient', 'condition', 'semester', 'description', 'police_no', 'expired_date', 'legal_no', 'merk', 'type', 'assembly_year', 'engine_no', 'chassis_no', 'material'], 'safe'],
            [['latitude', 'longitude', 'price_base', 'price_capital', 'price_total'], 'number'],
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
        $query = BatchKibb::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'gov_unit_id' => $this->gov_unit_id,
            'product_group_sub2_id' => $this->product_group_sub2_id,
            'code_start_num' => $this->code_start_num,
            'province_id' => $this->province_id,
            'kabupatenkota_id' => $this->kabupatenkota_id,
            'kecamatan_id' => $this->kecamatan_id,
            'desakelurahan_id' => $this->desakelurahan_id,
            'procure_date' => $this->procure_date,
            'procure_type_id' => $this->procure_type_id,
            'excomp' => $this->excomp,
            'quantity' => $this->quantity,
            'price_base' => $this->price_base,
            'price_capital' => $this->price_capital,
            'price_total' => $this->price_total,
            'room_id' => $this->room_id,
            'expired_date' => $this->expired_date,
            'assembly_year' => $this->assembly_year,
        ]);

        $query->andFilterWhere(['like', 'code_main', $this->code_main])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'procure_doc', $this->procure_doc])
            ->andFilterWhere(['like', 'asset_recipient', $this->asset_recipient])
            ->andFilterWhere(['like', 'condition', $this->condition])
            ->andFilterWhere(['like', 'semester', $this->semester])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'police_no', $this->police_no])
            ->andFilterWhere(['like', 'legal_no', $this->legal_no])
            ->andFilterWhere(['like', 'merk', $this->merk])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'engine_no', $this->engine_no])
            ->andFilterWhere(['like', 'chassis_no', $this->chassis_no])
            ->andFilterWhere(['like', 'material', $this->material]);

        return $dataProvider;
    }
}
