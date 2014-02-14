<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\Image;
use app\models\User;

class ImageController extends Controller
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

	public function actionCreate()
    {
        $ok = false;
        $model = new Image();
        $model->user_id = Yii::$app->user->id ;
//        $model->parent_id = 1;
//        $model->parent_type = '';

            //UploadedFile::getInstance();
//        print_r($_POST);
        $model->load($_POST);
		
        $error = 'qwqe';
        $f = UploadedFile::getInstance($model, 'file_name');
        if ($f) {
           $error = '2';
           $model->file_name = uniqid();
		   $model->file_ext = strtolower(strrchr($f->name, '.'));

		   //Yii::app()->basePath
     		//$l = strrpos($f->name, '.');
			
           $fn = 'content/'.$model->file_name.$model->file_ext;
           if ($f->saveAs($fn)) {
               $file_info = [];
               \app\lib\Image::resize($fn, Yii::$app->params['thumbnails'][$model->parent_type], $file_info);

               $error = '3';
               $model->save();
               $res = '{"status": "ok", "img": "content/'.$model->file_name."_ib".$model->file_ext.'"}';

               $user = User::find($model->parent_id);
               $user->avatar = $fn;
               $user->save();

               $ok = true;
           }
        }

        if (Yii::$app->request->isAjax) {
            if ($ok) {
                echo $res;
            } else {
                $res = '{"status": "error", "code": "'.$error.'"}';
                echo $res;
            }
        } else {
            $this->redirect(array('user/show', 'username' => Yii::$app->user->identity->username));
//            $this->redirect(array('post/show', 'id' => $model->parent_id)); 
        }

    }

}
