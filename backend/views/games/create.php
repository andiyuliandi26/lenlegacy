<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Games */

$this->title = 'Create Games';
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="games-create">
    <?= $this->render('_form-create', [
        'model' => $model,
        'models' => $models
    ]) ?>

</div>
