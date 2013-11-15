<?php
/**
 * @var yii\base\View $this
 */
$this->title = $post->title;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="site-index">
	<div class="jumbotron">
		<div id="titl"><?php echo $post->title; ?></div>
		 <div id="conten"><?php echo $post->content; ?></div><br>
		 <p>---------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
		 <?php $form = ActiveForm::begin(['id' => 'CommentNew']); ?>
		 <?= '';//$form->field($modelNewComment, 'parent_id')->input('hidden'); ?>
                       <?=  $form->field($modelNewComment, 'content')->textArea(['rows' => 6]) ?>
                         <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                 <?php ActiveForm::end(); ?>
		<?php //if (){CommentController::actionCreate('');} ?>
		</div>
		<?php foreach ($comments as $comment) : ?>
		<p > <?php echo $comment->content; ?></p>
		<?php endforeach; ?>
	
	</div>
