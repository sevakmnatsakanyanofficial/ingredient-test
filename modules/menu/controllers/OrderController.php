<?php

namespace app\modules\menu\controllers;

use app\models\DishIngredient;
use app\models\OrderForm;
use Yii;
use app\models\Ingredient;
use yii\data\ActiveDataProvider;

/**
 * OrderController implements the CRUD actions for Ingredient model.
 */
class OrderController extends MenuController
{
    public $defaultAction = 'step1';

    /**
     * Creates a new Ingredient model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionStep1()
    {
        $model = new OrderForm();

        $dataProvider = null;

        if ($model->load(Yii::$app->request->get()) && $model->validate()) {
            $dataProvider = new ActiveDataProvider([
                'query' => DishIngredient::find()
                    ->select(['*', 'count(*) AS count'])
                    ->where(['ingredient_id' => Yii::$app->request->get('ingredients')])
                    ->groupBy(['dish_id'])
                    ->orderBy(['count' => SORT_DESC]),
            ]);
        }

        $ingredients = Ingredient::find()->visible()->all();

        return $this->render('create', [
            'model' => $model,
            'ingredients' => $ingredients,
            'dataProvider' => $dataProvider
        ]);
    }
}
