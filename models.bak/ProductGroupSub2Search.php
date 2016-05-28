<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductGroupSub2;

/**
 * ProductGroupSub2Search represents the model behind the search form about `app\models\ProductGroupSub2`.
 */
class ProductGroupSub2Search extends ProductGroupSub2
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'product_group_sub1_id', 'benefit_year'], 'integer'],
            [['created_at', 'updated_at', 'code', 'name', 'code_acc'], 'safe'],
            [['shrink_percent'], 'number'],
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
        $query = ProductGroupSub2::find();

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
            'product_group_sub1_id' => $this->product_group_sub1_id,
            'benefit_year' => $this->benefit_year,
            'shrink_percent' => $this->shrink_percent,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code_acc', $this->code_acc]);

        return $dataProvider;
    }
}
