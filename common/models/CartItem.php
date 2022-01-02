<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%cart_items}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $barang_id
 * @property int $jumlah
 *
 * @property Barang $barang
 * @property User $user
 */
class CartItem extends \yii\db\ActiveRecord
{
    const SESSION_KEY = 'CART_ITEMS';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cart_items}}';
    }

    public static function getTotalJumlahForUser($curUserId)
    {
        if (isGuest()){
            $cartItems= \Yii::$app->session->get(CartItem::SESSION_KEY, []);
            $sum = 0;
            foreach ($cartItems as $cartItem){
                $sum += $cartItem['jumlah'];
            }
        }else{
            $sum = CartItem::findBySql("
            SELECT SUM(jumlah) FROM cart_items WHERE user_id = :userId", ['userId' => $curUserId])
                ->scalar();
        }
        return $sum;
    }

    public static function getTotalHargaForUser($curUserId)
    {
        if (isGuest()){
            $cartItems= \Yii::$app->session->get(CartItem::SESSION_KEY, []);
            $sum = 0;
            foreach ($cartItems as $cartItem){
                $sum += $cartItem['jumlah'] * $cartItem['harga_jual'];
            }
        }else{
            $sum = CartItem::findBySql("
            SELECT SUM(c.jumlah * b.harga_jual) 
            FROM cart_items c
            LEFT JOIN barang b on b.id = c.barang_id 
                WHERE c.user_id = :userId", ['userId' => $curUserId])
                ->scalar();
        }
        return $sum;
    }

    public static function getItemsForUser($currUserId)
    {
        return CartItem::findBySql("
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
            ['userId' => $currUserId])
            ->asArray()
            ->all();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'barang_id', 'jumlah'], 'required'],
            [['user_id', 'barang_id', 'jumlah'], 'integer'],
            [['barang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::className(), 'targetAttribute' => ['barang_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'barang_id' => 'Barang ID',
            'jumlah' => 'Jumlah',
        ];
    }

    /**
     * Gets query for [[Barang]].
     *
     * @return \yii\db\ActiveQuery|BarangQuery
     */
    public function getBarang()
    {
        return $this->hasOne(Barang::className(), ['id' => 'barang_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return CartItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CartItemQuery(get_called_class());
    }
}
