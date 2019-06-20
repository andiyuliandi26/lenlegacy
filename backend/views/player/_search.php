<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PlayerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="player-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'nickname') ?>

    <?= $form->field($model, 'tierid') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'gameid') ?>

    <?php // echo $form->field($model, 'nohp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
