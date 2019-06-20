<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SeasonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="season-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'league') ?>

    <?= $form->field($model, 'seasonname') ?>

    <?= $form->field($model, 'tglmulai') ?>

    <?= $form->field($model, 'tglselesai') ?>

    <?php // echo $form->field($model, 'jumlahpeserta') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
