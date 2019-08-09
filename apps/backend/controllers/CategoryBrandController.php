<?php

namespace backend\controllers;

use common\models\Brand;
use common\models\Category;
use Yii;
use common\models\CategoryBrand;
use backend\models\CategoryBrandSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryBrandController implements the CRUD actions for CategoryBrand model.
 */
class CategoryBrandController extends Controller
{

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all CategoryBrand models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoryBrandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CategoryBrand model.
     * @param integer $category_id
     * @param integer $brand_id
     * @return mixed
     */
    public function actionView($category_id, $brand_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($category_id, $brand_id),
        ]);
    }

    /**
     * Creates a new CategoryBrand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CategoryBrand();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'category_id' => $model->category_id, 'brand_id' => $model->brand_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories'=>Category::find()->all(),
                'brands'=>Brand::find()->all(),
            ]);
        }
    }

    /**
     * Updates an existing CategoryBrand model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $category_id
     * @param integer $brand_id
     * @return mixed
     */
    public function actionUpdate($category_id, $brand_id)
    {
        $model = $this->findModel($category_id, $brand_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'category_id' => $model->category_id, 'brand_id' => $model->brand_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories'=>Category::find()->all(),
                'brands'=>Brand::find()->all(),
            ]);
        }
    }

    /**
     * Deletes an existing CategoryBrand model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $category_id
     * @param integer $brand_id
     * @return mixed
     */
    public function actionDelete($category_id, $brand_id)
    {
        $this->findModel($category_id, $brand_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CategoryBrand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $category_id
     * @param integer $brand_id
     * @return CategoryBrand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($category_id, $brand_id)
    {
        if (($model = CategoryBrand::findOne(['category_id' => $category_id, 'brand_id' => $brand_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
