<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%penjualan}}".
 *
 * @property int $id
 * @property string $tanggal
 * @property string $jam
 * @property int $total
 * @property float $uang_pembayaran
 * @property int $status_pengemasan
 * @property int $pengemas_id
 * @property int $status_pengiriman
 * @property int $kurir_id
 * @property int $kasir_id
 * @property int $status_pembayaran
 * @property int $validator_pembayaran
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int $status
 */
class Penjualan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%penjualan}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal', 'jam', 'total', 'uang_pembayaran', 'status_pengemasan', 'pengemas_id', 'status_pengiriman', 'kurir_id', 'kasir_id', 'status_pembayaran', 'validator_pembayaran', 'status'], 'required'],
            [['tanggal', 'jam'], 'safe'],
            [['total', 'status_pengemasan', 'pengemas_id', 'status_pengiriman', 'kurir_id', 'kasir_id', 'status_pembayaran', 'validator_pembayaran', 'created_at', 'created_by', 'status'], 'integer'],
            [['uang_pembayaran'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal' => 'Tanggal',
            'jam' => 'Jam',
            'total' => 'Total',
            'uang_pembayaran' => 'Uang Pembayaran',
            'status_pengemasan' => 'Status Pengemasan',
            'pengemas_id' => 'Pengemas ID',
            'status_pengiriman' => 'Status Pengiriman',
            'kurir_id' => 'Kurir ID',
            'kasir_id' => 'Kasir ID',
            'status_pembayaran' => 'Status Pembayaran',
            'validator_pembayaran' => 'Validator Pembayaran',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'status' => 'Status',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\PenjualanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PenjualanQuery(get_called_class());
    }
}
