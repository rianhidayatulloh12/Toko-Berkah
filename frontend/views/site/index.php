<?php

/* @var $this yii\web\View */
/* @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <!-- Header-->
    <header class="bg-success py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Berkah Shop</h1>
                <p class="lead fw-normal text-white-50 mb-0">Shop in style</p>
            </div>
        </div>
    </header>
    <div class="body-content">
        <!-- Section-->
        <section class="py-3">
            <div class="container px-4 px-lg-5 mt-5">

                    <?php echo \yii\widgets\ListView::widget([
                            'dataProvider' => $dataProvider,
                            'layout' => '{summary}<div class="row">{items}</div>{pager}',
                            'itemView' => '_item_barang',
                            'itemOptions' => [
                                    'class' => 'col-lg-2 col-md-4 col-6 mb-2 item-barang'
                            ],
                            'pager' => [
                                    'class' => \yii\bootstrap4\LinkPager::class,
                            ]
                    ]) ?>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-success">
            <div class="container"><p class="m-0 text-center text-white">Website Penjualan | Toko Berkah | Pemrograman Rian</p></div>
        </footer>
    </div>
</div>

