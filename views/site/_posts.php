<?php
use yii\helpers\Html;
?>

<div class="jumbotron">
<?php foreach ($data as $post) : ?>
    <h3><?php echo Html::a($post->title, array('post/show', 'id'=>$post->id)); ?></h3>
    <p><?= mb_substr($post->content, 0, 100, "UTF-8")."..."; ?></p>
<?php endforeach; ?>
</div>