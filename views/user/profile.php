<?php echo $this->render('_menu', array('modelUser' => $modelUser)); ?>
<div class="profil">
	Ім'я: <strong><?= $modelUser->first_name; ?></strong><br/>
	Прізвище: <strong><?= $modelUser->last_name; ?></strong>
</div>
<div class="avatar">
	<?php echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>
</div>