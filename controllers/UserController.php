<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\Image;

class UserController extends Controller
{
	public function actions()
	{
		return array(
			'error' => array(
				'class' => 'yii\web\ErrorAction',
			),
			'captcha' => array(
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			),
		);
	}

	public function actionShow($username=null)
    {
        $user = User::findByUsername($username);

        if ($user) {}
        $image = new Image();

        return $this->render('show', ['modelUser' => $user, 'modelImage' => $image]);
    }

}
