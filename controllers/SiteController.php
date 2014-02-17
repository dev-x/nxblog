<?php

namespace app\controllers;

use Yii;
use yii\helpers\BaseSecurity;
use yii\web\AccessControl;
use yii\web\Controller;
use yii\web\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\ActiveDataProvider;
use app\models\User;

class SiteController extends Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['login', 'logout'],
				'rules' => [
					[
						'actions' => ['login'],
						'allow' => true,
						'roles' => ['?'],
					],
					[
						'actions' => ['logout'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionLogin()
	{
		$model = new LoginForm();
		if ($model->load($_POST) && $model->login()) {
			return $this->goBack();
		} else {
//            echo "-".\yii\helpers\BaseSecurity::generatePasswordHash($model->password)."-";
			return $this->render('login', [
				'model' => $model,
			]);
		}
	}

	public function actionLogout()
	{
		Yii::$app->user->logout();
		return $this->goHome();
	}

	public function actionContact()
	{
		$model = new ContactForm;
		if ($model->load($_POST) && $model->contact(Yii::$app->params['adminEmail'])) {
			Yii::$app->session->setFlash('contactFormSubmitted');
			return $this->refresh();
		} else {
			return $this->render('contact', [
				'model' => $model,
			]);
		}

	}

	public function actionAbout()
	{
		return $this->render('about');
	}
	public function actionSignup()
	{

             $model = new User();
		if ($model->load($_POST)){
		$model->password_hash = \yii\helpers\BaseSecurity::generatePasswordHash($model->password);
                $model->auth_key = 'key';
                if ($model->save()) {
			if (Yii::$app->getUser()->login($model)) {
				return $this->goHome();
			}
		}
	}
		return $this->render('signup', [
			'model' => $model,
		]);
        }
}
