<?php

use yii\helpers\Html;
use yii\grid\GridView;



/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Barang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barang-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Barang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                    'attribute' => 'id',
                    'contentOptions' => [
                            'style' => 'width: 60px'
                    ]
            ],
            [
                    'label' => 'Image',
                    'attribute' => 'image',
                    'content' => function($model) {
                    /** @var  \common\models\Barang $model */
                    return Html::img($model->getImageUrl(), ['style' => 'width: 50px']);
                }
            ],
//            'sku',
//            'upc',
            'nama',
//            'jenis',
            'harga_jual:currency',
//            'merk',
            //'satuan',
            //'stok',
            [
                    'attribute' => 'status',
                    'content' => function($model) {
                    /** @var  \common\models\Barang $model */
                    return Html::tag('span', $model->status ? 'Active' : 'Draft', [
                            'class' => $model->status ? 'badge badge-success' : 'badge badge-danger'
                    ]);
                    }
            ],
            [
                    'attribute' => 'created_at',
                    'format' => ['datetime'],
                    'contentOptions' => ['style' => 'white-space: nowrap']
            ],
            [
                    'attribute' => 'updated_at',
                    'format' => ['datetime'],
                    'contentOptions' => ['style' => 'white-space: nowrap']
            ],
//            'created_by',
            //'updated_by',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
