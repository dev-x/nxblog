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
<script type="text/template" id="template-comment-element">
<blockquote id="createdcomment">
	<div style="float:right"><img class="author-image" src='<%= avatarurl %>'></div>
	<text style='font-size:18px' class='text-primary'><a hfer='<%= userurl %>'><%= username %></a>
				<text class='text-info' style='font-size:12px'> | <%= datetime %></text></text>
				<text style='float:right'></text>
				<div class="btn-default"><%= content %></br></div></blockquote>
</script>

<div class="row wrap">
	<div style="margin-top:3px;min-height:550px;" class="col-sm-9">
		<i style="float:right;"><?php echo $post->post_time; ?></i><span style="float:right;" class="glyphicon glyphicon-time"></span>
		<h3 style="text-align:center;font-size:40px; color: black;"><font><?php echo $post->title; ?></font></h3>	
		<?php if(Yii::$app->session->hasFlash('PostEdit')): ?>
			<div class="breadcrumb">
				<p style="font-size:18px;" class="active">Збережено</p>
			</div>
		<?php endif; ?>
			<div style="padding:12px 0px 10px 10px;margin-top:-20px;" class="col-sm-12">
					<div id="galleri">
						<?php if ($post->images) foreach($post->images as $postImage): ?>
							<?php //echo $postImage->getImageUrl('small'); ?>
								<img style="border:5px double #ddd; margin-left:7px;width:824px;" src="<?php echo $postImage->getImageUrl('medium'); ?>">	
						<?php endforeach; ?>
					</div>
					<p style="font-size:16px; font-family:'Times New Roman';"><?php echo $post->content; ?></p>
			</div>
				<!--<p class="text-right"><?php
							if (Yii::$app->user->id === $post->user_id){
								//echo Html::a('Update | ',array('post/edit','id'=>$post->id));
							} 
					?>
					<?php
							if ((Yii::$app->user->id === '1' ) || (Yii::$app->user->id === $post->user_id)){
								//echo Html::a('Delete',array('post/delete','id'=>$post->id));
							} 
					?>
				</p> -->
			<br>
				<?php if (Yii::$app->user->isGuest) { ?>
						<?php echo Html::a ('Необхідно увійти', 'site/login'); } 
											elseif (Yii::$app->user->identity->dozvil != 1) { ?>
					<h3>В даний час, ви активовані</h3>
											<?php } else {?>
				<?php $form = ActiveForm::begin(['id' => 'CommentNew', 'action' => Yii::$app->homeUrl.'comment/create', 'beforeSubmit' => new \yii\web\JsExpression('submitComment') /*,'enableClientValidation'=>false*/]); ?>
					 <input type="hidden" name="Comment[parent_id]" value="<?= $post->id; ?>">
				<?=  $form->field($modelNewComment, 'content')->textArea(['rows' => 1]) ?>
				<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
				<?php ActiveForm::end();}?>
					</br>
		<div id="commetslist">
			<?php foreach ($comments as $comment) : ?>
						<blockquote id="<?= $comment->id ?>">
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
	</div>
	<div class="col-sm-3">
				<?php echo $this->render('/user/_sidebar', array('author' => $post->author, 'postSidebar' =>$postSidebar)); ?>
	</div>
</div>
