<?php
use yii\widgets\ActiveForm;
use yii\helpers\HTML;
$this->title = $modelUser->username;
//$this->some_var;
?>
	
<div class="newpost">
<?php echo $this->render('_menu', array('modelUser' => $modelUser)); ?>
	<?php
		if (!Yii::$app->user->isGuest && (Yii::$app->user->id === $modelUser->id) && ($modelUser->dozvil === '1')) {
			?>
			<?php $form = ActiveForm::begin(['id' => 'PostNew', 'action' => Yii::$app->homeUrl.'post/create']); ?>
			<?= $form->field($modelNewPost, 'title')->textInput(); ?>
			<?= $form->field($modelNewPost, 'content')->textArea(['rows' => 6]); ?>
			<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
			<?php ActiveForm::end(); ?>
			<?php }else ?>
		<div class="postsProfil">
			<?php  echo $this->render('/site/_posts', array('data' => $modelUser->posts/*,'pagination'=>$pagination*/)); ?>
		</div>
</div>		
		<div class="avatar">
				<?php echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>
		</div>
