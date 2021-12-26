<?php


namespace frontend\base;


use common\models\CartItem;

class Controller extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest){
            $cartItems= \Yii::$app->session->get(CartItem::SESSION_KEY, []);
            $sum = 0;
            foreach ($cartItems as $cartItem){
                $sum += $cartItem['jumlah'];
            }
        }else{
            $sum = CartItem::findBySql("
            SELECT SUM(jumlah) FROM cart_items WHERE user_id = :userId", ['userId' => \Yii::$app->user->id])
                ->scalar();
        }
        $this->view->params['cartItemCount'] = $sum;
        return parent::beforeAction($action);
    }

}