<?php
use yii\helpers\Html;
$this->title = 'aaaa';
?>
<div class="site-index">

	<div class="jumbotron">
		<?php foreach ($data as $post) : ?>
		<h2> <?php echo Html::a($post->title, array('post/show', 'id'=>$post->id)); ?></h2>
		<?php endforeach; ?>

	</div>


</div>
