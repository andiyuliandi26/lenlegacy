<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HeroSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hero-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'heroname') ?>

    <?= $form->field($model, 'durability') ?>

    <?= $form->field($model, 'offense') ?>

    <?= $form->field($model, 'abilityeffect') ?>

    <?php // echo $form->field($model, 'difficulty') ?>

    <?php // echo $form->field($model, 'images') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
