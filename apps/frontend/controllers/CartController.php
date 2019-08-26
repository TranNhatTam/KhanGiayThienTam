<?php
/**
 * Created by PhpStorm.
 * User: SMART DIGITECH
 * Date: 10/18/2018
 * Time: 10:33 PM
 */

namespace frontend\controllers;


use common\models\Product;
use frontend\models\CartForm;
use frontend\models\CartItem;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

class CartController extends Controller
{
    public function actionAddToCart($id, $quantity = 1)
    {
        $cart = CartItem::findOne($id);
        if ($cart) {
            Yii::$app->carts->create($cart, $quantity);
        }
        return $this->redirect('index');
    }

    public function actionAddCart($id, $quantity = 1)
    {
        Yii::$app->response->format = 'json';
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $id = $request->get('id');
            $quantity = $request->get('quantity');
            $cart = CartItem::findOne($id);
            if ($cart) {
                Yii::$app->carts->create($cart, $quantity);
            }
            return ['result' => 'success'];
        }

        return ['result' => 'fail'];
    }

    public function actionIndex()
    {
        $cart = Yii::$app->carts;
        $num = $cart->getCount();
        $model = new CartForm();
        $carts = $cart->getItems();
        if ($num == 0) {
            return $this->redirect('/site/index');
        }
        return $this->render('index', [
            'products' => $carts,
            'model' => $model
        ]);
    }

    public function actionUpdateCartItemQuantity()
    {
        Yii::$app->response->format = 'json';
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $id = $request->post('id');
            $quantity = $request->post('quantity');
            if ($quantity <= 0) {
                return ['result' => 'fail'];
            }
            $cart = CartItem::findOne($id);
            if ($cart) {
                Yii::$app->carts->update($cart, $quantity);
                $totalPrice = 0;
                $carts = Yii::$app->carts->getItems();
                foreach ($carts as $item) {
                    if ($item->discount != null || $item->discount != '') {
                        $totalPrice = $totalPrice + ($item->discount * $item->quantity);
                    } else {
                        $totalPrice = $totalPrice + ($item->unit_price * $item->quantity);
                    }
                }
                if ($cart->discount != null || $cart->discount != '') {
                    return [
                        'result' => 'success',
                        'total_unit_price' => number_format($cart->discount * $quantity, 0, '', '.') . 'đ',
                        'total_price' => number_format($totalPrice, 0, '', '.') . ' đ',
                        'total' => $totalPrice,
                    ];
                } else {
                    return [
                        'result' => 'success',
                        'total_unit_price' => number_format($cart->unit_price * $quantity, 0, '', '.') . 'đ',
                        'total_price' => number_format($totalPrice, 0, '', '.') . ' đ',
                        'total' => $totalPrice,
                    ];
                }
            } else {
                return ['result' => 'fail'];
            }
        }
    }

    public function actionDelete($id)
    {
        $product = CartItem::findOne($id);
        if ($product) {
            Yii::$app->carts->delete($product);
        }
        return $this->redirect('index');
    }

    public function actionSubcat()
    {
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
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionProd()
    {
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

                echo Json::encode(['output' => $data['out'], 'selected' => $data['selected']]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    private function getSubCatList($cat_id)
    {
        $out = [];
        $province = Province::find()->where(['name' => $cat_id])->one();
        if ($province) {
            $district = District::find()->where(['province_id' => $province->id])->orderBy(['name' => SORT_ASC])->all();
            foreach ($district as $item) {
                $out[] = ['id' => $item->name, 'name' => $item->name];
            }
        }

        return $out;
    }

    private function getProdList($subcat_id)
    {
        $out = [];
        $district = District::find()->where(['name' => $subcat_id])->one();
        if ($district) {
            $ward = Ward::find()->where(['district_id' => $district->id])->orderBy(['name' => SORT_ASC])->all();
            foreach ($ward as $item) {
                $out[] = ['id' => $item->name, 'name' => $item->name];
            }
        }

        return ['out' => $out, 'selected' => null];
    }

    public function actionCheckout()
    {
        $model = new CartForm();
        $modelOrder = new Orders();
        $cart = Yii::$app->carts;
        if ($model->load(Yii::$app->request->post())) {
            $modelOrder->order_date = date('Y-m-d H:i:s');
            $modelOrder->type = "COD";
            $modelOrder->description = "Chuyển khoản qua ngân hàng";
            $modelOrder->freight = 0;
            $modelOrder->status = Orders::STATUS_PENDING;
            $modelOrder->ship = "{}";
            $modelOrder->ship_name = $model->ship_name;
            $modelOrder->ship_phone = $model->ship_phone;
            $modelOrder->ship_email = $model->ship_email;
            $modelOrder->ship_address = $model->ship_address;
            $modelOrder->ship_city = $model->ship_city;
            $modelOrder->ship_district = $model->ship_district;
            $modelOrder->ship_ward = $model->ship_ward;
            $modelOrder->note = $model->note;
            $modelOrder->total_price = $model->total_price;
            if ($model->validate()) {
                if ($modelOrder->validate()) {
                    if ($modelOrder->save()) {
                        $items = $cart->getItems();
                        // Check exist product
                        /* @var $item Product */
                        foreach ($items as $item) {
                            // access any attribute/method from the model
                            $orderDetailModel = new OrderDetails();
                            $orderDetailModel->order_id = $modelOrder->id;
                            $orderDetailModel->product_id = $item->id;
                            $orderDetailModel->product_code = $item->code;
                            $orderDetailModel->unit_price = $item->unit_price;
                            if ($item->discount != null || $item->discount != '') {
                                $orderDetailModel->unit_price = $item->discount;
                            }
                            $orderDetailModel->quantity = $item->quantity;
                            $orderDetailModel->tax_value = 0;
                            $orderDetailModel->discount = 0;
                            $orderDetailModel->weight = $item->weight;
                            $orderDetailModel->total_price = $orderDetailModel->unit_price * $orderDetailModel->quantity;

                            if ($orderDetailModel->validate()) {
                                $orderDetailModel->save();
                            }
                        }
                        $cart->checkOut(false);
                        return $this->redirect('view?id=' . $modelOrder->id);
                    } else {
                        Yii::$app->session->setFlash('error', $model->getErrors());
                        return $this->redirect('index');
                    }
                }
            }
        } else {
            return $this->redirect('index');
        }
    }

    public function actionView($id)
    {
        $model = Orders::find()->where(['id' => $id])->one();
        if ($model) {
            $orderDetailModel = OrderDetails::find()->where(['order_id' => $id])->all();

            return $this->render('view', ['model' => $model, 'orderDetailModel' => $orderDetailModel]);
        }
    }
}