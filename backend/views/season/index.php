<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SeasonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Seasons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="season-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php
        if (!Yii::$app->user->isGuest){
            echo Html::a('Create Season', ['create'], ['class' => 'btn btn-success']);
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
                'view' => function ($model) {
                    return "";
                },
            ]],
            'league',
            'seasonname',
            'tglmulai',
            'tglselesai',
            'jumlahpeserta',
            'status',

            
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
