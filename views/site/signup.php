<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var common\models\User $model
 */
$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
	<h1><?= Html::encode($this->title) ?></h1>



	<div class="row">
		<div class="col-lg-5">
			<?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
				<?= $form->field($model, 'username') ?>
				<?= $form->field($model, 'email') ?>
				<?= $form->field($model, 'password')->passwordInput() ?>
                                <?= $form->field($model, 'first_name') ?>
                                <?= $form->field($model, 'last_name') ?>
				<div class="form-group">
					<?= Html::submitButton('Signup', ['class' => 'btn btn-primary']) ?>
				</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
