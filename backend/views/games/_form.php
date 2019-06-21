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
use yii\jui\AutoComplete;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\Games */
/* @var $form yii\widgets\ActiveForm */
?>
<script>
    $(document).ready(function(){
        $('#btnAddplayer').click(function(){
            var team = $('#gamedetails-team').val();
            var playerid = $('#gamedetails-playerid').val();
            var playername = $('#gamedetails-player').val();
            var heroid = $('#gamedetails-heroid').val();
            var heroname = $('#gamedetails-hero').val();
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

            $('#tableTeam'+ team).append('<tr>'+
                '<td><input class="form-control" type="hidden" value="'+ team + '" name="team">'+
					'<input class="form-control" type="hidden" value="'+ playerid + '" name="playerid">'+ playername + '</td>'+
                '<td><input class="form-control" type="hidden" value="'+ heroid + '" name="heroid"">'+ heroname + '</td>'+
                '<td><input class="form-control" type="text" value="" name="kill"></td>'+
                '<td><input class="form-control" type="text" value="" name="death"></td>'+
                '<td><input class="form-control" type="text" value="" name="assist"></td>'+
                '<td><input class="form-control" type="text" value="" name="rating"></td>'+
                '<td><input class="form-control" type="text" value="" name="herodamage"></td>'+
                '<td><input class="form-control" type="text" value="" name="herodamagepersentage"></td>'+
                '<td><input class="form-control" type="text" value="" name="turretdamage"></td>'+
                '<td><input class="form-control" type="text" value="" name="turretdamagepersentage"></td>'+
                '<td><input class="form-control" type="text" value="" name="damagetaken"></td>'+
                '<td><input class="form-control" type="text" value="" name="damagetakenpersentage"></td>'+
                '<td><input class="form-control" type="text" value="" name="gold"></td>'+
                '<td>'+
				'<select class="form-control medal" name="medal">'+
					'<option value=""></option>'+
					'<option value="AFK">AFK</option>'+
					'<option value="Bronze">Bronze</option>'+
					'<option value="Silver">Silver</option>'+
					'<option value="Gold">Gold</option>'+
					'</select>'+
				'</td>'+
                '<td><input class="form-control isvictory" type="checkbox" value="1" name="isvictory"></td>'+
                '<td><input class="form-control ismvpwinning" type="checkbox" value="1" name="ismvpwinning"></td>'+
                '<td><input class="form-control ismvplose" type="checkbox" value="1" name="ismvplose"></td>'+
            '</tr>');

			clearform();
        });

        $('#btnSave').click(function(){
            var seasonid = $('#games-seasonid').val();
            var gamename = $('#games-gamename').val();
            var gameduration = $('#games-gameduration').val();
            var gamedate = $('#gamedate').val() + ' ' + $('#gametime').val();
            var gamedetails = [];
            var countPlayer = $('input[name=team]').length;
			var medal = $('.medal').length;
				console.log(medal);
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
                        medal: $('.medal:eq('+ i +')').val(),
                        isvictory: $('.isvictory:eq('+ i +')').is(':checked') ? 1 : 0,
                        ismvpwinning: $('.ismvpwinning:eq('+ i +')').is(':checked') ? 1 : 0,
                        ismvplose: $('.ismvplose:eq('+ i +')').is(':checked') ? 1 : 0,
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

	function clearform(){
		$('#gamedetails-team').val('');
        $('#gamedetails-playerid').val('');
        $('#gamedetails-player').val('');
        $('#gamedetails-heroid').val('');
        $('#gamedetails-hero').val('');
	}
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
            <div class="col-md-5 form-group">
                <div class="col-md-12">
                <label>Game Date</label></div>
                <div class="col-md-8">                
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
                <div class="col-md-4">
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
            <div class="col-md-1">
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
                        //$player=Player::find()->all();
                        //$listDataPlayer=ArrayHelper::map($player,'id','name'); 
                        //$hero=Hero::find()->all();
                        //$listDataHero=ArrayHelper::map($hero,'id','heroname');
						$player = Player::find()
							->select(['CONCAT(name," (",nickname,")") as value', 'CONCAT(name," (",nickname,")") as label','id as id'])
							->asArray()
							->all();
						$hero = Hero::find()
						->select(['heroname as value', 'heroname as label','id as id'])
						->asArray()
						->all();
                    ?>                    
                    <div class="col-md-2">
                        <?= $form->field($models, 'team')->dropDownList(['A'=> 'A' ,'B' => 'B'],['prompt'=>'Silahkan pilih...']); ?>
                    </div>
                    <div class="col-md-4">
						<?= $form->field($models, 'player')->widget(\yii\jui\AutoComplete::classname(), [
							'clientOptions' => [
								'source' => $player,
								'minLength'=>'0', 
								'select' => new JsExpression("function( event, ui ) {
									$('#gamedetails-playerid').val(ui.item.id);
								 }")
							],
							'options'=>[
								'class'=>'form-control',
							]
						]) ?>
                        <input type="hidden" id="gamedetails-playerid"/>
                    </div>
                    <div class="col-md-3">
						<?= $form->field($models, 'hero')->widget(\yii\jui\AutoComplete::classname(), [
							'clientOptions' => [
								'source' => $hero,
								'minLength'=>'0', 
								'select' => new JsExpression("function( event, ui ) {
									$('#gamedetails-heroid').val(ui.item.id);
								 }")
							],
							'options'=>[
								'class'=>'form-control',
							]
						]) ?>
                        <input type="hidden" id="gamedetails-heroid"/>
                    </div>
					<div class="col-md-1">
					<label>&nbsp;</label>
						<div class="form-group">
							<?= Html::Button('Add', ['class' => 'btn btn-success', 'id'=>'btnAddplayer']) ?>
						</div>
					</div>
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
                            <th style="width:10%;text-align:center;vertical-align:middle;" rowspan="2">Player</th>
                            <th style="width:7%;text-align:center;vertical-align:middle;" rowspan="2">Hero</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Kills</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Deaths</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Assists</th>                              
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Rating</th> 
                            <th style="width:4%;text-align:center;vertical-align:middle;" colspan="6">Total Damage</th>                            
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Golds</th>
                            <th style="width:7%;text-align:center;vertical-align:middle;" rowspan="2">Medal</th>
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
                            <th style="width:10%;text-align:center;vertical-align:middle;" rowspan="2">Player</th>
                            <th style="width:7%;text-align:center;vertical-align:middle;" rowspan="2">Hero</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Kills</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Deaths</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Assists</th>                              
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Rating</th> 
                            <th style="width:4%;text-align:center;vertical-align:middle;" colspan="6">Total Damage</th>                            
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Golds</th>
                            <th style="width:7%;text-align:center;vertical-align:middle;" rowspan="2">Medal</th>
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

    <div class="col-md-12" style="margin-top:10px;">
        <div class="form-group">
            <?= Html::Button('Save', ['class' => 'btn btn-success', 'id'=>'btnSave']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
