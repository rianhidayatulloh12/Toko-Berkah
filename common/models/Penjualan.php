<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%penjualan}}".
 *
 * @property int $id
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $tanggal
 * @property string|null $jam
 * @property int|null $total
 * @property float|null $uang_pembayaran
 * @property int|null $status_pengemasan
 * @property int|null $pengemas_id
 * @property int|null $status_pengiriman
 * @property int|null $kurir_id
 * @property int|null $kasir_id
 * @property int|null $status_pembayaran
 * @property int|null $validator_pembayaran
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int $status
 *
 * @property User $createdBy
 * @property ItemPenjualan[] $itemPenjualans
 * @property User $kasir
 * @property User $kurir
 * @property User $pengemas
 * @property PenjualanDetail[] $penjualanDetails
 * @property User $validatorPembayaran
 */
class Penjualan extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT = 0;
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
            [['tanggal', 'jam'], 'safe'],
            [['total', 'status_pengemasan', 'pengemas_id', 'status_pengiriman', 'kurir_id', 'kasir_id', 'status_pembayaran', 'validator_pembayaran', 'created_at', 'created_by', 'status'], 'integer'],
            [['uang_pembayaran'], 'number'],
            [['status', 'firstname', 'lastname'], 'required'],
            [['firstname', 'lastname'], 'string', 'max' => 255],
            [['kasir_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['kasir_id' => 'id']],
            [['kurir_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['kurir_id' => 'id']],
            [['pengemas_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['pengemas_id' => 'id']],
            [['validator_pembayaran'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['validator_pembayaran' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
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
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[ItemPenjualans]].
     *
     * @return \yii\db\ActiveQuery|ItemPenjualanQuery
     */
    public function getItemPenjualans()
    {
        return $this->hasMany(ItemPenjualan::className(), ['penjualan_id' => 'id']);
    }

    /**
     * Gets query for [[Kasir]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getKasir()
    {
        return $this->hasOne(User::className(), ['id' => 'kasir_id']);
    }

    /**
     * Gets query for [[Kurir]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getKurir()
    {
        return $this->hasOne(User::className(), ['id' => 'kurir_id']);
    }

    /**
     * Gets query for [[Pengemas]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getPengemas()
    {
        return $this->hasOne(User::className(), ['id' => 'pengemas_id']);
    }

    /**
     * Gets query for [[PenjualanDetails]].
     *
     * @return \yii\db\ActiveQuery|PenjualanDetailQuery
     */
    public function getPenjualanDetails()
    {
        return $this->hasMany(PenjualanDetail::className(), ['penjualan_id' => 'id']);
    }

    /**
     * Gets query for [[ValidatorPembayaran]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getValidatorPembayaran()
    {
        return $this->hasOne(User::className(), ['id' => 'validator_pembayaran']);
    }

    /**
     * {@inheritdoc}
     * @return PenjualanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PenjualanQuery(get_called_class());
    }
}
