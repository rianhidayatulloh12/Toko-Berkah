<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;

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
 *
 * @property cartItem[] $cartItems
 * @property User        $createdBy
 * @property User        $updatedBy
 */
class Barang extends \yii\db\ActiveRecord
{
    /**
     * @var \yii\web\UploadedFile
     */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%barang}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sku', 'upc', 'nama', 'jenis', 'harga_jual', 'merk', 'satuan', 'stok', 'status',], 'required'],
            [['harga_jual'], 'number'],
            [['imageFile'], 'image', 'extensions'=> 'png, jpg, jpeg, gif, webp', 'maxSize' => 5 * 1024 * 1024],
            [['stok', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['deskripsi'], 'string'],
            [['sku', 'upc', 'nama', 'jenis', 'merk', 'satuan'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 2000],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
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
            'sku' => 'Sku',
            'upc' => 'Upc',
            'jenis' => 'Jenis',
            'harga_jual' => 'Harga Jual',
            'merk' => 'Merk',
            'satuan' => 'Satuan',
            'stok' => 'Stok',
            'status' => 'Published',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'imageFile' => 'Image',
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

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->imageFile) {
            $this->image = '/barang/'.Yii::$app->security->generateRandomString().'/'.$this->imageFile->name;
        }

        $transaction = Yii::$app->db->beginTransaction();
        $ok = parent::save($runValidation, $attributeNames);

        if($ok && $this->imageFile) {
            $fullPath = Yii::getAlias('@frontend/web/storage'.$this->image);
            $dir = dirname($fullPath);
            if(!FileHelper::createDirectory($dir) | !$this->imageFile->saveAs($fullPath)) {
                $transaction->rollBack();

                return false;
            }
        }

        $transaction->commit();

        return $ok;
    }

    public function getImageUrl()

    {
        return self::formatImageUrl($this->image);
    }

    public static function formatImageUrl($imagePath)
    {
        if($imagePath) {
            return Yii::$app->params['frontendUrl'] . '/storage' . $imagePath;
        }
        return Yii::$app->params['frontendUrl'].'/img/no_image.png';
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

}
