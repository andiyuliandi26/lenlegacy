<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Season;
use yii\helpers\ArrayHelper;
use backend\models\GameDetails;
use backend\models\Player;
use backend\models\Hero;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use kartik\widgets\DatePicker;
use kartik\widgets\TimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Games */
/* @var $form yii\widgets\ActiveForm */
?>
<script>
    $(document).ready(function(){
        $('#btnAddplayer').click(function(){
            var team = $('#gamedetails-team').val();
            var playerid = $('#gamedetails-playerid').val();
            var playername = $('#gamedetails-playerid option:selected').text();
            var heroid = $('#gamedetails-heroid').val();
            var heroname = $('#gamedetails-heroid option:selected').text();
            var kill = $('#gamedetails-kill').val();
            var death = $('#gamedetails-death').val();
            var assist = $('#gamedetails-assist').val();
            var rating = $('#gamedetails-rating').val();
            var herodamage = $('#gamedetails-herodamage').val();
            var herodamagepersentage = $('#gamedetails-herodamagepersentage').val();
            var turretdamage = $('#gamedetails-turretdamage').val();
            var turretdamagepersentage = $('#gamedetails-turretdamagepersentage').val();
            var damagetaken = $('#gamedetails-damagetaken').val();
            var damagetakenpersentage = $('#gamedetails-damagetakenpersentage').val();
            var gold = $('#gamedetails-gold').val();
            var medal = $('#gamedetails-medal').val();

            var isvictory = $('#gamedetails-isvictory').is(':checked') ? 1 : 0;
            var ismvpwinning = $('#gamedetails-ismvpwinning').is(':checked') ? 1 : 0;
            var ismvplose = $('#gamedetails-ismvplose').is(':checked') ? 1 : 0;

            $('#tableTeam'+ $('#gamedetails-team').val()).append('<tr>'+
                '<td><input class="form-control" type="hidden" value="'+ team + '" name="team" class="team">'+ team + '</td>'+
                '<td><input class="form-control" type="hidden" value="'+ playerid + '" name="playerid" class="playerid">'+ playername + '</td>'+
                '<td><input class="form-control" type="hidden" value="'+ heroid + '" name="heroid" class="heroid">'+ heroname + '</td>'+
                '<td><input class="form-control" type="text" value="'+ kill + '" name="kill" class="kill">'+ kill + '</td>'+
                '<td><input class="form-control" type="text" value="'+ death + '" name="death" class="death">'+ death + '</td>'+
                '<td><input class="form-control" type="text" value="'+ assist + '" name="assist" class="assist">'+ assist + '</td>'+
                '<td><input class="form-control" type="text" value="'+ rating + '" name="rating" class="rating">'+ rating + '</td>'+
                '<td><input class="form-control" type="text" value="'+ herodamage + '" name="herodamage" class="herodamage">'+ herodamage + '</td>'+
                '<td><input class="form-control" type="text" value="'+ herodamagepersentage + '" name="herodamagepersentage" class="herodamagepersentage">'+ herodamagepersentage + '</td>'+
                '<td><input class="form-control" type="text" value="'+ turretdamage + '" name="turretdamage" class="turretdamage">'+ turretdamage + '</td>'+
                '<td><input class="form-control" type="text" value="'+ turretdamagepersentage + '" name="turretdamagepersentage" class="turretdamagepersentage">'+ turretdamagepersentage + '</td>'+
                '<td><input class="form-control" type="text" value="'+ damagetaken + '" name="damagetaken" class="damagetaken">'+ damagetaken + '</td>'+
                '<td><input class="form-control" type="text" value="'+ damagetakenpersentage + '" name="damagetakenpersentage" class="damagetakenpersentage">'+ damagetakenpersentage + '</td>'+
                '<td><input class="form-control" type="text" value="'+ gold + '" name="gold" class="gold">'+ gold + '</td>'+
                '<td><input class="form-control" type="text" value="'+ medal + '" name="medal" class="medal">'+ medal + '</td>'+
                '<td><input class="form-control" type="text" value="'+ isvictory + '" name="isvictory" class="isvictory">'+ isvictory + '</td>'+
                '<td><input class="form-control" type="text" value="'+ ismvpwinning + '" name="ismvpwinning" class="ismvpwinning">'+ ismvpwinning + '</td>'+
                '<td><input class="form-control" type="text" value="'+ ismvplose + '" name="ismvplose" class="ismvpwinning">'+ ismvplose + '</td>'+
                '</tr>');
            });

        $('#btnSave').click(function(){
            var seasonid = $('#games-seasonid').val();
            var gamename = $('#games-gamename').val();
            var gameduration = $('#games-gameduration').val();
            var gamedate = $('#gamedate').val() + ' ' + $('#gametime').val();
            var gamedetails = [];
            var countPlayer = $('.team').length;
            if(countPlayer > 0){
                for(var i = 0; i < countPlayer; i++){
                    playerdetail = {
                        team: $('input[name=team]:eq('+ i +')').val(),
                        playerid: $('input[name=playerid]:eq('+ i +')').val(),
                        heroid: $('input[name=heroid]:eq('+ i +')').val(),
                        kill: $('input[name=kill]:eq('+ i +')').val(),
                        death: $('input[name=death]:eq('+ i +')').val(),
                        assist: $('input[name=assist]:eq('+ i +')').val(),
                        rating: $('input[name=rating]:eq('+ i +')').val(),
                        herodamage: $('input[name=herodamage]:eq('+ i +')').val(),
                        herodamagepersentage: $('input[name=herodamagepersentage]:eq('+ i +')').val(),
                        turretdamage: $('input[name=turretdamage]:eq('+ i +')').val(),
                        turretdamagepersentage: $('input[name=turretdamagepersentage]:eq('+ i +')').val(),
                        damagetaken: $('input[name=damagetaken]:eq('+ i +')').val(),
                        damagetakenpersentage: $('input[name=damagetakenpersentage]:eq('+ i +')').val(),
                        gold: $('input[name=gold]:eq('+ i +')').val(),
                        medal: $('input[name=medal]:eq('+ i +')').val(),
                        isvictory: $('input[name=isvictory]:eq('+ i +')').val(),
                        ismvpwinning: $('input[name=ismvpwinning]:eq('+ i +')').val(),
                        ismvplose: $('input[name=ismvplose]:eq('+ i +')').val(),
                    };

                    gamedetails.push(playerdetail);
                }
            }
            var games = {
                seasonid: seasonid,
                gamename: gamename,
                gamedate: gamedate,
                gameduration: gameduration,
                gamedetails: gamedetails,
            };

            console.log(games);
            $.ajax({
                url : '<?php echo Yii::$app->request->baseUrl.'/games/savegames' ?>',
                type : 'post',
                data : {
                    games: games
                },
                success: function (result){
                    console.log(result.data);
                }
    	    });
        });
    });
