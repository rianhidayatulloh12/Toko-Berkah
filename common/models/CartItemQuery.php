<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CartItem]].
 *
 * @see CartItem
 */
class CartItemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CartItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CartItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $userId
     * @return CartItemQuery
     */
    public function userId($userId)
    {
        return $this->andWhere(['user_id' => $userId]);
    }

    /**
     * @param $barangId
     * @return CartItemQuery
     */
    public function barangId($barangId)
    {
        return $this->andWhere(['barang_id' => $barangId]);
    }
}
