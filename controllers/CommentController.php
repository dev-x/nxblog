<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Comment;

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
