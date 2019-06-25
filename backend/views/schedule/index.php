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
        <?= Html::a('Create New Games', ['/games/create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php
            //print_r($dataProvider);
            foreach($model as $values){
                echo '<div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="'.$values->id.'">
                    <h4 class="panel-title">
                        <ul class="list-group">                        
                            <li class="list-group-item">Game id : <a class="label label-primary" role="button" data-toggle="collapse" data-parent="#accordion" href="#'.$values->gamename.'" aria-expanded="true" aria-controls="'.$values->gamename.'">
                            '.$values->gamename.'
                            </a></li>
                            <li class="list-group-item">Game number : '.$values->id.'</li>
                            <li class="list-group-item">Game Date : '.$values->gamedate.'</li>
                        </ul>
                        
                        <br>
                        
                    </h4>
                    </div>
                    <div id="'.$values->gamename.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="'.$values->id.'">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <h5>Team A</h5>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:10%;text-align:center;vertical-align:middle;" rowspan="2">Player</th>
                                        <th style="width:10%;text-align:center;vertical-align:middle;" rowspan="2">Hero</th>
                                        <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Kills</th>
                                        <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Deaths</th>
                                        <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Assists</th>                              
                                        <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Rating</th>
                                        <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Medal</th>
                                        <th style="width:2%;text-align:center;vertical-align:middle;" rowspan="2">Victory</th>
                                        <th style="width:2%;text-align:center;vertical-align:middle;" colspan="2">MVP</th>
                                    </tr>
                                    <tr>
                                        <th style="width:2%;text-align:center;vertical-align:middle;">Winning</th>
                                        <th style="width:2%;text-align:center;vertical-align:middle;">Lose</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                    foreach($values->gamedetails as $player){
                                        if($player->team == "A"){
                                            echo '<tr>
                                            <td>'.$player->player->playerfullname.'</td>
                                            <td></td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td></td>
                                            <td><input class="form-control isvictory" type="checkbox" value="1" name="isvictory" disabled></td>
                                            <td><input class="form-control ismvpwinning" type="checkbox" value="1" name="ismvpwinning" disabled></td>
                                            <td><input class="form-control ismvplose" type="checkbox" value="1" name="ismvplose" disabled></td>
                                        </tr>';
                                        }
                                    }

                                echo '</tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <h5>Team B</h5>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:10%;text-align:center;vertical-align:middle;" rowspan="2">Player</th>
                                        <th style="width:10%;text-align:center;vertical-align:middle;" rowspan="2">Hero</th>
                                        <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Kills</th>
                                        <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Deaths</th>
                                        <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Assists</th>                              
                                        <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Rating</th> 
                                        <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Medal</th>
                                        <th style="width:2%;text-align:center;vertical-align:middle;" rowspan="2">Victory</th>
                                        <th style="width:2%;text-align:center;vertical-align:middle;" colspan="2">MVP</th>
                                    </tr>
                                    <tr>
                                        <th style="width:2%;text-align:center;vertical-align:middle;">Winning</th>
                                        <th style="width:2%;text-align:center;vertical-align:middle;">Lose</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                foreach($values->gamedetails as $player){
                                    if($player->team == "B"){
                                        echo '<tr>
                                        <td>'.$player->player->playerfullname.'</td>
                                        <td></td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td></td>
                                        <td><input class="form-control isvictory" type="checkbox" value="1" name="isvictory" disabled></td>
                                        <td><input class="form-control ismvpwinning" type="checkbox" value="1" name="ismvpwinning" disabled></td>
                                        <td><input class="form-control ismvplose" type="checkbox" value="1" name="ismvplose" disabled></td>
                                    </tr>';
                                    }
                                }

                                echo '</tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>';  
                //print_r($value->gamedetails);
            }
        ?>
    
    </div>
</div>
