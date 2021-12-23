<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Penjualan]].
 *
 * @see Penjualan
 */
class PenjualanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Penjualan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Penjualan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