</script>
<div class="games-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-primary">
        <div class="panel-heading">Games</div>
        <div class="panel-body">
            <div class="col-md-2">
                <?php
                    $season=Season::find()->all();
                    $listData=ArrayHelper::map($season,'id','seasonname');
                ?>
                <?= $form->field($model, 'seasonid')->dropDownList($listData,['prompt'=>'Silahkan pilih...']); ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'gamename')->textInput(['maxlength' => true]) ?>
                
            </div>
            <div class="col-md-3 form-group">
                <div class="col-md-12">
                <label>Game Date</label></div>
                <div class="col-md-6">
                
                    <?= DatePicker::widget([
                        'name' => 'gamedate',
                        'id' => 'gamedate',
                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                        'value' => date("Y-m-d"),
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd',
                            'language' =>'id',
                            'minViewMode'=>0,
                            'endDate'=>'+0y',
                        ]
                    ]); ?>
                </div>
                <div class="col-md-6">
                    <?= TimePicker::widget([
                        'id' => 'gametime',
                        'name' => 'gametime', 
                        'pluginOptions' => [
                            'minuteStep' => 1,
                            'showSeconds' => true,
                            'showMeridian' => false
                        ]
                    ]); ?>
                </div>
                
                
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'gameduration')->textInput() ?>
            </div>
        </div>
    </div>

    <div class="panel panel-danger">
        <div class="panel-heading">Add player</div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="form-group">
                    <?php
                        $player=Player::find()->all();
                        $listDataPlayer=ArrayHelper::map($player,'id','name'); 
                        $hero=Hero::find()->all();
                        $listDataHero=ArrayHelper::map($hero,'id','heroname');
                    ?>                    
                    <div class="col-md-1">
                        <?= $form->field($models, 'team')->dropDownList(['A'=> 'A' ,'B' => 'B'],['prompt'=>'Silahkan pilih...']); ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($models, 'playerid')->dropDownList($listDataPlayer,['prompt'=>'Silahkan pilih...']); ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($models, 'heroid')->dropDownList($listDataHero,['prompt'=>'Silahkan pilih...']); ?>
                    </div>
                    <div class="col-md-1">
                        <?= $form->field($models, 'kill')->textInput(); ?>
                    </div>
                    <div class="col-md-1">
                        <?= $form->field($models, 'death')->textInput(); ?>
                    </div>
                    <div class="col-md-1">
                        <?= $form->field($models, 'assist')->textInput(); ?>
                    </div>
                    <div class="col-md-1">
                        <?= $form->field($models, 'rating')->textInput(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-md-1">
                        <?= $form->field($models, 'herodamage')->textInput(); ?>
                    </div>
                    <div class="col-md-1">
                        <?= $form->field($models, 'herodamagepersentage')->textInput(); ?>
                    </div>
                    <div class="col-md-1">
                        <?= $form->field($models, 'turretdamage')->textInput(); ?>
                    </div>
                    <div class="col-md-1">
                        <?= $form->field($models, 'turretdamagepersentage')->textInput(); ?>
                    </div>
                    <div class="col-md-1">
                        <?= $form->field($models, 'damagetaken')->textInput(); ?>
                    </div>
                    <div class="col-md-1">
                        <?= $form->field($models, 'damagetakenpersentage')->textInput(); ?>
                    </div>
                    <div class="col-md-1">
                        <?= $form->field($models, 'gold')->textInput(); ?>
                    </div>
                    <div class="col-md-1">
                        <?= $form->field($models, 'medal')->dropDownList(['AFK'=>'AFK','Bronze'=>'Bronze','Silver'=>'Silver','Gold'=>'Gold'],['prompt'=>'Silahkan pilih...']); ?>
                    </div>
                    <div class="col-md-1">
                        <?= $form->field($models, 'isvictory')->checkbox(); ?>
                    </div>
                    <div class="col-md-1">
                        <?= $form->field($models, 'ismvpwinning')->checkbox(); ?>
                    </div>
                    <div class="col-md-1">
                        <?= $form->field($models, 'ismvplose')->checkbox(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::Button('Add', ['class' => 'btn btn-success', 'id'=>'btnAddplayer']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Player Detail</div>
        <div class="panel-body">
            <div class="col-md-12">
                <h4>Team A</h4>
                <?php 
                    $gamedetails = GameDetails::find();
                    $gamedetailsProvider = new ActiveDataProvider([
                        'query' => $gamedetails,
                    ]);
                ?>
                 <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width:2%;text-align:center;vertical-align:middle;" rowspan="2">Team</th>
                            <th style="width:10%;text-align:center;vertical-align:middle;" rowspan="2">Player</th>
                            <th style="width:10%;text-align:center;vertical-align:middle;" rowspan="2">Hero</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Kills</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Deaths</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Assists</th>                              
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Rating</th> 
                            <th style="width:4%;text-align:center;vertical-align:middle;" colspan="6">Total Damage</th>                            
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Golds</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Medal</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;" rowspan="2">Victory</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;" colspan="2">MVP</th>
                        </tr>
                        <tr>
                            <th style="width:4%;text-align:center;vertical-align:middle;">Hero</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;">% Hero</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;">Turret</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;">% Turret</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;">Taken</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;">% Taken</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;">Winning</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;">Lose</th>
                        </tr>
                    </thead>
                    <tbody id="tableTeamA">
                        
                    </tbody>
                </table>          
        </div>
        <div class="col-md-12">
                <h4>Team B</h4>
                <?php 
                    $gamedetails = GameDetails::find();
                    $gamedetailsProvider = new ActiveDataProvider([
                        'query' => $gamedetails,
                    ]);
                ?>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width:2%;text-align:center;vertical-align:middle;" rowspan="2">Team</th>
                            <th style="width:10%;text-align:center;vertical-align:middle;" rowspan="2">Player</th>
                            <th style="width:10%;text-align:center;vertical-align:middle;" rowspan="2">Hero</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Kills</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Deaths</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Assists</th>                              
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Rating</th> 
                            <th style="width:4%;text-align:center;vertical-align:middle;" colspan="6">Total Damage</th>                            
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Golds</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Medal</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;" rowspan="2">Victory</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;" colspan="2">MVP</th>
                        </tr>
                        <tr>
                            <th style="width:4%;text-align:center;vertical-align:middle;">Hero</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;">% Hero</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;">Turret</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;">% Turret</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;">Taken</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;">% Taken</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;">Winning</th>
                            <th style="width:2%;text-align:center;vertical-align:middle;">Lose</th>
                        </tr>
                    </thead>
                    <tbody id="tableTeamB">
                        
                    </tbody>
                </table>
            </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <?= Html::Button('Save', ['class' => 'btn btn-success', 'id'=>'btnSave']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
