<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HeroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Heroes';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .crop-images {
        object-fit: cover;
        object-position: 0% 0;
        
        width: 60px;
        height: 60px;
        border-radius:50%;
    }
</style>
<div class="hero-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php
        if (!Yii::$app->user->isGuest){
            echo Html::a('Create Games', ['create'], ['class' => 'btn btn-success']);
        }
    ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn',
            'visibleButtons' => [
                'update' => function ($model) {
                    return !Yii::$app->user->isGuest;
                },
                'delete' => function ($model) {
                    return !Yii::$app->user->isGuest;
                },
            ]],
            //'id',
            [
                'label' => 'images',    
                'format' => 'html',    
                'label' => 'Hero Image',    
                'value' => function ($data) {    
                    return Html::img($data['images'],    
                        ['class' => 'crop-images']);    
                },    
            ],
            'heroname',
            [   
                'attribute' => 'durability',
                'label' => 'durability',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<div class="progress">
                                <div class="progress-bar  progress-bar-warning" role="progressbar" aria-valuenow="'.$model->durability.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$model->durability.'%;">
                                    <span class="sr-only"></span>
                                </div>
                            </div>';
                }
            ],
            [
                'attribute' => 'offense',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<div class="progress">
                                <div class="progress-bar  progress-bar-danger" role="progressbar" aria-valuenow="'.$model->offense.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$model->offense.'%;">
                                    <span class="sr-only"></span>
                                </div>
                            </div>';
                }
            ],
            [
                'attribute' => 'abilityeffect',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="'.$model->abilityeffect.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$model->abilityeffect.'%;">
                                    <span class="sr-only"></span>
                                </div>
                            </div>';
                }
            ],
            [
                'attribute' => 'difficulty',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<div class="progress">
                                <div class="progress-bar  progress-bar-success" role="progressbar" aria-valuenow="'.$model->difficulty.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$model->difficulty.'%;">
                                    <span class="sr-only"></span>
                                </div>
                            </div>';
                }
            ]
        ],
    ]); ?>

    <?php Pjax::end(); ?>
    <?php
        // foreach($json->data as $value){
        //     echo $value->name;
        // }
    ?>
</div>
