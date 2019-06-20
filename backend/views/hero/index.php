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
<div class="hero-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Hero', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [

                'attribute' => 'images',    
                'format' => 'html',    
                'label' => 'Hero Image',    
                'value' => function ($data) {    
                    return Html::img($data['images'],    
                        ['width' => '120px']);    
                },    
            ],
            'heroname',
            'durability',
            'offense',
            'abilityeffect',
            'difficulty',
            //'images',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
    <?php
        // foreach($json->data as $value){
        //     echo $value->name;
        // }
    ?>
</div>
