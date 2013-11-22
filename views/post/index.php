<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = '';
?>
<div class="site-index">
    	<?php                if (Yii::$app->user->isGuest) {
                    echo Html::a('Необхідно увійти', 'site/login');
                } else {
                    if (isset($author) && (Yii::$app->user->id === $author->id)) {
                        ?>
                        <?php $form = ActiveForm::begin(['id' => 'PostNew', 'action' => '/nxblog/web/post/create']); ?>
                        <?= $form->field($modelNewPost, 'title')->textArea(['rows' => 1]) ?>
                        <?= $form->field($modelNewPost, 'content')->textArea(['rows' => 6]) ?>
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                        <?php ActiveForm::end(); ?>
                    <?php }
                } ?>

	<div class="jumbotron">
		<?php foreach ($data as $post) : ?>
		<p> <?php echo Html::a($post->title, array('post/show', 'id'=>$post->id)); ?></p>
		<?php endforeach; ?>

	</div>


</div>
