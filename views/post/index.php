<?php
use yii\helpers\Html;
$this->title = 'aaaa';
?>
<div class="site-index">

	<div class="jumbotron">
		<?php foreach ($data as $post) : ?>
		<p> <?php echo Html::a($post->title, array('post/show', 'id'=>$post->id)); ?></p>
		<?php endforeach; ?>

	</div>


</div>
