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
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">

                    <?php echo \yii\widgets\ListView::widget([
                            'dataProvider' => $dataProvider,
                            'layout' => '{summary}<div class="row">{items}</div>{pager}',
                            'itemView' => '_item_barang',
                            'itemOptions' => [
                                    'class' => 'col col-lg-3 mb-5'
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
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

    </div>
</div>

