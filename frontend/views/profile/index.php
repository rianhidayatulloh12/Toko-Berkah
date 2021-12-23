<?php
/** @var \common\models\User $user */
/** @var \yii\web\View $this */
/** @var \common\models\UserProfile $userProfile */

?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                Informasi Profile
            </div>
            <div class="card-body">
                <?php \yii\widgets\Pjax::begin([
                    'enablePushState' => false
                ]) ?>
                    <?php echo $this->render('user_profile', [
                            'userProfile' => $userProfile
                    ]) ?>
                <?php \yii\widgets\Pjax::end() ?>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                Informasi Akun
            </div>
            <div class="card-body">
                <?php \yii\widgets\Pjax::begin([
                    'enablePushState' => false
                ]) ?>
                    <?= $this->render('user_account', [
                            'user' => $user
                    ]) ?>
                <?php \yii\widgets\Pjax::end() ?>
            </div>
        </div>
    </div>
</div>

