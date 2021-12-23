<?php


namespace frontend\controllers;


use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class ProfileController extends \frontend\base\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'update-profile', 'update-account',],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }
    /**
     * Menambahkan menu Profile
     *
     */
    public function actionIndex()
    {
        /** @var User $user */
        $user = Yii::$app->user->identity;
        $userProfile = $user->getProfile();
        return $this->render('index', [
            'user' => $user,
            'userProfile' => $userProfile
        ]);
    }

    /**
     * @return string
     * Menu Update Profile
     */
    public function actionUpdateProfile()
    {
        if (Yii::$app->request->isAjax){
            throw new ForbiddenHttpException();
        }
        $user = Yii::$app->user->identity;
        $userProfile = $user->getProfile();
        $success = false;
        if ($userProfile->load(Yii::$app->request->post()) && $userProfile->save()) {
            $success = true;
        }
        return $this->renderAjax('user_profile', [
            'userProfile' => $userProfile,
            'success' => $success
        ]);
    }

    /**
     * @return string
     * Menu Update Akun
     */
    public function actionUpdateAccount()
    {
        if (Yii::$app->request->isAjax){
            throw new ForbiddenHttpException();
        }
        $user = Yii::$app->user->identity;
        $success = false;
        if ($user->load(Yii::$app->request->post()) && $user->save()) {
            $success = true;
        }
        return $this->renderAjax('user_account', [
            'user' => $user,
            'success' => $success
        ]);
    }
}