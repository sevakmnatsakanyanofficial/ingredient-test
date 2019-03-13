<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Ingredient]].
 *
 * @see Ingredient
 */
class IngredientQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @return IngredientQuery
     */
    public function visible()
    {
        return $this->andWhere('[[visible]]=:visible', [':visible' => Ingredient::VISIBLE]);
    }

    /**
     * {@inheritdoc}
     * @return Ingredient[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Ingredient|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
