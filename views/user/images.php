<?php echo $this->render('_menu', array('modelUser' => $modelUser)); ?>
<?php foreach ($modelUser->userimages as $image) : ?>
    <img src='<?= Yii::$app->homeUrl; ?>content/<?= $image->file_name ?>_s<?= $image->file_ext ?>'>
<?php endforeach; ?>
<?php echo $this->render('_sidebar', array('modelUser' => $modelUser, 'modelImage' => $modelImage)); ?>
