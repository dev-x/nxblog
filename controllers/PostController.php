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
use yii\helpers\Html;

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
	$postSidebar = Post::find()->orderBy('post_time DESC')->limit(3)->all();
		echo $this->render('show', array(
				'postSidebar'=>$postSidebar,
				'post' => $post,
				'comments' => $comments,
				'modelNewComment' => $modelNewComment
			));
	}
	
	public function actionIndex(){
		$query = Post::find()->orderBy('post_time DESC');
		//$query->orderBy("title ASC");
		$model = new ActiveDataProvider(['query'=>$query,'pagination'=>['pageSize'=>  isset($_GET['pageSize'])?$_GET['pageSize']:5]]);
		$postSidebar = Post::find()->orderBy('post_time DESC')->limit(3)->all();
		echo $this->render('index', [
			'postSidebar'=>$postSidebar,
			'data'=>$model->getModels(),
			'pagination'=>$model->pagination,
			'count'=>$model->pagination->totalCount,
		]);
	}

	public function actionDelete($id)
	{
		$post = Post::find($id);
        if ( $post ) {
				$post->delete();
            }    
			Yii::$app->session->setFlash('PostDeleted');
			$this->redirect($_SERVER['HTTP_REFERER']);
	}
	
    
    public function actionEddit($id)
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
    
	public function actionEdit($id)
	{
        $model = Post::find($id); 
        if ($model->load($_POST) && !Yii::$app->user->isGuest) {
            $model->status = 'publish';
            if ($model->save()) {
                if(Yii::$app->request->isAjax) {
                    $res = $this->genResponseData($model);
                }
                $res['status'] = 'ok';
            } else $res['status'] = 'error';
        } else $res['status'] = 'error';
        if (Yii::$app->request->isAjax) {
            echo json_encode($res);
        } else {
            Yii::$app->session->setFlash('PostEdit');
            $this->redirect(array('post/show', 'id'=>$model->id));
        }
    }

    public function actionCreate()
    {
        $modelNewPost = new Post;
        if ($modelNewPost->load($_POST) && !Yii::$app->user->isGuest) {
            $modelNewPost->status = 'publish';
            if ($modelNewPost->save()) {
                if(Yii::$app->request->isAjax) {
                    $res = $this->genResponseData($modelNewPost);
                }
                $res['status'] = 'ok';
            } else $res['status'] = 'error';
        } else $res['status'] = 'error';
        if (Yii::$app->request->isAjax) {
            echo json_encode($res);
        } else {
            $this->redirect(array('post/show', 'id'=>$modelNewPost->id));
        }
    }
    
    private function genResponseData(&$post) {
        $res['status'] = 'ok';
                    $res['data']['titleUrl'] = HTML::url(['post/show', 'id' => $post->id]);
                    $res['data']['autorUrl'] = HTML::url(['user/show', 'username' => $post->author->username]);
                    $res['data']['autorName'] = $post->author->username;
                    $res['data']['titlePost'] = $post->title;
                    $res['data']['timePost'] = $post->post_time;
                    $res['data']['comentCountPost'] = $post->ccount;
                    $res['data']['contentPost'] = mb_substr($post->content, 0, 300, "UTF-8");
                    if (!empty($post->author->avatar)) {
							$res['data']['avatarurl'] = Yii::$app->homeUrl.str_replace(".", "_is.", $post->author->avatar);
					}
                    if ($post->images)
                        foreach ($post->images as $postImage){
                            $res['data_childs'][] = Array('src' => $postImage->getImageUrl('small')); 
                        }
        return $res;
    }
}