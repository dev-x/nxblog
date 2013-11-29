<?php
/**
 * @var yii\base\View $this
 */
$this->title = $post->title;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<style>
    .author-image {
        border-radius: 24px;
        box-shadow: 0 1px 2px #8D8D8D;
        height: 48px;
        width: 48px;
    }
</style>
<div class="site-index">
	<div class="jumbotron">
		<div id="titl"><?php echo $post->title; ?></div>
		 <div id="conten"><?php echo $post->content; ?></div><br>
		 <p>---------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
     <?php if (Yii::$app->user->isGuest) 
                      echo Html::a ('Необхідно увійти', 'site/login'); else {  ?>
                 <?php $form = ActiveForm::begin(['id' => 'CommentNew', 'action' => Yii::$app->homeUrl.'comment/create']); ?>
                 <?php /* echo $form->field($modelNewComment, 'parent_id')->input('hidden', ['value' => 13]); */ ?>
                 <input type="hidden" name="Comment[parent_id]" value="<?= $post->id; ?>">
                       <?=  $form->field($modelNewComment, 'content')->textArea(['rows' => 6]) ?>
                         <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                 <?php ActiveForm::end(); ?>
                      <?php } ?>
         
		</div>
		<?php foreach ($comments as $comment) : ?>
        <div style="overflow: hidden;margin:10px;">
           <?php if (!empty($comment->author->avatar)) {
               echo '<div style="float:right"><img class="author-image" src="'.Yii::$app->homeUrl.str_replace('.', '_is.', $comment->author->avatar).'"></div>';
           } ?>
   <div><?php echo $comment->author->username." - ".$comment->created; echo "<br/>";   ?></div>
		<p > <?php echo $comment->content; ?></p>
        </div>
		<?php endforeach; ?>
	
	</div>
