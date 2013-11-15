<?php

namespace app\controllers;

use Yii;
use yii\helpers\BaseJson;
use yii\web\Controller;
use app\models\Post;

class PostController extends Controller
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

	public function actionShow($id=null)
	{
		if ($id) 
		$post = Post::find($_GET['id']);

		//echo $post->getPostTitle();
		
		return $this->render('show', array(
				'post' => $post,
			));
	}
	
	public function actionIndex($user_id=NULL){
		 if ($user_id === NULL) {
     	     $data = Post::find()->all();
	     } else 
	     	     $data = Post::find()->where(['user_id' => $user_id])->all();

         echo $this->render('index', array(
           'data' => $data
           ));	
	}

}
