<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BatchKibe;

/**
 * BatchKibeSearch represents the model behind the search form about `app\models\BatchKibe`.
 */
class BatchKibeSearch extends BatchKibe
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'gov_unit_id', 'product_group_sub2_id', 'code_start_num', 'province_id', 'kabupatenkota_id', 'kecamatan_id', 'desakelurahan_id', 'procure_type_id', 'excomp', 'quantity', 'room_id'], 'integer'],
            [['created_at', 'updated_at', 'code_main', 'address', 'procure_date', 'procure_doc', 'asset_recipient', 'condition', 'semester', 'description', 'book_title', 'book_publisher', 'book_author', 'specification', 'edition', 'publish_year'], 'safe'],
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
        $query = BatchKibe::find();

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
            'publish_year' => $this->publish_year,
        ]);

        $query->andFilterWhere(['like', 'code_main', $this->code_main])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'procure_doc', $this->procure_doc])
            ->andFilterWhere(['like', 'asset_recipient', $this->asset_recipient])
            ->andFilterWhere(['like', 'condition', $this->condition])
            ->andFilterWhere(['like', 'semester', $this->semester])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'book_title', $this->book_title])
            ->andFilterWhere(['like', 'book_publisher', $this->book_publisher])
            ->andFilterWhere(['like', 'book_author', $this->book_author])
            ->andFilterWhere(['like', 'specification', $this->specification])
            ->andFilterWhere(['like', 'edition', $this->edition]);

        return $dataProvider;
    }
}
