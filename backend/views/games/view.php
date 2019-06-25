<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Games */

$this->title = $model->gamename;
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="games-view">
    <div class="panel panel-primary">
        <div class="panel-heading">Overview</div>
            <div class="panel-body">
                <div class=col-md-3>
                <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [                            
                            'season.seasonname',
                            'gamename',
                            'gamedate',
                            'status',
                        ],
                    ]) ?>
                </div>
                    
        </div>
    </div>
    <div class="panel panel-danger">
        <div class="panel-heading">Game Details</div>
            <div class="panel-body">
            <div class="col-md-12">
                <h4>Team A</h4>
                 <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width:10%;text-align:center;vertical-align:middle;" rowspan="2">Player</th>
                            <th style="width:7%;text-align:center;vertical-align:middle;" rowspan="2">Hero</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Kills</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Deaths</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Assists</th>                              
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Rating</th>
                            <th style="width:7%;text-align:center;vertical-align:middle;" rowspan="2">Medal</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;" rowspan="2">Victory</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;" colspan="2">MVP</th>
                        </tr>
                        <tr>
                            <th style="width:2%;text-align:center;vertical-align:middle;">Winning</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;">Lose</th>
                        </tr>
                    </thead>
                    <tbody id="tableTeamA">
                        <?php
							if(count($model->gamedetails) > 0){
								for($i = 0; $i < count($model->gamedetails); $i++){
                                    $getPlayer = $model->gamedetails[$i];
                                    		
									$isvictory = $getPlayer->isvictory ? "checked" : "";
									$ismvpwinning = $getPlayer->ismvpwinning ? "checked" : "";
                                    $ismvplose = $getPlayer->ismvplose ? "checked" : "";
                                    $heroname = $getPlayer->hero != null ? $getPlayer->hero->heroname : "";
									if($getPlayer->team == "A"){
                                        echo '<tr>
                                            <td><a href="'.Yii::$app->request->baseUrl.'/player/view?id='.$getPlayer->playerid.'">'.$getPlayer->player->playerfullname.'</a></td>
                                            <td>'.$heroname.'</td>
                                            <td>'.$getPlayer->kill.'</td>
                                            <td>'.$getPlayer->death.'</td>
                                            <td>'.$getPlayer->assist.'</td>
                                            <td>'.$getPlayer->rating.'</td>
                                            <td>'.$getPlayer->medal.'</td>
                                            <td><input class="form-control isvictory" type="checkbox" value="1" name="isvictory"  disabled '.$isvictory.'></td>
                                            <td><input class="form-control ismvpwinning" type="checkbox" value="1" name="ismvpwinning" disabled '.$ismvpwinning.'></td>
                                            <td><input class="form-control ismvplose" type="checkbox" value="1" name="ismvplose" disabled '.$ismvplose.'></td>
                                        </tr>';
                                    }
                                }
							}
						?>
                    </tbody>
                </table>          
            </div>
        <div class="col-md-12">
                <h4>Team B</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width:10%;text-align:center;vertical-align:middle;" rowspan="2">Player</th>
                            <th style="width:7%;text-align:center;vertical-align:middle;" rowspan="2">Hero</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Kills</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Deaths</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Assists</th>                              
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Rating</th> 
                            <th style="width:7%;text-align:center;vertical-align:middle;" rowspan="2">Medal</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;" rowspan="2">Victory</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;" colspan="2">MVP</th>
                        </tr>
                        <tr>
                            <th style="width:2%;text-align:center;vertical-align:middle;">Winning</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;">Lose</th>
                        </tr>
                    </thead>
                    <tbody id="tableTeamB">
                        <?php
							//print_r($model->gamedetails);
							if(count($model->gamedetails) > 0){
								for($i = 0; $i < count($model->gamedetails); $i++){
									$getPlayer = $model->gamedetails[$i];

									$isvictory = $getPlayer->isvictory ? "checked" : "";
									$ismvpwinning = $getPlayer->ismvpwinning ? "checked" : "";
                                    $ismvplose = $getPlayer->ismvplose ? "checked" : "";
                                    $heroname = $getPlayer->hero != null ? $getPlayer->hero->heroname : "";
									if($getPlayer->team == "B"){
                                            echo '<tr>
                                            <td><a href="'.Yii::$app->request->baseUrl.'/player/view?id='.$getPlayer->playerid.'">'.$getPlayer->player->playerfullname.'</a></td>
                                            <td>'.$heroname.'</td>
                                            <td>'.$getPlayer->kill.'</td>
                                            <td>'.$getPlayer->death.'</td>
                                            <td>'.$getPlayer->assist.'</td>
                                            <td>'.$getPlayer->rating.'</td>
                                            <td>'.$getPlayer->medal.'</td>
                                            <td><input class="form-control isvictory" type="checkbox" value="1" name="isvictory" disabled '.$isvictory.'></td>
                                            <td><input class="form-control ismvpwinning" type="checkbox" value="1" name="ismvpwinning" disabled '.$ismvpwinning.'></td>
                                            <td><input class="form-control ismvplose" type="checkbox" value="1" name="ismvplose" disabled '.$ismvplose.'></td>
                                        </tr>';
								    }
								}
							}
						?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
