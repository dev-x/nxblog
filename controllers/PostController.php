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

		echo $this->render('show', array(
				'post' => $post,
				'comments' => $comments,
				'modelNewComment' => $modelNewComment
			));
	}
	
	public function actionIndex(){
		$query = Post::find();
		//$query->orderBy("title ASC");
		$model = new ActiveDataProvider(['query'=>$query,'pagination'=>['pageSize'=>  isset($_GET['pageSize'])?$_GET['pageSize']:5]]);
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
                    $model->status = 'publish';
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
                    $modelNewPost->status = 'publish';
                  if ($modelNewPost->save()) {}
                        
                  if(Yii::$app->request->isAjax) {
                        
                      
      $str=	'<div id="createdcpost" style="padding:10px;float:left" class="panel panel-default">
			<div><h2 style="margin-left:10px;">'.Html::a($modelNewPost->title, array('post/show', 'id'=>$modelNewPost->id)).'</h2>
						<div>';
							if (Yii::$app->user->id === $modelNewPost->user_id){
								$str=$str.Html::a('Update | ',array('post/edit','id'=>$modelNewPost->id));} 
							if ((Yii::$app->user->id === '1' ) || (Yii::$app->user->id === $modelNewPost->user_id)){
								$str=$str.Html::a('Delete',array('post/delete','id'=>$modelNewPost->id));} 
						$str=$str.'</div>
			</div>
			<div class="conte">'.mb_substr($modelNewPost->content, 0, 300, "UTF-8")."...".'</div>
            <div class="post_images" >';
                     if ($modelNewPost->images) foreach($modelNewPost->images as $postImage): 
                       $str=$str.'<div><img src="'.$postImage->getImageUrl('small').'"></div>';
                     endforeach;
            $str=$str.'</div>

            <ul class="info">
				<li><img style="width:20px;" src="'.$modelNewPost->author->avatar.'"></img></li>
				<li style="margin-left:-8px;">'.HTML::a($modelNewPost->author->username, ['user/show', 'username' => $modelNewPost->author->username]).'</li>
				<li style="float:right;"><span class="glyphicon glyphicon-time"></span><i>'.$modelNewPost->post_time.'</i></li>
				<li style="float:right;"><span class="glyphicon glyphicon-list-alt"></span><b>Коментарів - </b>'.$modelNewPost->ccount.'</li>
			</ul>
			<button type="submit" class="btn btn-default pull-right">'.Html::a("Дочитати", array('post/show', 'id'=>$modelNewPost->id)).'</button>
		</div>	
		<br>';
                      
                      
                                                echo $str;
                                                } else 
                  $this->redirect(array('post/show', 'id'=>$modelNewPost->id));
                
                    };
                }
        

}
