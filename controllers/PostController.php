<?php

namespace app\controllers;
use yii\web\HttpException;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

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
	
	public function actionIndex(){
		$query = Post::find();
		//$query->orderBy("title ASC");
		$model = new ActiveDataProvider(['query'=>$query,'pagination'=>['pageSize'=>$_GET['pageSize']?:5]]);
		echo $this->render('index', [
			'data'=>$model->getModels(),
			'pagination'=>$model->pagination,
			'count'=>$model->pagination->totalCount,
		]);
	}

	public function actionDelete($id)
		{
			$post = Post::find($id);
				$post->delete();
				Yii::$app->session->setFlash('PostDeleted');
				$this->redirect($_SERVER['HTTP_REFERER']);
		}
	
	public function actionEdit($id)
	{
		if($model = Post::find($id)){
				if ($model->load($_POST)) {
					if ($model->save()){
						Yii::$app->session->setFlash('PostEdit');
						$this->redirect(array('post/show', 'id'=>$model->id));
					}
				}else{
					echo $this->render('edit', array('model' => $model));
				}
		}
		
	}
	
        public function actionCreate(){
		
                $modelNewPost = new Post;
                if ($modelNewPost->load($_POST) && !Yii::$app->user->isGuest) {
                    $modelNewPost->user_id = Yii::$app->user->id;
					$modelNewPost->post_time = date("Y-m-d H:i:s");
                  if ($modelNewPost->save()) {
                        $this->redirect(array('user/show', 'username'=>$modelNewPost->Author->username));
//                        $this->redirect(array('user/show', 'username'=>Yii::$app->user->username));
                    };
                }
        }

}
