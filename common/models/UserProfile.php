<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property int $id
 * @property string $nama
 * @property string $alamat
 * @property string $email
 * @property string $no_telp
 * @property string $jenis_kelamin
 * @property string $tanggal_lahir
 * @property int $user_id
 * @property string $kelurahan
 * @property string $kecamatan
 * @property string $kabupaten
 * @property string $provinsi
 * @property int $jenis_user
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'alamat', 'email', 'no_telp', 'jenis_kelamin', 'tanggal_lahir', 'user_id', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi', 'jenis_user'], 'required'],
            [['tanggal_lahir'], 'safe'],
            [['user_id', 'jenis_user'], 'integer'],
            [['nama', 'alamat', 'email', 'no_telp', 'jenis_kelamin', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'email' => 'Email',
            'no_telp' => 'No Telp',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tanggal_lahir' => 'Tanggal Lahir',
            'user_id' => 'User ID',
            'kelurahan' => 'Kelurahan',
            'kecamatan' => 'Kecamatan',
            'kabupaten' => 'Kabupaten',
            'provinsi' => 'Provinsi',
            'jenis_user' => 'Jenis User',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\UserProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\UserProfileQuery(get_called_class());
    }
}
