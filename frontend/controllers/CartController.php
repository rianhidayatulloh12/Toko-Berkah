<?php


namespace frontend\controllers;


use common\models\Barang;
use common\models\CartItem;
use common\models\Penjualan;
use common\models\PenjualanDetail;
use common\models\User;
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
            $cartItems = CartItem::getItemsForUser(currUserId());

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
        $barang = Barang::find()->id($id)->published()->one();
        if (!$barang){
            throw new NotFoundHttpException("Barang tidak ada");
        }

        if (\Yii::$app->user->isGuest){

            $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []);
            $found = false;
            foreach ($cartItems as &$item) {
                if ($item['id'] == $id){
                    $item['jumlah']++;
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
                $cartItem->user_id = $userId;
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

    public function actionChangeJumlah()
    {
        $id = \Yii::$app->request->post('id');
        $barang = Barang::find()->id($id)->published()->one();
        if (!$barang){
            throw new NotFoundHttpException("Barang tidak ada");
        }
        $jumlah = \Yii::$app->request->post('jumlah');
        if (isGuest()){
            $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []);
            foreach ($cartItems as &$cartItem){
                if ($cartItem['id'] === $id){
                    $cartItem['jumlah'] = $jumlah;
                    break;
                }
            }
            \Yii::$app->session->set(CartItem::SESSION_KEY, $cartItems);
        }else{
            $cartItem = CartItem::find()->userId(currUserId())->barangId($id)->one();
            if ($cartItem) {
                $cartItem->jumlah = $jumlah;
                $cartItem->save();
            }
        }
        return CartItem::getTotalJumlahForUser(currUserId());
    }

    public function actionCheckout()
    {
        $penjualan = new Penjualan();
        $penjualanDetail = new PenjualanDetail();
        if(!isGuest()){
            /** @var \common\models\User $user */
            $user = \Yii::$app->user->identity;
            $userProfile = $user->getProfile();

            $penjualan->firstname = $user->firstname;
            $penjualan->lastname = $user->lastname;
            $penjualan->status = Penjualan::STATUS_DRAFT;

            $penjualanDetail->alamat = $userProfile->alamat;
            $penjualanDetail->kelurahan = $userProfile->kelurahan;
            $penjualanDetail->kecamatan = $userProfile->kecamatan;
            $penjualanDetail->kabupaten = $userProfile->kabupaten;
            $penjualanDetail->provinsi = $userProfile->provinsi;
            $cartItems = CartItem::getItemsForUser(currUserId());
        } else {
            $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []);
        }

        $jumlahBarang = CartItem::getTotalJumlahForUser(currUserId());
        $totalHarga = CartItem::getTotalHargaForUser(currUserId());

        return $this->render('checkout', [
            'penjualan' => $penjualan,
            'penjualanDetail' => $penjualanDetail,
            'cartItems' => $cartItems,
            'jumlahBarang' => $jumlahBarang,
            'totalHarga' => $totalHarga
        ]);
    }
}