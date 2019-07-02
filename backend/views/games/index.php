<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\GamesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Games Result';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="games-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php
        if (!Yii::$app->user->isGuest){
            echo Html::a('Create Games', ['create'], ['class' => 'btn btn-success']);
        }
    ?>
    </p>

    <?php 
    Pjax::begin(); ?>
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
                    return "";
                },
                'view' => function ($model) {
                    return "";
                },
            ]],            
            'season.seasonname',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<a href='.Yii::$app->request->baseUrl.'/games/view?id='.$model->id.'"">'.$model->gamename.'</a>';
                }
            ],
            'gamedate',
            'status',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model) {
                    $timA = "";
                    $timB = "";

                    foreach($model->gamedetails as $value){
                        $playername = $value->player->name;
                        if($value->isadditional){
                            $playername = $value->player->name.' (Additional)';
                        }
                        if($value->team == 'A'){

                            $timA .= $playername.', ';
                        }else{
                            $timB .= $playername.', ';
                        }
                    }

                    return 'Team A : '.$timA.'<br>Team B : '.$timB;
                }
            ],

        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
