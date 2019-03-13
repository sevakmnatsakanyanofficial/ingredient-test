<?php

namespace app\modules\menu\controllers;

use app\models\DishIngredient;
use Yii;
use app\models\Dish;
use app\models\DishSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * DishController implements the CRUD actions for Dish model.
 */
class DishController extends Controller
{
    /**
     * Lists all Dish models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DishSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dish model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Dish model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dish();
        $rModel = new DishIngredient();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Dish::getDb()->beginTransaction();

            try {
                $model->save();

                $innerTransaction = DishIngredient::getDb()->beginTransaction();

                try {
                    foreach (Yii::$app->request->post('DishIngredient')['ingredient_id'] as $ingredient) {
                        $dModel = new DishIngredient();
                        $dModel->dish_id = $model->id;
                        $dModel->ingredient_id = (int)$ingredient;
                        $dModel->save();
                        unset($dModel);
                    }

                    $innerTransaction->commit();
                } catch (\Exception $e) {
                    $innerTransaction->rollBack();
                    throw new Exception('Error');
                }

                $transaction->commit();

                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\Exception $e) {
                $transaction->rollBack();
            }
        }

        return $this->render('create', [
            'model' => $model,
            'rModel' => $rModel
        ]);
    }

    /**
     * Updates an existing Dish model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $rModel = new DishIngredient();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Dish::getDb()->beginTransaction();

            try {
                $model->save();

                $innerTransaction = DishIngredient::getDb()->beginTransaction();

                try {
                    DishIngredient::deleteAll(['dish_id' => $model->id]);
                    foreach (Yii::$app->request->post('DishIngredient')['ingredient_id'] as $ingredient) {
                        $dModel = new DishIngredient();
                        $dModel->dish_id = $model->id;
                        $dModel->ingredient_id = (int)$ingredient;
                        $dModel->save();
                        unset($dModel);
                    }

                    $innerTransaction->commit();
                } catch (\Exception $e) {
                    $innerTransaction->rollBack();
                    throw new Exception('Error');
                }

                $transaction->commit();

                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\Exception $e) {
                $transaction->rollBack();
            }
        }

        return $this->render('update', [
            'model' => $model,
            'rModel' => $rModel
        ]);
    }

    /**
     * Deletes an existing Dish model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dish model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dish the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dish::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
