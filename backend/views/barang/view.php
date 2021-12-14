<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Barang */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="barang-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'image',
                'format' => ['html'],
                'value' => fn()=> Html::img($model->getImageUrl(), ['style' => 'width: 50px']),
            ],
            'nama',
            'deskripsi:html',
            'harga_jual:currency',
            'sku',
            'upc',
            'jenis',
            'merk',
            'satuan',
            'stok',
            [
                    'attribute' => 'status',
                    'format' => ['html'],
                    'value' => fn() => Html::tag('span', $model->status ? 'Active' : 'Draft', [
                            'class' => $model->status ? 'badge badge-success' : 'badge badge-danger'
                    ])
            ],
            'created_at:datetime',
            'updated_at:datetime',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
