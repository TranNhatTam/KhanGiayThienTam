<?php

namespace backend\controllers;

use backend\models\OrderDetailsSearch;
use backend\models\OrderItem;
use backend\models\OrdersSearch;
use backend\models\ProductItem;
use common\models\District;
use common\models\OrderDetails;
use common\models\Orders;
use common\models\Product;
use common\models\Ward;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
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
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new OrderDetailsSearch();
        $searchModel->order_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();
        $cart = Yii::$app->cart;
        if (!Yii::$app->request->isPjax && Yii::$app->request->isGet) {
            Yii::$app->cart->clear();
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->order_date = date('Y-m-d H:i:s');
            if ($model->description == "Chuyển khoản qua ngân hàng"){
                $model->type = "BankDeposit";
            } else {
                $model->type = "COD";
            }
            $model->freight = $model->ship;
            if ($model->save()){
                $items = $cart->getItems();
                // Check exist product
                /** @var OrderItem $item */
                foreach ($items as $item) {
                    // access any attribute/method from the model
                    $item->order_id = $model->id;
                    $item->unit_price = $item->getPrice();
                    $item->total_price = $item->getTotalPrice();
                    $item->tax_value = 0;
                    $item->discount = 0;
                    if ($item->validate())
                    {
                        $item->save();

                    }
                    else
                    {
                        Yii::debug($item->getErrors());
                    }

                    // remove an item from the cart by its ID
//            $cart->remove($item->uniqueId);
                }
                $cart->clear();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $orderDetail = OrderDetails::find()->where(['order_id' => $id])->all();
        foreach ($orderDetail as $item) {
            $item->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpdateShipAddress($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    public function actionUpdateNote($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    public function actionEditShipStatus($id)
    {
        Yii::$app->response->format = 'json';
        $model = $this->findModel($id);
        if (Yii::$app->request->isAjax) {
            $status = Yii::$app->request->post('Orders')['ship_status'];
            $model->ship_status = $status;
            $model->save();
        }
        return ['output' => '', 'message' => ''];
    }

    public function actionEditPaymentStatus($id)
    {
        Yii::$app->response->format = 'json';
        $model = $this->findModel($id);
        if (Yii::$app->request->isAjax) {
            $status = Yii::$app->request->post('Orders')['payment_status'];
            $model->payment_status = $status;
            $model->save();
        }
        return ['output' => '', 'message' => ''];
    }

    public function actionEditStatus($id)
    {
        Yii::$app->response->format = 'json';
        $model = $this->findModel($id);
        if (Yii::$app->request->isAjax) {
            $status = Yii::$app->request->post('Orders')['status'];
            $model->status = $status;
            $model->save();
        }
        return ['output' => '', 'message' => ''];
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
            // Check exist product
            foreach ($items as $item) {
                // access any attribute/method from the model
                if ($item->getUniqueId() == $id) {
                    $item->quantity = $item->quantity + $quantity;
                    Yii::$app->cart->add($item);
                    $isNewAdd = false;
                    break;
                }
                // remove an item from the cart by its ID
//            $cart->remove($item->uniqueId);
            }
            if ($isNewAdd) {
                $modelOrderItem = new OrderItem();
                $modelOrderItem->product_id = $id;
                $modelOrderItem->quantity = $quantity;
                Yii::$app->cart->add($modelOrderItem);
            }
        }
        $totalPrice  = $cart->getAttributeTotal('totalPrice');
        return ['totalPrice' => $totalPrice];
    }

    public function actionShowAddProduct()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            return $this->render('_tableDetailAddProduct');
        }
    }

    public function actionRemoveProductCart()
    {
        Yii::$app->response->format = 'json';
        $cart = Yii::$app->cart;
        $request = Yii::$app->request;
        if ($request->isGet)
        {
            return $this->redirect(['orders/index']);
        }
        $id = $request->post('id');
        if ($id == null) {
            return $this->redirect(['orders/index']);
        }
        $items = $cart->getItems();
        foreach ($items as $item) {
            // access any attribute/method from the model
            if ($item->uniqueId == $id) {
                $cart->remove($item->uniqueId);
            }
            // remove an item from the cart by its ID
//            $cart->remove($item->uniqueId);
        }
        $totalPrice  = $cart->getAttributeTotal('totalPrice');
        return ['totalPrice' => $totalPrice];
    }

    public function actionUpdateAddProduct($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->products == null) return $this->redirect(['view', 'id' => $model->id]);
            $quantity = Yii::$app->request->post('quantity');
            $orderDetailModel = OrderDetails::find()->where(['order_id'=>$id,'product_id'=>$model->products])->one();
            if (isset($orderDetailModel)) {
                $orderDetailModel->quantity = $orderDetailModel->quantity + $quantity;
                $orderDetailModel->total_price = $orderDetailModel->unit_price * $orderDetailModel->quantity;
                $orderDetailModel->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $orderDetail = new OrderDetails();
                $orderDetail->order_id = $id;
                $orderDetail->product_id = $model->products;
                $product = Product::find()->where(['id'=>$model->products])->one();
                if ($product) {
                    $orderDetail->unit_price = $product->unit_price;
                } else {
                    $orderDetail->unit_price = 0;
                }
                $orderDetail->quantity = $quantity;
                $orderDetail->tax_value = 0;
                $orderDetail->discount = 0;
                $orderDetail->total_price = $orderDetail->unit_price * $orderDetail->quantity;
                if ($orderDetail->validate()) {
                    if ($orderDetail->save()) {
                        $model->total_price = $model->total_price + $orderDetail->total_price;
                        if ($model->save()){
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    }
                }
            }
        } else {
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    public function actionDeleteOrdersDetail($id)
    {
        $order_id = 0;
        $orderDetailModel = OrderDetails::find()->where(['id'=>$id])->one();
        if ($orderDetailModel) {
            $order_id = $orderDetailModel->order_id;
           if ($orderDetailModel->delete()){
               return $this->redirect(['view', 'id' => $order_id]);
           }

        }
    }

    public function actionSubcat() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getSubCatList($cat_id);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionProd() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $cat_id = empty($ids[0]) ? null : $ids[0];
            $subcat_id = empty($ids[1]) ? null : $ids[1];
            if ($cat_id != null) {
                $data = self::getProdList($subcat_id);
                /**
                 * the getProdList function will query the database based on the
                 * cat_id and sub_cat_id and return an array like below:
                 *  [
                 *      'out'=>[
                 *          ['id'=>'<prod-id-1>', 'name'=>'<prod-name1>'],
                 *          ['id'=>'<prod_id_2>', 'name'=>'<prod-name2>']
                 *       ],
                 *       'selected'=>'<prod-id-1>'
                 *  ]
                 */

                echo Json::encode(['output'=>$data['out'], 'selected'=>$data['selected']]);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    private function getSubCatList($cat_id){
        $out = [];
        $district = District::find()->where(['province_id'=>$cat_id])->all();
        foreach ($district as $item){
            $out[] = ['id'=>$item->id,'name'=>$item->name];
        }
        return $out;
    }

    private function getProdList($subcat_id){
        $out = [];
        $ward = Ward::find()->where(['district_id'=>$subcat_id])->all();
        foreach ($ward as $item) {
            $out[] = ['id'=>$item->id,'name'=>$item->name];
        }
        return ['out' => $out,'selected'=>null];
    }
}
