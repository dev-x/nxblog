<?php echo $this->render('_menu', array('modelUser' => $modelUser)); ?>
Ім'я: <strong><?= $modelUser->first_name; ?></strong><br/>
Прізвище: <strong><?= $modelUser->last_name; ?></strong>
<?php echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>

