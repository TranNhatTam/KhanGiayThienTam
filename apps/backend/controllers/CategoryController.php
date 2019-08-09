<?php

namespace backend\controllers;

use common\models\Brand;
use common\models\CategoryBrand;
use common\models\Product;
use common\models\Urls;
use Yii;
use common\models\Category;
use backend\models\CategorySearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        $modelUrls = new Urls();

        if ($model->load(Yii::$app->request->post()) && $modelUrls->load(Yii::$app->request->post())) {
            $modelUrls->type = Urls::CATEGORY;
            $modelUrls->created_at = time();
            if ($modelUrls->validate()) {
                if ($modelUrls->save()) {
                    $model->url_id = $modelUrls->id;
                    if ($model->save()) {
                        if ($model->brands != null) {
                            foreach ($model->brands as $item) {
                                $categoryBrand = new CategoryBrand();
                                $categoryBrand->category_id = $model->id;
                                $categoryBrand->brand_id = $item;
                                $categoryBrand->save();
                            }
                        }

                    }
                    return $this->redirect(['index']);
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'modelUrls' => $modelUrls,
                ]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
                'modelUrls' => $modelUrls,
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $query = Product::find()->where(['category_id' => $id])->orderBy(['priority' => SORT_ASC])->visible();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);


//        $product = Product::find()->where(['category_id' => $id])->visible()->all();
        $model = $this->findModel($id);
        $modelUrls = Urls::find()->where(['id' => $model->url_id])->one();
        $brands = [];
//        $tt=CategoryBrand::find()->select('brand_id')->where(['category_id'=>$id])->all();
//        var_dump($tt);die;
        $categoryBrand = CategoryBrand::find()->where(['category_id' => $id])->all();
        if (!empty($categoryBrand)) {
            foreach ($categoryBrand as $item) {
                $model->brands[] = $item->brand_id;
                $brands[] = $item->brand_id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $modelUrls->load(Yii::$app->request->post())) {
            if ($model->brands != null) {
                foreach ($model->brands as $items) {
                    $categoryBrand = CategoryBrand::find()->where(['category_id' => $id, 'brand_id' => $items])->one();
                    if (!isset($categoryBrand)) {
                        $categoryBrands = new CategoryBrand();
                        $categoryBrands->category_id = $id;
                        $categoryBrands->brand_id = $items;
                        $categoryBrands->save();
                    }
                }
                $diff = array_diff($brands, $model->brands);
                if ($diff != null) {
                    foreach ($diff as $itemDiff) {
                        $categoryBrandes = CategoryBrand::find()->where(['category_id' => $id, 'brand_id' => $itemDiff])->one();
                        if ($categoryBrandes) {
                            $categoryBrandes->delete();
                        }
                    }

                }

            } else {
                $categoryBran = CategoryBrand::find()->where(['category_id' => $id])->all();
                foreach ($categoryBran as $item) {
                    $item->delete();
                }
            }
            $model->save();
            $modelUrls->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelUrls' => $modelUrls,
                'dataProvider' => $dataProvider,
//                'brands'=>Brand::find()->where(['id'=>$id])->all(),
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $category = $this->findModel($id);
        $category->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionRemoveProduct($p_id, $c_id)
    {
        $product = Product::find()->where(['id' => $p_id])->one();
        if ($product != null) {
            $product->category_id = 0;

            if ($product->save()) {
                Yii::$app->session->setFlash('success','Gỡ bỏ sản phẩm ra khỏi nhóm thành công.');
                return $this->redirect('/category/update?id='.$c_id);
            } else {
                Yii::$app->session->setFlash('error','Gỡ bỏ sản phẩm ra khỏi nhóm thất bại.');
                return $this->redirect('/category/update?id='.$c_id);
            }
        }

        return $this->redirect('/category/update?id='.$c_id);
    }

    public function actionAddProduct()
    {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $c_id = $request->post('CategoryID');
            $p_id = $request->post('ProductID');
            foreach ($p_id as $item) {
                $product = Product::find()->where(['id'=>$item])->one();
                if ($product) {
                    $product->category_id = $c_id;
                    $product->save();
                }
            }
            Yii::$app->session->setFlash('success','Thêm sản phẩm thành công.');
            return $this->redirect('/category/update?id='.$c_id);
        }
    }
}
