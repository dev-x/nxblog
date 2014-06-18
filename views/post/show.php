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
<div style="background-color:#fff" class="well" id="createdcomment">
	<div style="float:right"><img class="author-image" src='<%= avatarurl %>'></div>
	<text style='font-size:18px' class='text-primary'><a hfer='<%= userurl %>'><%= username %></a>
				<text class='text-info' style='font-size:12px'> | <%= datetime %></text></text>
				<text style='float:right'></text>
				<div class="btn-default"><%= content %></br></div></div>
</script>

<div class="row wrap">
	<div style="margin-top:3px;min-height:550px;" class="col-sm-9">
		<i style="float:right;color:#008B66;"><?php echo $post->post_time; ?></i><span style="color:#008B66;float:right;" class="glyphicon glyphicon-time"></span>
		<h3 style="text-align:center;font-size:40px; color: black;"><font style="color:#008B66;"><?php echo $post->title; ?></font></h3>	
		<?php if(Yii::$app->session->hasFlash('PostEdit')): ?>
			<div class="breadcrumb">
				<p style="font-size:18px;" class="active">Збережено</p>
			</div>
		<?php endif; ?>
			<div style="padding:12px 0px 10px 10px;margin-top:-20px;" class="col-sm-12">
                    <?php if ($post->images) foreach($post->images as $postImage):
                                       $qwe = $postImage->getImageUrl('medium'); 	
                                endforeach; ?>
                      <?php if($qwe){  ?>
                            <div class="col-sm-12" style="padding:0px; ">
                                <div id="photoqwer" align="center" style="width:auto; height:auto;">
                                        
                                        <img src="<?php echo $qwe;?>" style="width:100%;border:3px double #ddd;">
                                </div>
                                <div id="galleri" align="center" style="padding:5px; margin-top:5px; border-top:2px solid #D7E0FF; border-bottom:2px solid #D7E0FF; background-color:#F2F5FF;">
                                    <?php if ($post->images) foreach($post->images as $postImage):  ?>
                                    <?php //echo $postImage->getImageUrl('small'); ?>
                                            <img style="opacity:0.8; cursor:pointer; border:5px double #ddd; margin-left:7px;width:64px;" src="<?php echo $postImage->getImageUrl('medium');?>"> 
                                    <?php endforeach; ?>
                                    <?php   //echo $post->images[0]->getImageUrl('medium');
                                            //echo $post->images[1]->getImageUrl('medium');
                                            //echo $post->images[2]->getImageUrl('medium');

                                    ?>
                                </div>
                            </div>
                           <?php }; ?>
					<p style="font-size:16px; font-family:'Times New Roman';"><?php echo $post->content; ?></p>
			</div>
				<p class="text-right"><?php
                   		if (Yii::$app->user->id == $post->user_id){
								echo Html::a('Update | ',array('post/eddit','id'=>$post->id));
							} 
					?>
					<?php
							if ((Yii::$app->user->id === '1' ) || (Yii::$app->user->id === $post->user_id)){
								//echo Html::a('Delete',array('post/delete','id'=>$post->id));
							} 
					?>
				</p>
			<div style="padding:10px;margin-top:50px; background-color:#F7FFFE;" class="well bs-component">
				<?php if (Yii::$app->user->isGuest) { ?>
						<?php echo Html::a ('Необхідно увійти', 'site/login'); } 
											elseif (Yii::$app->user->identity->dozvil != 1) { ?>
					<h3>В даний час, ви не активовані</h3>
											<?php } else {?>
				<?php $form = ActiveForm::begin(['id' => 'CommentNew', 'action' => Yii::$app->homeUrl.'comment/create', 'beforeSubmit' => new \yii\web\JsExpression('submitComment') /*,'enableClientValidation'=>false*/]); ?>
					 <input type="hidden" name="Comment[parent_id]" value="<?= $post->id; ?>">
				<?=  $form->field($modelNewComment, 'content')->textArea(['rows' => 1,  'placeholder' => 'Ваш коментар', 'id'=>'newComment']) ?>
				<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']); ?>
				<?php ActiveForm::end();}?>
			</div>
		<div id="commetslist">
			<?php foreach ($comments as $comment) : ?>
						<div style="background-color:#fff" class="well" id="<?= $comment->id ?>">
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
						</div>
			<?php endforeach; ?>		
		</div>
	</div>
	<div class="col-sm-3">
				<?php echo $this->render('/user/_sidebar', array('author' => $post->author, 'postSidebar' =>$postSidebar)); ?>
	</div>
</div>
