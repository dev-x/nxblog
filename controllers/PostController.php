<?php

namespace app\controllers;

use Yii;
use yii\helpers\BaseJson;
use yii\web\Controller;
use app\models\Post;
use app\models\Comment;
use app\models\User;


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

                $comments = $post->getComments()->all();
	}

		echo $this->render('show', array(
				'post' => $post,
				'comments' => $comments,
				'modelNewComment' => $modelNewComment
			));
	}
	
	public function actionIndex($username=NULL){
		 if ($username === NULL) {
     	     $data = Post::find()->all();
                                       echo $this->render('index', array(
           'data' => $data
           ));	
	     } else {
                 $modelNewPost = new Post;
                 $author = User::findByUsername($username);
                 if ($author && $author->id) 
                   $data = Post::find()->where(['user_id' => $author->id])->all();
 
                          echo $this->render('index', array(
           'data' => $data,
           'author' => $author,
             'modelNewPost'=>$modelNewPost
           ));	
                          
             }


	}
        
        public function actionCreate(){
                $modelNewPost = new Post;
                
                if ($modelNewPost->load($_POST) && !Yii::$app->user->isGuest) {
                    $modelNewPost->user_id = Yii::$app->user->id;
                  if ($modelNewPost->save()) {
                        $this->redirect(array('post/index', 'username'=>$modelNewPost->Author->username));
//                        $this->redirect(array('user/show', 'username'=>Yii::$app->user->username));
                    };
                }
        }

}
