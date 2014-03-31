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
<body>
<?php $this->beginBody(); ?>
	<?php
		NavBar::begin([
			'brandLabel' => 'Моя Сторінка',
			'brandUrl' => Yii::$app->user->isGuest ? ['/site/login']:
				['/users/'.Yii::$app->user->identity->username.''],
			'options' => [
				'class' => 'navbar-inverse navbar-fixed-top',
				'style' => 'background-color: #111166;',
			],
        ]);
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav pull-right', 'style' => 'background-color: #111166;'],
			'items' => [
			  /*Yii::$app->user->isGuest ?
				['label' => 'Home', 'url' => ['/site/login']]:
				['label' => 'Home', 'url' => ['/users/'.Yii::$app->user->identity->username]],*/
				['label' => 'Головна', 'url' => ['/post/index']],
				['label' => 'Про нас', 'url' => ['/site/about']],
				//['label' => 'Зворотній звязок', 'url' => ['/site/contact']],
				['label' => 'Користувачі', 'url' => ['/user/index']],
				['label' => 'Реєстрація', 'url' => ['/site/signup']] ,
				Yii::$app->user->isGuest ?
					['label' => 'Вхід', 'url' => ['/site/login']] :
					['label' => 'Вихід (' . Yii::$app->user->identity->username .')' ,
						'url' => ['/site/logout'],
						'linkOptions' => ['data-method' => 'post']],
			],
		]);
		NavBar::end();
	?>
<div style="min-height: 109px; margin-top:-30px; width:100%; background-color: #000044; color: #aaaacc;" class="page-header clearfix"></div>
	<div style="margin-top:-30px;" class="container">
		<?=Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]); ?>
		<?= $content ?>
	</div>

	<footer style="background-color: #000044;color: #aaaacc;" class="footer">
		<div class="container">
			<p class="pull-left">&copy; My Company <?= date('Y') ?></p>
			<p class="pull-right"><?= Yii::powered() ?></p>
		</div>
	</footer>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
