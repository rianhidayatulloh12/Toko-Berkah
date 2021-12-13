<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%barang}}".
 *
 * @property int $id
 * @property string $sku
 * @property string $upc
 * @property string $nama
 * @property string $jenis
 * @property float $harga_jual
 * @property string $merk
 * @property string $satuan
 * @property int $stok
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $image
 * @property string $deskripsi
 */
class Barang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%barang}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sku', 'upc', 'nama', 'jenis', 'harga_jual', 'merk', 'satuan', 'stok', 'status', 'deskripsi'], 'required'],
            [['harga_jual'], 'number'],
            [['stok', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['deskripsi'], 'string'],
            [['sku', 'upc', 'nama', 'jenis', 'merk', 'satuan'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 2000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sku' => 'Sku',
            'upc' => 'Upc',
            'nama' => 'Nama',
            'jenis' => 'Jenis',
            'harga_jual' => 'Harga Jual',
            'merk' => 'Merk',
            'satuan' => 'Satuan',
            'stok' => 'Stok',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'image' => 'Image',
            'deskripsi' => 'Deskripsi',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\BarangQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\BarangQuery(get_called_class());
    }
}
