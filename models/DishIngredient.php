<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%dish_ingredient}}".
 *
 * @property int $id
 * @property int $dish_id
 * @property int $ingredient_id
 *
 * @property Dish $dish
 * @property Ingredient $ingredient
 */
class DishIngredient extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%dish_ingredient}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dish_id', 'ingredient_id'], 'required'],
            [['dish_id', 'ingredient_id'], 'integer'],
            [['dish_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dish::className(), 'targetAttribute' => ['dish_id' => 'id']],
            [['ingredient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredient::className(), 'targetAttribute' => ['ingredient_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'dish_id' => Yii::t('app', 'Dish ID'),
            'ingredient_id' => Yii::t('app', 'Ingredient ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDish()
    {
        return $this->hasOne(Dish::className(), ['id' => 'dish_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredient()
    {
        return $this->hasOne(Ingredient::className(), ['id' => 'ingredient_id']);
    }

    /**
     * {@inheritdoc}
     * @return DishIngredientQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DishIngredientQuery(get_called_class());
    }
}
