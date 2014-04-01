<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = $modelUser->username;
?>
</div>
<style>
    .field-image-file_name {
        /*display: none;*/
    }
</style>
<?php
if(strpos($this->context->getRoute(),'user') === 0) { $a = 1; $userX = $modelUser; }
if($this->context->getRoute() == 'post/show') { $a = 2; $userX = $author; }
if ($a > 0) : 
?>
	<div class="col-sm-3">
			<p style='font-size:25px' class='text-primary'><?= $userX->first_name." ".$userX->last_name ?></p>
			<div id="forimage">
			<?php  $stat = Yii::$app->user->identity->stat; if($stat == "Жіноча"){ $MG = "_G"; }else{ $MG = "_M";}?>
				<?php if($userX->avatar == null){ ?>
					<img style="border-radius: 4px;width:250px; box-shadow:0px 0px 5px #9d9d9d;" src="<?= Yii::$app->homeUrl; ?>content/no_avatar<?= $MG; ?>_ib.gif">
				<?php }else { ?>
					<img style="border-radius: 4px;width:250px; box-shadow:0px 0px 5px #9d9d9d;" src="<?= Yii::$app->homeUrl; ?><?= str_replace('.', '_ib.', $userX->avatar); ?>">
				<?php }?>
			</div>
			<?php if (!Yii::$app->user->isGuest && ($userX->id == Yii::$app->user->id) && ($a == 1)) : ?>
			<?php \app\lib\LoadImageWidget::myRun($modelImage, 'image/create', 'form_upload_avatar', 'user', $userX->id); ?>
			<a href="#" class="upload_button" onClick="$('#form_upload_avatar .file_input').trigger('click'); return false;"><b>Змінити аватар</b></a><br>
			<?php if (!empty($userX->vk_id))
					echo HTML::a('Профіль у ВК', 'http://vk.com/id'.$userX->vk_id, ['target' => '_blank'])."<br>";
					?>
			<!--<button id="upload_button">Upload Image</button>-->
			<?php endif; ?>
				<h4><i class="glyphicon glyphicon-calendar"><b>День народження:</b></i><?php echo $userX->birthday; ?></h4>
			    <h4><i class="glyphicon glyphicon-home"><b>Вуз:</b></i><?php echo $userX->vnz; ?></h4>
			    <h4><i class="glyphicon glyphicon-home"><b>Група:</b></i><?php echo $userX->group_id; ?></h4>
		</div>
<?php endif; ?>
<?php if(($this->context->getRoute() == "post/index") || (strpos($this->context->getRoute(),'post') === 0)) : ?>
	
		<div class="col-xs-3">
			<h3>Найбільш обговорювані</h3>
			<?php foreach ($postSidebar as $post) : ?>
				<div class="panel panel-default">
					<div class="panel-heading"><p style="font-size:25px;"><?php echo $post->title."<br>"; ?></p></div>
					<div class="panel-body">
							<?php if ($post->images) foreach($post->images as $postImage): ?>
							<?php //echo $postImage->getImageUrl('small'); ?>
									<img style="width:80px; margin:0px 5px 2px 2px; float:left;box-shadow:0 0 2px #9d9d9d;" src="<?php echo $postImage->getImageUrl('small'); ?>">
							<?php endforeach; ?>
						<div style="width:100%;">
							<?= mb_substr($post->content, 0, 100, "UTF-8")."..."; ?>
						</div>
						<button type="submit" class="btn btn-default pull-right"><?php  echo Html::a("Дочитати", array('post/show', 'id'=>$post->id));  ?></button>
					</div>
				</div>
				<hr>
			<?php endforeach; ?>
		</div>
	 
<?php endif; ?>