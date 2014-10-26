<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/**
 * @var $this \yii\base\View
 * @var $content string
 */
app\assets\AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="<?= Yii::$app->charset ?>"/>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head(); ?>
</head>
<body> ABC
<?php $this->beginBody(); ?>
	<?php
		NavBar::begin([
			'brandLabel' => 'Моя Сторінка',
			'brandUrl' => Yii::$app->user->isGuest ? ['/site/login']:
				['/users/'.Yii::$app->user->identity->username.''],
			'options' => [
				'class' => 'navbar-inverse navbar-fixed-top',
				'style' => 'background-color:#000034;',
			],
        ]);
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav pull-right'],
			'items' => [
			  /*Yii::$app->user->isGuest ?
				['label' => 'Home', 'url' => ['/site/login']]:
				['label' => 'Home', 'url' => ['/users/'.Yii::$app->user->identity->username]],*/
				['label' => 'Posts', 'url' => ['/post/index']],
				['label' => 'About', 'url' => ['/site/about']],
				['label' => 'Contact', 'url' => ['/site/contact']],
				['label' => 'Users', 'url' => ['/user/index']],
				['label' => 'Signup', 'url' => ['/site/signup']] ,
				Yii::$app->user->isGuest ?
					['label' => 'Login', 'url' => ['/site/login']] :
					['label' => 'Logout (' . Yii::$app->user->identity->username .')' ,
						'url' => ['/site/logout'],
						'linkOptions' => ['data-method' => 'post']],
			],
		]);
		NavBar::end();
	?>
	<div style="min-height: 109px; margin-top:-30px; width:100%; background-color: #000044; color: #aaaacc;" class="page-header clearfix"></div>
	<div class="container">
		<?=Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]); ?>
		<?= $content ?>
	</div>

	<footer class="footer">
		<div class="container">
			<p class="pull-left">&copy; My Company <?= date('Y') ?></p>
			<p class="pull-right"><?= Yii::powered() ?></p>
		</div>
	</footer>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
