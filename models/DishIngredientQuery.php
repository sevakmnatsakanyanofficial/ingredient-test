<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[DishIngredient]].
 *
 * @see DishIngredient
 */
class DishIngredientQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return DishIngredient[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DishIngredient|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
