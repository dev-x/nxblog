<?php
	use yii\helpers\Html;
	use yii\widgets\LinkPager;
?>
<script type="text/javascript">

</script>
		<?php if(Yii::$app->session->hasFlash('PostDeleted')): ?>
			<div class="breadcrumb">
				<p style="font-size:18px;" class="active">Видалено</p>
			</div>
		<?php endif; ?>
		<div id="postsl">
			<?php foreach ($data as $post) : ?>
				<div style="border-bottom:1px solid #e0e0e0;" class="col-sm-12">
					<h2 style="margin-left:10px;"><?php echo Html::a($post->title, array('post/show', 'id'=>$post->id)); ?></h2>
							<!--	<div><?php
									//if (Yii::$app->user->id === $post->user_id){
										//echo Html::a('Update | ',array('post/edit','id'=>$post->id));} 
								?><?php
									//if ((Yii::$app->user->id === '1' ) || (Yii::$app->user->id === $post->user_id)){
										//echo Html::a('Delete',array('post/delete','id'=>$post->id));} 
								?></div> -->
					<div class="conte"><?= mb_substr($post->content, 0, 300, "UTF-8")."..."; ?></div>
					<div class="post_images" >
							<?php if ($post->images) foreach($post->images as $postImage): ?>
								<div><img src="<?php echo $postImage->getImageUrl('small'); ?>"></div>
							<?php endforeach; ?>
					</div>

								<ul class="list-inline">
									<?php if($post->author->avatar == null){ ?>
										<li><img style="width:40px;" src="<?= Yii::$app->homeUrl; ?>content/no_avatar<?= $MG; ?>_ib.gif"></img></li>	
										<?php }else { ?>
										<li><img style="height:30px; width:25px;" src="<?php echo $post->author->avatar; ?>"></img></li>
									<?php } ?>
										<li style="margin-left:-8px;"><?= HTML::a($post->author->username, ['user/show', 'username' => $post->author->username]) ?></li>
										<li><a href=""><span class="glyphicon glyphicon-time"></span><i><?php echo $post->post_time ?></i></a></li>
										<li><a href=""><i class="glyphicon glyphicon-comment"></i> <?php echo $post->ccount; ?> - Коментарів </a></li><li><a href=""> 
										<i class="glyphicon glyphicon-share"></i> Переглядів</a></li>
								</ul>
					<button type="submit" class="btn btn-default pull-right"><?php  echo Html::a("Дочитати", array('post/show', 'id'=>$post->id));  ?></button>
					<br>
					<br>
				</div>	
			<?php endforeach; ?>
		</div>
<div style="float:left;">
		<?php if (isset($pagination)){ echo LinkPager::widget(['pagination'=>$pagination]);} ?>
</div>