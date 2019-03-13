<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DishIngredient;

/**
 * DishIngredientSearch represents the model behind the search form of `app\models\DishIngredient`.
 */
class DishIngredientSearch extends DishIngredient
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'dish_id', 'ingredient_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = DishIngredient::find();

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
            'dish_id' => $this->dish_id,
            'ingredient_id' => $this->ingredient_id,
        ]);

        return $dataProvider;
    }
}
