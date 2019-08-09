<?php

namespace backend\controllers;

use backend\models\ProductForm;
use common\helper\SlugHelper;
use common\models\ProductTag;
use common\models\Tag;
use common\models\Urls;
use Yii;
use common\models\Product;
use backend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

//use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductForm();
        $modelUrls = new Urls();

        if ($model->load(Yii::$app->request->post()) && $modelUrls->load(Yii::$app->request->post())) {

            $modelUrls->type = Urls::PRODUCT;
            $modelUrls->created_at = time();
            if ($modelUrls->validate()) {
                if ($modelUrls->save()) {
                    $model->url_id = $modelUrls->id;

                    if (($model->unit_in_stock) < 0 || $model->unit_in_stock == null)
                        $model->unit_in_stock = 0;
                    if (($model->quantity_in_stock) < 0 || $model->quantity_in_stock == null)
                        $model->quantity_in_stock = 0;
                    if ($model->save()) {
                        if ($model->tags != null) {
                            foreach ($model->tags as $item) {
                                $tag = Tag::find()->where(['name' => $item])->one();
                                if (!isset($tag)) {
                                    $url = new Urls();
                                    $url->route = SlugHelper::to_slug($item);
                                    $url->type = Urls::TAG;
                                    $url->title = $item;
                                    $url->description = $item;
                                    $url->created_at = time();
                                    if ($url->validate()) {
                                        if ($url->save()) {
                                            $tag = new Tag();
                                            $tag->name = $item;
                                            $tag->url_id = $url->id;
                                            if ($tag->validate()) {
                                                $tag->save();
                                            }
                                        }
                                    }
                                    $model->addErrors($modelUrls->getErrors());
                                }
                                $productTag = new ProductTag();
                                $productTag->product_id = $model->id;
                                $productTag->tag_name = $item;
                                if ($productTag->validate()) {
                                    $productTag->save();
                                }
                            }
                        }
                        return $this->redirect('index');
                    } else {
                        $modelUrls->delete();
                        return $this->render('create', [
                            'model' => $model,
                            'modelUrls' => $modelUrls,
                        ]);
                    }

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
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelUrls = $model->urls;
        if($modelUrls == null)
        {
            $modelUrls = new Urls();

                $modelUrls->route = SlugHelper::to_slug($model->name);
                $modelUrls->type = Urls::PRODUCT;
                $modelUrls->created_at = time();
        }
        $tags = [];

        $productTag = $model->productTag;
        if (!empty($productTag)) {
            foreach ($productTag as $item) {
                $model->tags[] = $item->tag_name;
                $tags[] = $item->tag_name;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $modelUrls->load(Yii::$app->request->post())) {
            if ($model->tags != null) {
                foreach ($model->tags as $items) {
                    $productsTag = ProductTag::find()->where(['product_id' => $id, 'tag_name' => $items])->one();
                    if (!isset($productsTag)) {
                        $tag = Tag::find()->where(['name' => $items])->one();
                        if (!isset($tag)) {
                            $url = new Urls();
                            $url->route = SlugHelper::to_slug($items);
                            $url->type = Urls::TAG;
                            $url->title = $items;
                            $url->description = $items;
                            $url->created_at = time();
                            if ($url->validate()) {
                                if ($url->save()) {
                                    $tag = new Tag();
                                    $tag->name = $items;
                                    $tag->url_id = $url->id;
                                    if ($tag->validate()) {
                                        $tag->save();
                                    }
                                }
                            }
                        }
                        // Product <-> Tag relation , 1 2 3 Product , 1 2 TAG => 3 - 1
                        $productsTag = new ProductTag();
                        $productsTag->product_id = $id;
                        $productsTag->tag_name = $items;
                        $productsTag->save();
                    }
                }
                $diff = array_diff($tags, $model->tags);
                if ($diff != null) {
                    foreach ($diff as $itemDiff) {
                        $productsTag = ProductTag::find()->where(['product_id' => $id, 'tag_name' => $itemDiff])->one();
                        if ($productsTag) {
                            $productsTag->delete();
                        }
                    }

                }

            } else {
                $productTag = $model->productTag;
                if (!empty($productTag)) {
                    foreach ($productTag as $itemProductTag) {
                        $itemProductTag->delete();
                    }
                }
            }
            if ($model->quantity_in_stock == null)
                $model->quantity_in_stock = 0;
            if ($model->unit_in_stock == null)
                $model->unit_in_stock = 0;

            if ($modelUrls->validate() && $modelUrls->save()) {
                // check different id url with product
                if ($modelUrls->id != $model->url_id)
                {
                    $model->url_id = $modelUrls->id;
                }
                if ($model->validate() && $model->save()) {
                    return $this->redirect(['index']);

                }
            }
            $model->addErrors($modelUrls->getErrors());

            return $this->render('update', [
                'model' => $model,
                'modelUrls' => $modelUrls,
            ]);

        } else {
            return $this->render('update', [
                'model' => $model,
                'modelUrls' => $modelUrls,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $product = $this->findModel($id);
        $productName = "";
        if ($product)
        {
            $productName = $product->name;
            Yii::$app->session->setFlash('alert', [
                'options' => ['class' => 'alert-success'],
                'body' => Yii::t('backend', '{product_name} has been deleted....', ['product_name'=> $productName])
            ]);
            $product->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
