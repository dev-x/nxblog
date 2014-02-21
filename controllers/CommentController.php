<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Comment;
use yii\helpers\Html;

class CommentController extends Controller
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
		$comment= Comment::find()->where(['parent_id' => $id])->all();
		return $this->render('show', array('comment' => $comment));
	}
	
	public function actionCreate()
    {
        $model = new Comment();
        
                if ($model->load($_POST) && !Yii::$app->user->isGuest) {
                    $model->parent_type = 0;
                    $model->user_id = Yii::$app->user->id;
                    $model->created = date("Y-m-d H:i:s");
                    if ($model->save()) {
						//$this->redirect(array('post/show', 'id'=>$_POST['Comment']['parent_id']));
                    }
                    if(Yii::$app->request->isAjax) {
                        $str='<blockquote id="'.$model->id.'">';
                if (!empty($model->author->avatar)) {
                $str=$str.'<div style="float:right"><img class="author-image" src='.Yii::$app->homeUrl.str_replace(".", "_is.", $model->author->avatar).'></div>';
			   }
	$str=$str."<text style='font-size:18px' class='text-primary'>".HTML::a(Yii::$app->user->identity->username, ['user/show', 'username' => Yii::$app->user->identity->username])."<text class='text-info' style='font-size:12px'> | ".$model->created."</text></text>"."<text style='float:right'>";
	if ((Yii::$app->user->id === '1' ) || (Yii::$app->user->id === $model->user_id)){
	$str=$str;//.Html::a('Delete',array('comment/delete','id'=>$model->id,'idP'=>$post->id));	
	}
						
			$str=$str.'</text><div class="btn-default">'.$model->content.'</br>'.'</div></blockquote>';
                                                echo $str;
                                                } else 
                  $this->redirect(array('post/show', 'id'=>$model->parent_id));
                }
    }
	
	public function actionDelete($id,$idP)
	{
		$comment = Comment::find($id);
		$comment->delete();
		$this->redirect(array('post/show', 'id'=>$idP));
		//$this->redirect(array('/posts'));
		//$this->loadModel($id)->delete();
		//$this->redirect(array('post/show', 'id'=>$model->parent_id));		
	}
	
}
