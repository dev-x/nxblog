<?php
use yii\helpers\Html;
?>
<script>
	
</script>
<div style="width: 920px; float: left;">
	<ul class="nav nav-tabs">
		<li class=""><?= HTML::a('Блоги', ['user/show', 'username' => $modelUser->username]); ?></li>
		<li class=""><?= HTML::a('Фотографії', ['user/images', 'username' => $modelUser->username]); ?></li>
		<li class=""><?= HTML::a('Профіль', ['user/profile', 'username' => $modelUser->username]); ?></li>
	</ul></br></br>
</div>
<!--
<div class="form-actions" style="width: 920px; float: left;">
	<button type="submit" class="btn btn-default"><?//= HTML::a('Блоги', ['user/show', 'username' => $modelUser->username]); ?></button>
	<button type="submit" class="btn btn-default"><?//= HTML::a('Фотографії', ['user/images', 'username' => $modelUser->username]); ?>&nbsp;</button>
	<button type="submit" class="btn btn-default"><?//= HTML::a('Профіль', ['user/profile', 'username' => $modelUser->username]); ?></button>
</div></br></br>

-->