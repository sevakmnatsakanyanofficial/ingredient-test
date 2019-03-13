<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%ingredient}}".
 *
 * @property int $id
 * @property string $title
 * @property int $visible
 *
 * @property DishIngredient[] $dishIngredients
 */
class Ingredient extends \yii\db\ActiveRecord
{
    const VISIBLE = 1;
    const INVISIBLE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ingredient}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['visible'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
            ['visible', 'default', 'value' => self::VISIBLE],
            ['visible', 'in', 'range' => [self::INVISIBLE, self::VISIBLE]],
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
            'visible' => Yii::t('app', 'Visible'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDishIngredients()
    {
        return $this->hasMany(DishIngredient::className(), ['ingredient_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return IngredientQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IngredientQuery(get_called_class());
    }

    /**
     * Return all available values for visible key
     * @return array
     */
    public static function getVisibility()
    {
        return [
            self::VISIBLE => Yii::t('app','Visible'),
            self::INVISIBLE => Yii::t('app','Invisible')
        ];
    }
}
