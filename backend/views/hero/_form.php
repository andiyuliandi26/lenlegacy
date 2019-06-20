<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Hero */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hero-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'heroname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'durability')->textInput() ?>

    <?= $form->field($model, 'offense')->textInput() ?>

    <?= $form->field($model, 'abilityeffect')->textInput() ?>

    <?= $form->field($model, 'difficulty')->textInput() ?>

    <?= $form->field($model, 'images')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
