<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\Image;
use app\models\Post;
use yii\data\ActiveDataProvider;

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

    public function actionIndex() {
        /*($users = User::find()->all();
        return $this->render('index', ['users' => $users]);*/
		$query = User::find();
		$model = new ActiveDataProvider(['query'=>$query,'pagination'=>['pageSize'=>$_GET['pageSize']?:6]]);
		echo $this->render('index', [
			'users'=>$model->getModels(),
			'pagination'=>$model->pagination,
			'count'=>$model->pagination->totalCount
		]);
    }

	public function actionShow($username=null)
    {
        $user = User::findByUsername($username);

        if ($user) {}
        $image = new Image();

        //$images = $user->getUserImages();
        $modelNewPost = new Post();
		
		

        return $this->render('show', ['modelUser' => $user, 'modelImage' => $image, 'modelNewPost' => $modelNewPost]);
    }

    public function actionImages($username=null)
    {
        $user = User::findByUsername($username);
        $image = new Image();

        return $this->render('images', ['modelUser' => $user, 'modelImage' => $image]);
    }

    public function actionProfile($username=null)
    {
        $user = User::findByUsername($username);
        $image = new Image();

        return $this->render('profile', ['modelUser' => $user, 'modelImage' => $image]);
    }

    public function actionPosts($username=null)
    {
        $user = User::findByUsername($username);
        $image = new Image();

        return $this->render('posts', ['modelUser' => $user, 'modelImage' => $image]);
    }

}
