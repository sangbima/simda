<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BatchKiba;

/**
 * BatchKibaSearch represents the model behind the search form about `app\models\BatchKiba`.
 */
class BatchKibaSearch extends BatchKiba
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'gov_unit_id', 'product_group_sub2_id', 'code_start_num', 'province_id', 'kabupatenkota_id', 'kecamatan_id', 'desakelurahan_id', 'procure_type_id', 'excomp', 'certificate_status'], 'integer'],
            [['created_at', 'updated_at', 'code_main', 'address', 'procure_date', 'document_no', 'asset_recipient', 'semester', 'description', 'land_status', 'certificate_no', 'certificate_date', 'usage', 'size_unit'], 'safe'],
            [['price_base', 'price_capital', 'price_total', 'size'], 'number'],
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
        $query = BatchKiba::find();

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
            'price_base' => $this->price_base,
            'price_capital' => $this->price_capital,
            'price_total' => $this->price_total,
            'certificate_status' => $this->certificate_status,
            'certificate_date' => $this->certificate_date,
            'size' => $this->size,
        ]);

        $query->andFilterWhere(['like', 'code_main', $this->code_main])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'document_no', $this->document_no])
            ->andFilterWhere(['like', 'asset_recipient', $this->asset_recipient])
            ->andFilterWhere(['like', 'semester', $this->semester])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'land_status', $this->land_status])
            ->andFilterWhere(['like', 'certificate_no', $this->certificate_no])
            ->andFilterWhere(['like', 'usage', $this->usage])
            ->andFilterWhere(['like', 'size_unit', $this->size_unit]);

        return $dataProvider;
    }
}
