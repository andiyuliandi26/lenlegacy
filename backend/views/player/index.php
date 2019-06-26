<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PlayerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Players';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="player-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php
        if (!Yii::$app->user->isGuest){
            echo Html::a('Create Player', ['create'], ['class' => 'btn btn-success']);
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
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<a href='.Yii::$app->request->baseUrl.'/player/view?id='.$model->id.'"">'.$model->name.'</a>';
                }
            ],
            'nickname',
            'gameid',
            'nohp',
            'tiername',
            //'status',
            //'image',
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
