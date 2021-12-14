<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Barang]].
 *
 * @see \common\models\Barang
 */
class BarangQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Barang[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Barang|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return BarangQuery
     */
    public function published()
    {
        return $this->andWhere(['status' => 1]);
    }
}
