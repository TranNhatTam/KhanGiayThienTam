<?php

namespace backend\controllers;

use backend\models\OrderItem;
use backend\models\search\OrderDetailSearch;
use common\models\Orders;
use Yii;
use common\models\Order;
use backend\models\search\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new OrderDetailSearch();
        $searchModel->order_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();
        $cart = Yii::$app->cart;

        if ($model->load(Yii::$app->request->post())) {
            $model->order_date = date('Y-m-d H:i:s');
            if ($model->save()) {
                $items = $cart->getItems();
                /** @var OrderItem $item */
                foreach ($items as $item) {
                    // access any attribute/method from the model
                    $item->order_id = $model->id;
                    $item->unit_price = $item->getPrice();
                    $item->total_price = $item->getTotalPrice();
                    $item->tax_value = 0;
                    $item->discount = 0;
                    if ($item->validate()) {
                        $item->save();
                    } else {
                        Yii::debug($item->getErrors());
                    }
                }
            }
            $cart->clear();

            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAddProduct()
    {
        Yii::$app->response->format = 'json';
        $request = Yii::$app->request;
        $cart = Yii::$app->cart;

        if ($request->isAjax) {
            $id = $request->post('id');
            $quantity = $request->post('quantity');
            if ($id == null) {
                return $this->render('_tableDetailAddProduct');
            }
            $isNewAdd = true;
            $items = $cart->getItems();
            foreach ($items as $item) {
                if ($item->uniqueId == $id) {
                    $item->quantity = $item->quantity + $quantity;
                    Yii::$app->cart->add($item);
                    $isNewAdd = false;
                    break;
                }
            }
            if ($isNewAdd) {
                $modelOrderItem = new OrderItem();
                $modelOrderItem->product_id = $id;
                $modelOrderItem->quantity = $quantity;
                Yii::$app->cart->add($modelOrderItem);
            }
        }
        $totalPrice = $cart->getAttributeTotal('totalPrice');
        return ['totalPrice' => $totalPrice];
    }

    public function actionRemoveProductCart()
    {
        Yii::$app->response->format = 'json';
        $cart = Yii::$app->cart;
        $request = Yii::$app->request;
        if ($request->isGet) {
            return $this->redirect(['orders/index']);
        }
        $id = $request->post('id');
        if ($id == null) {
            return $this->redirect(['orders/index']);
        }
        $items = $cart->getItems();
        foreach ($items as $item) {
            if ($item->uniqueId == $id) {
                $cart->remove($item->uniqueId);
            }
        }
        $totalPrice = $cart->getAttributeTotal('totalPrice');
        return ['totalPrice' => $totalPrice];
    }
}
