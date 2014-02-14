<?php
	use yii\helpers\Html;
	use yii\widgets\LinkPager;
?>
<div class="page-header clearfix">
<h1 style="text-align:center; ">Блоги</h1>
</div>
<div class="row">
<div class="col-sm-9">
	<?php if(Yii::$app->session->hasFlash('PostDeleted')): ?>
		<div class="breadcrumb">
			<p style="font-size:18px;" class="active">Видалено</p>
		</div>
	<?php endif; ?>
	<?php foreach ($data as $post) : ?>
		<div style="padding:10px;float:left;" class="panel panel-default">
			<div><h2 style="margin-left:10px;"><?php echo Html::a($post->title, array('post/show', 'id'=>$post->id)); ?></h2>
						<div><?php
							if (Yii::$app->user->id === $post->user_id){
								echo Html::a('Update | ',array('post/edit','id'=>$post->id));} 
						?>
						<?php
							if ((Yii::$app->user->id === '1' ) || (Yii::$app->user->id === $post->user_id)){
								echo Html::a('Delete',array('post/delete','id'=>$post->id));} 
						?></div>
			</div>
			<div class="conte"><?= mb_substr($post->content, 0, 300, "UTF-8")."..."; ?></div>
			<ul class="info">
				<li><img style="width:20px;" src="<?php echo $post->author->avatar; ?>"></img></li>
				<li style="margin-left:-8px;"><?= HTML::a($post->author->username, ['user/show', 'username' => $post->author->username]) ?></li>
				<li style="float:right;"><span class="glyphicon glyphicon-time"></span><i><?php echo $post->post_time; ?></i></li>
				<li style="float:right;"><span class="glyphicon glyphicon-list-alt"></span><b>Коментарів - </b><?php echo $post->ccount; ?></li>
			</ul>
			<button type="submit" class="btn btn-default pull-right"><?php  echo Html::a("Дочитати", array('post/show', 'id'=>$post->id));  ?></button>
		</div>	
		<br>
	<?php endforeach; ?>
<div style="float:left;">
		<?php if (isset($pagination)){ echo LinkPager::widget(['pagination'=>$pagination]);} ?>
</div>
</div>
<div class="col-sm-3">
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
	jvndklvndlv<p>mvvdlkv lkd</p>
</div>
</div>