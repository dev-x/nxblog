<?php
	use yii\helpers\Html;
	use yii\widgets\LinkPager;
?>

		<?php if(Yii::$app->session->hasFlash('PostDeleted')): ?>
			<div class="breadcrumb">
				<p style="font-size:18px;" class="active">Видалено</p>
			</div>
		<?php endif; ?>
		<div id="postslist">
			<?php foreach ($data as $post) : ?>
			<div class="row">
				<div class="col-xs-12">
						<h2><?php echo Html::a($post->title, array('post/show', 'id'=>$post->id)); ?></h2>
									<?php /*if (Yii::$app->user->id == $post->user_id){echo Html::a('Update | ',array('post/edit','id'=>$post->id));} */?>
									<?php /*if ((Yii::$app->user->id == '1' ) || (Yii::$app->user->id === $post->user_id)){	echo Html::a('Delete',array('post/delete','id'=>$post->id));} */?>
						<p><?= mb_substr($post->content, 0, 300, "UTF-8")."..."; ?></p>
							<?php $stat = $post->author->stat; if($stat == "Жіноча"){	$MG = "_G"; }else{ $MG = "_M";}?>
							<div class="col-xs-12">
										<?php if ($post->images) foreach($post->images as $postImage): ?>
										<?php //echo $postImage->getImageUrl('small'); ?>
											<img style="border:5px double #ddd;float:left;margin-bottom:20px; margin-left:-10px; margin-right:10px; width:150px;" src="<?php echo $postImage->getImageUrl('medium'); ?>">
										<?php endforeach; ?>
							</div>
							</br>
							<ul class="list-inline">
								<?php if($post->author->avatar == null){ ?>
									<li><img style="width:40px;" src="<?= Yii::$app->homeUrl; ?>content/no_avatar<?= $MG; ?>_ib.gif"></img></li>	
									<?php }else { ?>
									<li><img style="height:30px; width:25px;" src="<?php echo $post->author->avatar; ?>"></img></li>
								<?php } ?>
									<li style="margin-left:-8px;"><?= HTML::a($post->author->username, ['user/show', 'username' => $post->author->username]) ?></li>
									<li><a href=""><i class="glyphicon glyphicon-comment"></i> <?php echo $post->ccount; ?> - Коментарів </a></li><li><a href=""> <i class="glyphicon glyphicon-share"></i> 14 Переглядів</a></li>
							</ul>
							<button type="submit" class="btn btn-default pull-right"><?php  echo Html::a("Дочитати", array('post/show', 'id'=>$post->id));  ?></button>
				</div>	
			</div>	
				<hr>
			<?php endforeach; ?>
</div>			
<div class="col-sm-9">
		<?php if (isset($pagination)){ echo LinkPager::widget(['pagination'=>$pagination]);} ?>
</div>