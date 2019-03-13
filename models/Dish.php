<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%dish}}".
 *
 * @property int $id
 * @property string $title
 *
 * @property DishIngredient[] $dishIngredients
 */
class Dish extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%dish}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDishIngredients()
    {
        return $this->hasMany(DishIngredient::className(), ['dish_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return DishQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DishQuery(get_called_class());
    }

    /**
     * Return ingredients list as string
     * @return string
     */
    public function getIngredientsList()
    {
        $result = '';
        foreach ($this->dishIngredients as $ingredient) {
            $result = $result . $ingredient->ingredient->title . ', ';
        }
        return $result;
    }
}
