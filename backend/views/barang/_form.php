<?php


use Itstructure\CKEditor\CKEditor;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Barang */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="barang-form">

    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'upc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'harga_jual')->textInput([
            'maxlength' => true,
            'type' => 'number'
    ]) ?>

    <?= $form->field($model, 'merk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'satuan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stok')->textInput([
        'maxlength' => true,
        'type' => 'number'
    ]) ?>

    <?= $form->field($model, 'deskripsi')->widget(CKEditor::className(),
        [
            'preset' => 'custom',
            'clientOptions' => [
                'toolbarGroups' => [
                    [
                        'name' => 'undo'
                    ],
                    [
                        'name' => 'basicstyles',
                        'groups' => ['basicstyles', 'cleanup']
                    ],
                    [
                        'name' => 'colors'
                    ],
                    [
                        'name' => 'links',
                        'groups' => ['links', 'insert']
                    ],
                    [
                        'name' => 'others',
                        'groups' => ['others', 'about']
                    ],
                ],
                'filebrowserBrowseUrl' => '/ckfinder/ckfinder.html',
                'filebrowserImageBrowseUrl' => '/ckfinder/ckfinder.html?type=Images',
                'filebrowserUploadUrl' => '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                'filebrowserImageUploadUrl' => '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                'filebrowserWindowWidth' => '1000',
                'filebrowserWindowHeight' => '700',
                'allowedContent' => true,
                'language' => 'en',
            ]
        ]
    ); ?>

    <?= $form->field($model, 'imageFile', [
            'template' =>
                '
                    <div class="custom-file">
                    {input}
                    {label}
                    {error}
                    </div>
                ',
            'labelOptions' => ['class' => 'custom-file-label'],
            'inputOptions' => ['class' => 'custom-file-input']
    ])->textInput(['type' => 'file']) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
