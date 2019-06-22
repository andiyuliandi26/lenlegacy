<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Games */

$this->title = 'Update Games: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="games-update">

    <?= $this->render('_form', [
        'model' => $model,
		'models' => $models
    ]) ?>

</div>
