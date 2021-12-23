<?php


namespace frontend\controllers;


use common\models\Barang;
use common\models\CartItem;
use yii\filters\ContentNegotiator;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CartController extends \frontend\base\Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => ContentNegotiator::class,
                'only' => ['add'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest){
            //
        }else{
            $cartItems = CartItem::findBySql("
                            SELECT
                                   c.barang_id as id,
                                   b.image,
                                   b.nama,
                                   b.harga_jual,
                                   c.jumlah,
                                   b.harga_jual * c.jumlah as total_harga
                            FROM cart_items c
                                    LEFT JOIN barang b on b.id = c.barang_id
                            WHERE c.user_id = :userId",
                ['userId' => \Yii::$app->user->id
                ])
                ->asArray()
                ->all();

        }

        return $this->render('index',[
            'items' => $cartItems
        ]);
    }
    public function actionAdd()
    {
        $id = \Yii::$app->request->post('id');
        $barang = Barang::find($id)->published()->one();
        if (!$barang){
            throw new NotFoundHttpException("Barang tidak ada");
        }

        if (\Yii::$app->user->isGuest){
            // Todo save in session
        } else {
            $userId = \Yii::$app->user->id;
            $cartItem = CartItem::find()->userId($userId)->barangId($id)->one();
            if ($cartItem) {
                $cartItem->jumlah++;
            }else {
                $cartItem = new CartItem();
                $cartItem->barang_id = $id;
                $cartItem->user_id = \Yii::$app->user->id;
                $cartItem->jumlah = 1;
            }
            if ($cartItem->save()){
                return [
                    'success' => true
                ];
            } else {
                return [
                    'success' => false,
                    'errors' => $cartItem->errors
                ];
            }
        }
    }
}