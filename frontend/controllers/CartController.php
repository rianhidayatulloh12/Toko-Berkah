<?php


namespace frontend\controllers;


use common\models\Barang;
use common\models\CartItem;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
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
            ],
            [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST', 'DELETE'],
                ]
            ]
        ];
    }

    /**
     * @return string
     * fungsi menampilkan barang pada /keranjangcart
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest){
            $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []);
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

    /**
     * @return array|bool[]
     * @throws NotFoundHttpException
     * fungsi menambahkan barang pada keranjang/cart
     */

    public function actionAdd()
    {
        $id = \Yii::$app->request->post('id');
        $barang = Barang::find($id)->published()->one();
        if (!$barang){
            throw new NotFoundHttpException("Barang tidak ada");
        }

        if (\Yii::$app->user->isGuest){

            $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []);
            $found = false;
            foreach ($cartItems as &$cartItem) {
                if ($cartItem['id'] == $id){
                    $cartItem['jumlah']++;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $cartItem = [
                    'id' => $id,
                    'nama' => $barang->nama,
                    'image' => $barang->image,
                    'harga_jual' => $barang->harga_jual,
                    'jumlah' => 1,
                    'total_harga' => $barang->harga_jual
                ];

                $cartItems[] = $cartItem;
            }

            \Yii::$app->session->set(CartItem::SESSION_KEY, $cartItems);
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

    /**
     * fungsi hapust pada keranjang/cart
     */
    public function actionDelete($id)
    {
        if (isGuest()){
            $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []);
            foreach ($cartItems as $i => $cartItem){
                if ($cartItem['id'] == $id){
                    array_splice($cartItems, $i, 1);
                    break;
                }
            }
            \Yii::$app->session->set(CartItem::SESSION_KEY, $cartItems);
        }else{
            CartItem::deleteAll(['barang_id' => $id, 'user_id' => currUserId()]);
        }
        return $this->redirect(['index']);
    }
}