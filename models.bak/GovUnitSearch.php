<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GovUnit;

/**
 * GovUnitSearch represents the model behind the search form about `app\models\GovUnit`.
 */
class GovUnitSearch extends GovUnit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'gov_privilege_id', 'province_id', 'kabupatenkota_id', 'kecamatan_id', 'desakelurahan_id'], 'integer'],
            [['created_at', 'updated_at', 'code', 'name', 'code_acc', 'address', 'postal_code', 'phone', 'pic_name', 'pic_nip', 'pic_title', 'keeper_name', 'keeper_nip', 'keeper_title'], 'safe'],
            [['latitude', 'longitude'], 'number'],
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
        $query = GovUnit::find();

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
            'gov_privilege_id' => $this->gov_privilege_id,
            'province_id' => $this->province_id,
            'kabupatenkota_id' => $this->kabupatenkota_id,
            'kecamatan_id' => $this->kecamatan_id,
            'desakelurahan_id' => $this->desakelurahan_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code_acc', $this->code_acc])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'postal_code', $this->postal_code])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'pic_name', $this->pic_name])
            ->andFilterWhere(['like', 'pic_nip', $this->pic_nip])
            ->andFilterWhere(['like', 'pic_title', $this->pic_title])
            ->andFilterWhere(['like', 'keeper_name', $this->keeper_name])
            ->andFilterWhere(['like', 'keeper_nip', $this->keeper_nip])
            ->andFilterWhere(['like', 'keeper_title', $this->keeper_title]);

        return $dataProvider;
    }
}
