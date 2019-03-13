<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\OrderForm */
/* @var $form yii\widgets\ActiveForm */
/* @var $ingredients \app\models\Ingredient */
/* @var $dataProvider \yii\data\ActiveDataProvider */
?>

<div class="ingredient-form">

    <?php $form = ActiveForm::begin(['method' => 'get']); ?>

    <?= $form->field($model, 'ingredients[]')
        ->dropDownList(\yii\helpers\ArrayHelper::map($ingredients, 'id', 'title'),
            [
                'multiple' => 'multiple',
            ]
        ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Next'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
    if ($dataProvider) {
        echo \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'dish.title',
            ],
        ]);
    }
    ?>

</div>
