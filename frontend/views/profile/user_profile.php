<?php

use yii\bootstrap4\ActiveForm;

/** @var \yii\web\View $this */
/** @var \common\models\UserProfile $userProfile */
/* @var $profileForm yii\bootstrap4\ActiveForm */

?>

<?php if (isset($success) && $success): ?>
    <div class="alert alert-success">
        Profil Anda Berhasil diupdate
    </div>
<?php endif  ?>

<?php $profileForm = ActiveForm::begin([
    'action' => ['/profile/update-profile'],
    'options' => [
        'data-pjax' => 1
    ]
]); ?>

<?php echo $profileForm->field($userProfile, 'nama') ?>

<?php echo $profileForm->field($userProfile, 'alamat') ?>

<?php echo $profileForm->field($userProfile, 'no_telp') ?>

<?php echo $profileForm->field($userProfile, 'jenis_kelamin') ?>

<?php echo $profileForm->field($userProfile, 'tanggal_lahir')?>

<?php echo $profileForm->field($userProfile, 'kelurahan') ?>

<?php echo $profileForm->field($userProfile, 'kecamatan') ?>

<?php echo $profileForm->field($userProfile, 'kabupaten') ?>

<?php echo $profileForm->field($userProfile, 'provinsi') ?>

<button class="btn btn-primary">Update</button>

<?php ActiveForm::end() ?>
