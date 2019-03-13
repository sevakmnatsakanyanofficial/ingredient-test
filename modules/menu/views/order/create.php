<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\OrderForm */
/* @var $ingredients \app\models\Ingredient */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Order Dish');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'ingredients' => $ingredients,
        'dataProvider' => $dataProvider
    ]) ?>

</div>
