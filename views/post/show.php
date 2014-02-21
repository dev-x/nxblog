<?php
/**
 * @var yii\base\View $this
 */
$this->title = $post->title;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<style>
    .author-image {
        border-radius: 24px;
        box-shadow: 0 3px 5px #8D8D8D;
        height: 48px;
        width: 48px;
    }
</style>
<div class="site-index">
		<div class="pager"><h2><?php echo $post->title; ?></h2></div>
	<?php if(Yii::$app->session->hasFlash('PostEdit')): ?>
		<div class="breadcrumb">
			<p style="font-size:18px;" class="active">Збережено</p>
		</div>
	<?php endif; ?>
		<div class="well"><?php echo $post->content; ?>
			<p class="text-right"><?php
						if (Yii::$app->user->id === $post->user_id){
							echo Html::a('Update | ',array('post/edit','id'=>$post->id));
						} 
				?>
				<?php
						if ((Yii::$app->user->id === '1' ) || (Yii::$app->user->id === $post->user_id)){
							echo Html::a('Delete',array('post/delete','id'=>$post->id));
						} 
				?>
			</p>
		</div><br>
			<?php if (Yii::$app->user->isGuest) 
					echo Html::a ('Необхідно увійти', 'site/login'); else {  ?>
            <?php $form = ActiveForm::begin(['id' => 'CommentNew', 'action' => Yii::$app->homeUrl.'comment/create','enableClientValidation'=>false]); ?>
                 <input type="hidden" name="Comment[parent_id]" value="<?= $post->id; ?>">
            <?=  $form->field($modelNewComment, 'content')->textArea(['rows' => 6]) ?>
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end();}?>
				</br>
</div>
<div id="commetslist">
	<?php foreach ($comments as $comment) : ?>
				<blockquote>
					   <?php if (!empty($comment->author->avatar)) {
						   echo '<div style="float:right"><img class="author-image" src="'.Yii::$app->homeUrl.str_replace('.', '_is.', $comment->author->avatar).'"></div>';
					   } ?>
						<?php echo "<text style='font-size:18px' class='text-primary'>
						".HTML::a($comment->author->username, ['user/show', 'username' => $comment->author->username])."
						<text class='text-info' style='font-size:12px'> | ".$comment->created."</text></text>";?>
						<text style='float:right'>
							<?php
							//	if ((Yii::$app->user->id === '1' ) || (Yii::$app->user->id === $comment->user_id)){
							//			echo Html::a('Delete',array('comment/delete','id'=>$comment->id,'idP'=>$post->id));	
							//	}
							?>
						</text>
					<div class="btn-default"> <?php echo $comment->content."</br>"; ?></div>
				</blockquote>
	<?php endforeach; ?>		
</div>
