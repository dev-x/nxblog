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
	
	public function actionCreate($content)
    {
        $model = new Comment();
        $model->user_id = 1;
        $model->parent_type = 0;
        $model->content = $content;
        
        if ($model->load($_POST) && $model->save()) {
                return Yii::$app->response->redirect(array('post/show', 'id' => $model->parent_id));
        } else {
            //echo $this->render('create', array('model' => $model));
        }
    }

}
