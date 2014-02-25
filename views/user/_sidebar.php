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
<div class="avatar">
<p style='font-size:25px' class='text-primary'><?= $modelUser->username; ?></p>
<div id="forimage">
	<img src="<?= Yii::$app->homeUrl; ?><?= str_replace('.', '_ib.', $modelUser->avatar); ?>">
</div>
<?php if (!Yii::$app->user->isGuest && ($modelUser->id == Yii::$app->user->id)) : ?>
<?php \app\lib\LoadImageWidget::myRun($modelImage, 'image/create', 'form_upload_avatar', 'user', $modelUser->id); ?>
<a href="#" class="upload_button" onClick="$('#form_upload_avatar .file_input').trigger('click'); return false;"><b>Змінити аватар</b></a>
<?php if (!empty($modelUser->vk_id))
        echo HTML::a('Профіль у ВК', 'http://vk.com/id'.$modelUser->vk_id, ['target' => '_blank']);
        ?>
<!--<button id="upload_button">Upload Image</button>-->
<?php endif; ?>
</div>