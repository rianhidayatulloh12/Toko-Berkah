<?php
/** @var array $items */
?>

<div class="card p-4">
    <div class="card-header p-4 bg-success text-white font-weight-bold">
        <h4>Belanjaan Anda</h4>
    </div>
    <div class="card-body p-4">
        <table class="table table-hover">
            <thead>
            <tr class="text-success" align="center">
                <th>Barang</th>
                <th>Image</th>
                <th>Harga Barang</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr align="center">
                    <td><?= $item['nama']?></td>
                    <td>
                        <img src="<?= \common\models\Barang::formatImageUrl($item['image'])?>"
                             style="width: 60px" alt="<?php echo $item['nama']?>">
                    </td>
                    <td><?= $item['harga_jual']?></td>
                    <td><?= $item['jumlah']?></td>
                    <td><?= $item['total_harga']?></td>
                    <td>
                        <?= \yii\helpers\Html::a('Delete',['/cart/delete', 'id' => $item['id']],[
                                'class' => 'btn btn-outline-danger btn-sm',
                                'data-method' => 'post',
                                'data-confirm' => 'Apakah anda yakin akan menghapus item ini?'
                        ])?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="card-body text-right">
            <a href="<?php echo \yii\helpers\Url::to(['/cart/checkout']) ?>"class="btn btn-success">Checkout</a>
        </div>
    </div>
</div>
