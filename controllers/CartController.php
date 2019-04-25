<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 4/18/2019
 * Time: 2:04 PM
 */

namespace app\controllers;

use app\models\Good;
use yii\web\Controller;
use app\models\Cart;
use app\models\Order;
use app\models\OrderGood;
use Yii;
use yii\helpers\Url;

class CartController extends Controller
{
    public function actionOpen()
    {
        $session = Yii::$app->session;
        $session->open();
//        $session->remove('cart');
//        $session->remove('cart.totalQuantity');
//        $session->remove('cart.totalPrice');
        return $this->renderPartial('cart', compact('good', 'session'));
    }

    protected function saveOrderInfo($goods, $orderId){

        foreach ($goods as $id=>$item){
            $orderInfo = new OrderGood();
            $orderInfo->order_id = $orderId;
            $orderInfo->product_id = $id;
            $orderInfo->name = $item['name'];
            $orderInfo->price = $item['price'];
            $orderInfo->quantity = $item['goodQuantity'];
            $orderInfo->sum = $item['goodQuantity'] * $item['price'];
            $orderInfo->save();
        }

    }

    public function actionOrder(){
        $session = Yii::$app->session;
        $session->open();
        if(!$session['cart.totalPrice']){
            //return Yii::$app->response->redirect(Url::to('/'));
            return $this->render('success', compact ('session'));
        }
        $order = new Order();
        if($order->load(Yii::$app->request->post())){
            $order->date = date('Y-m-d H:i:s');
            $order->sum = $session['cart.totalPrice'];
            if($order->save()){
                $session['currentId'] = $order->id;
                $this->saveOrderInfo($session['cart'], $session['currentId']);
                Yii::$app->mailer->compose('order-mail', ['session'=>$session, 'order'=>$order])
                    ->setFrom(['allaadri.witte@gmail.com'=>'Customer service'])
                    ->setTo([$order->email])
                    ->setSubject('Ваш заказ принят')
                    ->send();
                $session->remove('cart');
                $session->remove('cart.totalQuantity');
                $session->remove('cart.totalPrice');
                return $this->render('success', compact ('session' ));
            }
        }
        $this->layout = 'empty';
        return $this->render('order', compact('session', 'order'));
    }

    public function actionAdd($name)
    {
        $good = new Good();
        $good = $good->getOneGood($name);
        $session = Yii::$app->session;
        $session->open();
//        $session->remove('cart');
        $cart = new Cart();
        $cart->addToCart($good);
        return $this->renderPartial('cart', compact('good', 'session'));
    }

    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.totalQuantity');
        $session->remove('cart.totalPrice');
        return $this->renderPartial('cart', compact('session'));
    }

    public function actionDelete($id){
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->updateCart($id);
        return $this->renderPartial('cart', compact('session'));
    }

}