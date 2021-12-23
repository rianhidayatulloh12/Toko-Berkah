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
 *
 * @property Barang $barang
 * @property Penjualan $penjualan
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
            [['barang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::className(), 'targetAttribute' => ['barang_id' => 'id']],
            [['penjualan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Penjualan::className(), 'targetAttribute' => ['penjualan_id' => 'id']],
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
     * Gets query for [[Barang]].
     *
     * @return \yii\db\ActiveQuery|BarangQuery
     */
    public function getBarang()
    {
        return $this->hasOne(Barang::className(), ['id' => 'barang_id']);
    }

    /**
     * Gets query for [[Penjualan]].
     *
     * @return \yii\db\ActiveQuery|PenjualanQuery
     */
    public function getPenjualan()
    {
        return $this->hasOne(Penjualan::className(), ['id' => 'penjualan_id']);
    }

    /**
     * {@inheritdoc}
     * @return ItemPenjualanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemPenjualanQuery(get_called_class());
    }
}
