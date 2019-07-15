<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\GamesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Next Games';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="games-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?php
            if (!Yii::$app->user->isGuest){
                echo Html::a('Create New Games', ['/games/create'], ['class' => 'btn btn-success']);
            }
        ?>
    </p>
    
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php    
            //print_r($dataProvider);
            foreach($model as $values){
                $datecreate = date_create($values->gamedate);
                ///print_r($datecreate);
                
                echo '<div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="'.$values->id.'">
                    <h4 class="panel-title">
                        <ul class="list-group">                        
                            <li class="list-group-item">Game id : <a class="label label-primary" role="button" data-toggle="collapse" data-parent="#accordion" href="#'.$values->gamename.'" aria-expanded="true" aria-controls="'.$values->gamename.'">
                            '.$values->gamename.'
                            </a></li>
                            <li class="list-group-item">Game number : '.$values->id.'</li>
                            <li class="list-group-item">Game Date : '.date_format($datecreate, 'd-m-Y H:i:s').'</li>
                        </ul>
                        
                        <br>
                        
                    </h4>
                    </div>
                    <div id="'.$values->gamename.'" class="panel-collapse expand" role="tabpanel" aria-labelledby="'.$values->id.'">
                    <div class="panel-body">
                        <div class="col-md-6">
                            <h5>Team A</h5>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:20%;text-align:center;vertical-align:middle;">Player</th>
                                        <th style="width:4%;text-align:center;vertical-align:middle;">Kill</th>
                                        <th style="width:4%;text-align:center;vertical-align:middle;">Death</th>
                                        <th style="width:4%;text-align:center;vertical-align:middle;">Assist</th>                              
                                        <th style="width:4%;text-align:center;vertical-align:middle;">Rating</th></tr>
                                </thead>
                                <tbody>';
                                    foreach($values->gamedetails as $player){
                                        if($player->team == "A"){
                                            echo '<tr>
                                            <td><a href="'.Yii::$app->request->baseUrl.'/player/view?id='.$player->player->id.'">'.$player->player->name.' ('.$player->player->nickname.')</a></td>
                                            <td style="text-align:right;">0</td>
                                            <td style="text-align:right;">0</td>
                                            <td style="text-align:right;">0</td>
                                            <td style="text-align:right;">0</td>
                                        </tr>';
                                        }
                                    }

                                echo '</tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Team B</h5>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:20%;text-align:center;vertical-align:middle;">Player</th>
                                        <th style="width:4%;text-align:center;vertical-align:middle;">Kills</th>
                                        <th style="width:4%;text-align:center;vertical-align:middle;">Deaths</th>
                                        <th style="width:4%;text-align:center;vertical-align:middle;">Assists</th>                              
                                        <th style="width:4%;text-align:center;vertical-align:middle;">Rating</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                foreach($values->gamedetails as $player){
                                    if($player->team == "B"){
                                        echo '<tr>
                                        <td><a href="'.Yii::$app->request->baseUrl.'/player/view?id='.$player->player->id.'">'.$player->player->name.' ('.$player->player->nickname.')</a></td>
                                        <td style="text-align:right;">0</td>
                                        <td style="text-align:right;">0</td>
                                        <td style="text-align:right;">0</td>
                                        <td style="text-align:right;">0</td>
                                    </tr>';
                                    }
                                }

                                echo '</tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>'; 
                echo '</br><hr>'; 
                //print_r($value->gamedetails);
            }
        ?>
    
    </div>
</div>
