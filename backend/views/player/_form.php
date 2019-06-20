<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Tier;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\Player */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="player-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-12">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'gameid')->textInput(['maxlength' => true]) ?>

            <?php
                $tier=Tier::find()->all();
                $listData=ArrayHelper::map($tier,'id','tiername');
            ?>
            <?= $form->field($model, 'tierid')->dropDownList($listData,['prompt'=>'Silahkan pilih...']); ?>
        </div>
        <div class="col-md-6">

            <?= $form->field($model, 'nohp')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'status')->dropDownList(['A'=>'Aktif', 'F' => 'Tidak Aktif'],['prompt'=>'Silahkan pilih...']); ?> 
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    

    <?php ActiveForm::end(); ?>

</div>
