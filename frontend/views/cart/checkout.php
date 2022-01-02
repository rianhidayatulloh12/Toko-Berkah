<?php
/** @var \common\models\Penjualan @penjualan */

use yii\bootstrap4\ActiveForm;

/** @var \common\models\PenjualanDetail @penjualanDetail */
/** @var array $cartItems */
/** @var int $jumlahBarang */
/** @var float $totalHarga */

?>

<?php $form = ActiveForm::begin([
    'action' => [''],
]); ?>

<div class="row p-5">
    <div class="col">
        <div class="card mb-3">
            <div class="card-header">
                <h5>Informasi Akun</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($penjualan, 'firstname')->textInput(['autofocus' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($penjualan, 'lastname')->textInput(['autofocus' => true]) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Informasi Profile</h5>
            </div>
            <div class="card-body">
                <?php echo $form->field($penjualanDetail, 'alamat') ?>

                <?php echo $form->field($penjualanDetail, 'kelurahan') ?>

                <?php echo $form->field($penjualanDetail, 'kecamatan') ?>

                <?php echo $form->field($penjualanDetail, 'kabupaten') ?>

                <?php echo $form->field($penjualanDetail, 'provinsi') ?>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5>Ringkasan Pesanan</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td colspan="2"> <?php echo $jumlahBarang ?> Barang </td>
                    </tr>
                    <tr>
                        <td>Total Harga</td>
                        <td class="text-right"><?php echo Yii::$app->formatter->asCurrency($totalHarga) ?></td>
                    </tr>
                </table>

                <p class="text-center">
                    <button class="btn btn-secondary ">Checkout</button>
                </p>

            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>