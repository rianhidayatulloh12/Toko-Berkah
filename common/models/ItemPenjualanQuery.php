<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ItemPenjualan]].
 *
 * @see ItemPenjualan
 */
class ItemPenjualanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ItemPenjualan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ItemPenjualan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
