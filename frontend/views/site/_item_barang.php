<?php
/** @var \common\models\Barang $model */
?>

    <div class="card h-100">
        <!-- Sale badge-->
        <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">HOT</div>
        <!-- Product image-->
        <img class="card-img-top" src="<?php echo $model->getImageUrl() ?>" alt="" />
        <!-- Product details-->
        <div class="card-body p-3">
            <div class="text-center">
            <!-- Product name-->
            <h7 class="card-title">
                <a href="#"><?php echo $model->nama ?></a>
            </h7>
            <h6 class="text-decoration-line-through text-danger"><?php echo Yii::$app->formatter->asCurrency($model->harga_jual) ?></h6>
            </div>
        </div>
        <!-- Product actions-->
        <div class="card-footer p-2 pt-0 border-top-0 bg-gradient-light">
            <div class="text-right"><a class="btn btn-outline-success btn-add-to-cart" href="<?php echo \yii\helpers\Url::to(['/cart/add']) ?>">Add to Cart</a></div>
        </div>
    </div>

