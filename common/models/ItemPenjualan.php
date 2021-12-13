<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%item_penjualan}}".
 *
 * @property int $id
 * @property int $penjualan_id
 * @property int $barang_id
 * @property string $nama_barang
 * @property float $harga_barang
 * @property int $jumlah
 */
class ItemPenjualan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%item_penjualan}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['penjualan_id', 'barang_id', 'nama_barang', 'harga_barang', 'jumlah'], 'required'],
            [['penjualan_id', 'barang_id', 'jumlah'], 'integer'],
            [['harga_barang'], 'number'],
            [['nama_barang'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'penjualan_id' => 'Penjualan ID',
            'barang_id' => 'Barang ID',
            'nama_barang' => 'Nama Barang',
            'harga_barang' => 'Harga Barang',
            'jumlah' => 'Jumlah',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ItemPenjualanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ItemPenjualanQuery(get_called_class());
    }
}
