<?php
use yii\widgets\ActiveForm;
use yii\helpers\HTML;
$this->title = $modelUser->username;
//$this->some_var;
?>
<div style="margin-top:-50px;background-color:#fefeff;" class="row wrap">
<h1 style="text-align:center;font-size:50px; color: black;"><font>
						<?php if (!Yii::$app->user->isGuest && (Yii::$app->user->id == $modelUser->id)){
							echo "Моя Сторінка";
						}else{
							echo "Сторінка ".$modelUser->username;
						}
						?>	
			</font></h1>
	<div class="col-sm-9">
		<?php echo $this->render('_menu', array('modelUser' => $modelUser)); ?>
						<?php
							if (!Yii::$app->user->isGuest && (Yii::$app->user->id == $modelUser->id) && ($modelUser->active == 1)) {
							if ($modelNewPost->id)
								$action =  Html::url(['post/edit', 'id' => $modelNewPost->id]);
							else
								$action =  Html::url('post/create');
						?>
						<?php $form = ActiveForm::begin(['id' => 'PostNew', 'action' => $action, 'options' => ['data-edit' => $edit_action],'beforeSubmit' => new \yii\web\JsExpression('submitPost')]); ?>
						<?= $form->field($modelNewPost, 'title')->textInput(); ?>
						<?= $form->field($modelNewPost, 'content')->textArea(['rows' => 6]); ?>
						<?//= Html::submitButton('Опоблікувати', ['class' => 'btn btn-primary']) ?>
							<input type="submit" name="publish" value="Опублікувати" class="btn-primary">		
							<input type="submit" name="save" value="Зберегти" class="btn-primary">		
						<?php ActiveForm::end(); ?>
					<?php \app\lib\LoadImageWidget::myRun($modelImage, 'image/create', 'form_upload_post_image', 'post', $modelNewPost->id?$modelNewPost->id:0 /*$modelNewPost->id*/); ?>
					<div id="post_images" data-delurl="<?php echo Html::url('image/delete'); ?>">
						<?php if ($modelNewPost->id): ?>
							<?php if ($modelNewPost->images) foreach($modelNewPost->images as $postImage): ?>
								<div id="divimage<?php echo $postImage->id; ?>"><img src="<?php echo $postImage->getImageUrl('small'); ?>">
									<span class="delete_button" onClick="deleteImage(<?php echo $postImage->id; ?>);"><span class="delete"></span></span>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<a href="#" class="upload_button" onClick="$('#form_upload_post_image .file_input').trigger('click'); return false;"><b>Добавити фото</b></a>
					<?php } ?>
				<div class="postsProfil">
						<?php  echo $this->render('/site/_posts', array('data' => $modelUser->publishPosts/*,'pagination'=>$pagination*/)); ?>
				</div>	
	</div>
	<div class="col-sm-3">
			<div class="avatar">
					<?php echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>
			</div>
	</div>
</div>
