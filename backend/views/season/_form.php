<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Season */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="season-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'league')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seasonname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tglmulai')->textInput() ?>

    <?= $form->field($model, 'tglselesai')->textInput() ?>

    <?= $form->field($model, 'jumlahpeserta')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
