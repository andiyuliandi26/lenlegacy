<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model backend\models\Player */

$this->title = "Player Detail";
$this->params['breadcrumbs'][] = ['label' => 'Players', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
    <?php
        //print_r($model->gamedetails);]
        $getData = (array) $model->gamedetails;
        //print_r($games);
        $totalKill = 0;
        $totalAssist = 0;
        foreach($model->gamedetails as $value){
            $totalKill = $totalKill + $value->kill;
            $totalAssist = $totalAssist + $value->assist;
            //print_r($value->kill);
        }

        //echo $totalKill;
        $rank = 1;
        $currentRank = 40;
        foreach($standing as $value){
            if($value['playerid'] == $model->id){
                //echo 'Current Rank : '.$rank; 
                $currentRank = $rank;
            }
            $rank++;
        }
    ?>              
<div class="player-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="panel panel-default">
        <div class="panel-heading">Basic Info</div>
            <div class="panel-body">
                <div class=col-md-3>
                    <table id="w0" class="table table-striped table-bordered detail-view">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td><?= $model->name ?></td>
                            </tr>
                            <tr>
                                <th>Nickname</th>
                                <td><?= $model->nickname ?></td>
                            </tr>
                            <tr>
                                <th>No Handphone</th>
                                <td><?= $model->nohp ?></td>
                            </tr>
                            <tr>
                                <th>Tier Name</th>
                                <td><?= $model->tier->tiername ?></td>
                            </tr>
                            <tr>
                                <th>Current Rank</th>
                                <td><?= $currentRank ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class=col-md-9>
                
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width:7%;text-align:center;vertical-align:middle;">Hero</th>
                            <th style="width:7%;text-align:center;vertical-align:middle;">Play</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;">Kill</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;">Death</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;">Assist</th>                              
                            <th style="width:4%;text-align:center;vertical-align:middle;">AVG Rating</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;">Win</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;">Lose</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            
                            foreach($games as $value){
                                if($no == 1){
                                    $banned = 'style="background-color:red;color:white;"';
                                }else{
                                    $banned = "";
                                }
                                $heroname = $value->heroid != null ? $value->hero->heroname : "";
                                echo '<tr '.$banned.'>
                                    <td style="text-align:center;">'.$heroname.'</td>
                                    <td style="text-align:center;">'.$value->herodamage.'</td>
                                    <td style="text-align:center;">'.$value->kill.'</td>
                                    <td style="text-align:center;">'.$value->death.'</td>
                                    <td style="text-align:center;">'.$value->assist.'</td>
                                    <td style="text-align:center;">'.$value->rating.'</td>
                                    <td style="text-align:center;">'.$value->isvictory.'</td>                                  
                                    <td style="text-align:center;">'.$value->ismvplose.'</td>
                                </tr>';
        
                                $no++;                                
                            }
                        ?>
                    </tbody>
                </table>
                </div>      
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">Game Info</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width:2%;text-align:center;vertical-align:middle;" rowspan="2">No</th>
                            <th style="width:7%;text-align:center;vertical-align:middle;" rowspan="2">Season</th>
                            <th style="width:5%;text-align:center;vertical-align:middle;" rowspan="2">Game ID</th>
                            <th style="width:7%;text-align:center;vertical-align:middle;" rowspan="2">Game Date</th>
                            <th style="width:7%;text-align:center;vertical-align:middle;" rowspan="2">Game Status</th>
                            <th style="width:7%;text-align:center;vertical-align:middle;" rowspan="2">Hero</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Kill</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Death</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Assist</th>                              
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Rating</th> 
                            <!-- <th style="width:4%;text-align:center;vertical-align:middle;" colspan="6">Total Damage</th>                             -->
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Medal</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;" rowspan="2">Victory</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;" colspan="2">MVP</th>
                        </tr>
                        <tr>
                            <!-- <th style="width:4%;text-align:center;vertical-align:middle;">Hero</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;">% Hero</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;">Turret</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;">% Turret</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;">Taken</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;">% Taken</th> -->
                            <th style="width:2%;text-align:center;vertical-align:middle;">Winning</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;">Lose</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            foreach($model->gamedetails as $value){
                                $heroname = $value->heroid != null ? $value->hero->heroname : "";
                                    echo '<tr>
                                        <td style="text-align:center;">'.$no.'</td>
                                        <td style="text-align:center;">'.$value->game->season->seasonname.'</td>
                                        <td><a href="'.Yii::$app->request->baseUrl.'/games/view?id='.$value->game->id.'">'.$value->game->gamename.'</a></td>
                                        <td style="text-align:center;">'.$value->game->gamedate.'</td>
                                        <td style="text-align:center;">'.$value->game->status.'</td>
                                        <td style="text-align:center;">'.$heroname.'</td>
                                        <td style="text-align:center;">'.$value->kill.'</td>
                                        <td style="text-align:center;">'.$value->death.'</td>
                                        <td style="text-align:center;">'.$value->assist.'</td>
                                        <td style="text-align:center;">'.$value->rating.'</td>
                                        <td style="text-align:center;">'.$value->medal.'</td>                                    
                                        <td style="text-align:center;">'.$value->isvictory.'</td>
                                        <td style="text-align:center;">'.$value->ismvpwinning.'</td>
                                        <td style="text-align:center;">'.$value->ismvplose.'</td>
                                    </tr>';
            
                                    $no++;                                
                            }
                        ?>
                    </tbody>
                </table>
        </div>
    </div>
    
    
</div>
