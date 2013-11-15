<?php

namespace app\controllers;

use Yii;
use yii\helpers\BaseJson;
use yii\web\Controller;
use app\models\Post;
use app\models\Comment;


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
		if ($id){ 
		$post = Post::find($id);
		//$comments = Comment::find()->where(['parent_id' => $id])->all();
	      //print_r($comments);
              	    
            //if (isset($_POST['_csrf'])) {
                $modelNewComment = new Comment;
                
                if ($modelNewComment->load($_POST)) {
                    $modelNewComment->parent_id = $id;
                    $modelNewComment->parent_type = 0;
                    $modelNewComment->user_id = 1;
                    if ($modelNewComment->save()) {
                        unset($modelNewComment);
                        $modelNewComment = new Comment;
                    };
                }

                $comments = $post->getComments()->all();
	}
	


		
		
		echo $this->render('show', array(
				'post' => $post,
				'comments' => $comments,
				'modelNewComment' => $modelNewComment
			));
	}
	
	public function actionIndex($user_id=NULL){
		 if ($user_id === NULL) {
     	     $data = Post::find()->all();
	     } else {
                 
                 $data = Post::find()->where(['user_id' => $user_id])->all();
             }

         echo $this->render('index', array(
           'data' => $data
           ));	
	}

}
