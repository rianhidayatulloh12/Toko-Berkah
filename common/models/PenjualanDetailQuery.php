<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PenjualanDetail]].
 *
 * @see PenjualanDetail
 */
class PenjualanDetailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PenjualanDetail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PenjualanDetail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
