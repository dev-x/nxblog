<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Masseges */

$this->title = 'Create Masseges';
$this->params['breadcrumbs'][] = ['label' => 'Masseges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="masseges-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
