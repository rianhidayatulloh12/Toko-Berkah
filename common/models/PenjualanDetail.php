<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%penjualan_detail}}".
 *
 * @property int $id
 * @property int $penjualan_id
 * @property string $alamat
 * @property string $kelurahan
 * @property string $kecamatan
 * @property string $kabupaten
 * @property string $provinsi
 *
 * @property Penjualan $penjualan
 */
class PenjualanDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%penjualan_detail}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['penjualan_id', 'alamat', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi'], 'required'],
            [['penjualan_id'], 'integer'],
            [['alamat', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi'], 'string', 'max' => 255],
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
            'alamat' => 'Alamat',
            'kelurahan' => 'Kelurahan',
            'kecamatan' => 'Kecamatan',
            'kabupaten' => 'Kabupaten',
            'provinsi' => 'Provinsi',
        ];
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
     * @return PenjualanDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PenjualanDetailQuery(get_called_class());
    }
}
