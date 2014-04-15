<script type="text/javascript">
	function onPhoto(){
		var photo = document.getElementById('photo')
		var shadow = document.getElementById('shadow')
		shadow.style.display = "block";
		photo.style.display = "block";
		photo.style.backgroundImage = 'url("'+this.src+'")';
	}
	function hidePhoto(){
		var photo = document.getElementById('photo')
		var shadow = document.getElementById('shadow')
		shadow.style.display = "";
		photo.style.display = "";
	}
	window.onload = function(){
			var img = document.getElementById('kartinka');
			img.onclick = onPhoto;
			var photo = document.getElementById('photo');
			photo.onclick = hidePhoto
		} 
</script>
	
<div class="row wrap">
	<div class="col-sm-9">
		<?php echo $this->render('_menu', array('modelUser' => $modelUser)); ?>
		<div style="margin-top:15px;" class="col-sm-12">
			<?php foreach ($modelUser->userImages as $image) : ?>
				<?php $src =  Yii::$app->homeUrl."content/".$image->file_name."_m".$image->file_ext; ?>
				<img id="kartinka" class="imge" src="<?= $src; ?>"></img>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="avatar">
		<?php echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>
	</div>
</div>
	<div id="shadow"></div>
	<div id="photo"></div>
