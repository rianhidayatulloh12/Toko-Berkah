<?php


namespace frontend\base;


use common\models\CartItem;

class Controller extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        $this->view->params['cartItemCount'] = CartItem::findBySql("
            SELECT SUM(jumlah) FROM cart_items WHERE user_id = :userId", ['userId' => \Yii::$app->user->id])
            ->scalar();
        return parent::beforeAction($action);
    }

}