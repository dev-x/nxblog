<?php
use yii\helpers\Html;
?>
<?php foreach ($users as $user) : ?>
    <?= HTML::a($user->first_name.' '.$user->last_name, ['user/show', 'username' => $user->username]) ?><br/>
<?php endforeach; ?>