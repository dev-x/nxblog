
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
			<?php foreach ($modelUser->userImages as $image) : ?>
				<?php $src =  Yii::$app->homeUrl."content/".$image->file_name."_m".$image->file_ext; ?>
					<img id="kartinka" class="imge" src="<?= $src; ?>"></img>
			<?php endforeach; ?>
	</div>
		<div class="col-sm-3">
			<?php echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>
		</div>
</div>