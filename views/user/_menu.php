<?php
use yii\helpers\Html;
?>
<div style="width: 920px; float: left;">
<?= HTML::a('Posts', ['user/show', 'username' => $modelUser->username]); ?>&nbsp;
<?= HTML::a('Images', ['user/images', 'username' => $modelUser->username]); ?>&nbsp;
<?= HTML::a('Profile', ['user/profile', 'username' => $modelUser->username]); ?>
<br/><br/>
