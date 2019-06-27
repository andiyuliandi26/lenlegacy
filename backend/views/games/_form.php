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
$playerauto = Player::find()->select(['CONCAT(name," (",nickname,")") as value', 'CONCAT(name," (",nickname,")") as label','id as id'])
                        ->orderBy('label')
						->asArray()
                        ->all();
$heroauto = Hero::find()->select(['heroname as value', 'heroname as label','id as id'])
                        ->orderBy('label')
                        ->asArray()
                        ->all();
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
                '<td>'+
					'<input class="form-control" type="hidden" value="0" name="gamedetailsid">' +
					'<input class="form-control" type="hidden" value="'+ team + '" name="team">'+
					'<input class="form-control" type="hidden" value="'+ playerid + '" name="playerid">'+ playername + '</td>'+
                '<td><input class="form-control" type="hidden" value="'+ heroid + '" name="heroid">'+ heroname + '</td>'+
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
			var id = $('#games-id').val();
            var seasonid = $('#games-seasonid').val();
            var gamename = $('#games-gamename').val();
            var gameduration = $('#games-gameduration').val();
            var statusgame = $('#games-status').val();
            var gamedate = $('#gamedate').val() + ' ' + $('#gametime').val();
            var gamedetails = [];
            var countPlayer = $('input[name=team]').length;
			var medal = $('.medal').length;
				console.log(medal);
            if(countPlayer > 0){
                for(var i = 0; i < countPlayer; i++){				
                    playerdetail = {
						gamedetailsid: $('input[name=gamedetailsid]:eq('+ i +')').val(),
                        team: $('input[name=team]:eq('+ i +')').val(),
                        playerid: $('input[name=playerid]:eq('+ i +')').val(),
                        heroid: $('input[name=heroid]:eq('+ i +')').val(),
                        kill: $('input[name=kill]:eq('+ i +')').val(),
                        death: $('input[name=death]:eq('+ i +')').val(),
                        assist: $('input[name=assist]:eq('+ i +')').val(),
                        rating: $('input[name=rating]:eq('+ i +')').val(),                        
                        medal: $('.medal:eq('+ i +')').val(),
                        isvictory: $('.isvictory:eq('+ i +')').is(':checked') ? 1 : 0,
                        ismvpwinning: $('.ismvpwinning:eq('+ i +')').is(':checked') ? 1 : 0,
                        ismvplose: $('.ismvplose:eq('+ i +')').is(':checked') ? 1 : 0,
                    };

                    gamedetails.push(playerdetail);
                }
            }
            var games = {
				id: id,
                seasonid: seasonid,
                status: statusgame,
                gamedate: gamedate,
                //gameduration: gameduration,
                gamedetails: gamedetails,
            };

            //console.log(games);
            $.ajax({
                url : '<?php echo Yii::$app->request->baseUrl.'/games/savegames' ?>',
                type : 'post',
                data : {
                    games: games
                },
                success: function (result){
                    console.log(result.data);
					alert("Penyimpanan data berhasil.");
					window.location.replace('<?php echo Yii::$app->request->baseUrl.'/games/' ?>');
                }
    	    });
        });

        $(".playerauto").autocomplete({
            minLength: 0,
            source: <?= json_encode($playerauto) ?>,
            select: function (event, ui) {
                var varname = $(this).attr('class'),
                $arr = $('input[name=player]'),
                index = $arr.index(this);
                console.log(index);
                $(".playerid:eq("+ index +")").val(ui.item.id);
            }
        }).focus(function () {
            $(this).autocomplete("search", "");
        });

        $(".heroauto").autocomplete({
            minLength: 0,
            source: <?= json_encode($heroauto) ?>,
            select: function (event, ui) {
                var varname = $(this).attr('class'),
                $arr = $('input[name=hero]'),
                index = $arr.index(this);
                console.log(index);
                $(".heroid:eq("+ index +")").val(ui.item.id);
            }
        }).focus(function () {
            $(this).autocomplete("search", "");
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
			<div class="col-sm-12">
				<div class="col-sm-2">
					<?php
						$season=Season::find()->all();
						$listData=ArrayHelper::map($season,'id','seasonname');
					?>
					<input type="hidden" name="games-id" id="games-id" value="<?= $model->id; ?>">
					<?= $form->field($model, 'seasonid')->dropDownList($listData,['prompt'=>'Silahkan pilih...']); ?>
				</div>
				<div class="col-sm-4">
					<div class="col-sm-12">
					    <label>Game Date</label>
                    </div>
					<?php
						$explode = explode(' ', $model->gamedate);
					?>
					<div class="col-sm-7">                
						<?= DatePicker::widget([
							'name' => 'gamedate',
							'id' => 'gamedate',
							'type' => DatePicker::TYPE_COMPONENT_PREPEND,
							//'value' => date("Y-m-d"),
							'value' => $model->gamedate != "" ? $explode[0] : date("Y-m-d"),
							'pluginOptions' => [
								'autoclose'=>true,
								'format' => 'yyyy-mm-dd',
								'language' =>'id',
								'minViewMode'=>0,
								//'endDate'=>'+0y',
							]
						]); ?>
					</div>
					<div class="col-sm-5">
						<?= TimePicker::widget([
							'id' => 'gametime',
							'name' => 'gametime',
							'value' => $model->gamedate != "" ? $explode[1] : date("H:m:s"),
							'pluginOptions' => [
								'minuteStep' => 1,
								'showSeconds' => true,
								'showMeridian' => false
							]
						]); ?>
					</div>                    
				</div>
                <div class="col-sm-2">
                    <?= $form->field($model, 'status')->dropDownList(['Scheduled'=> 'Scheduled' ,'Done' => 'Done']); ?>
                </div>
			</div>
			
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Player Detail</div>
        <div class="panel-body">
            <div class="col-md-12" style="overflow:scroll;">
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
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Kill</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Death</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Assist</th>                              
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
							//print_r($model->gamedetails);
							if(count($model->gamedetails) > 0){
								for($i = 0; $i < count($model->gamedetails); $i++){
									$getPlayer = $model->gamedetails[$i];
									//print_r($getPlayer->player);
									$afk = $getPlayer->medal == "AFK" ? "selected" : "";
									$bronze = $getPlayer->medal == "Bronze" ? "selected" : "";
									$silver = $getPlayer->medal == "Silver" ? "selected" : "";
									$gold = $getPlayer->medal == "Gold" ? "selected" : "";
									$isvictory = $getPlayer->isvictory ? "checked" : "";
									$ismvpwinning = $getPlayer->ismvpwinning ? "checked" : "";
                                    $ismvplose = $getPlayer->ismvplose ? "checked" : "";
                                    $heroname = $getPlayer->hero != null ? $getPlayer->hero->heroname : "";
									if($getPlayer->team == "A"){
                                        echo '<tr>
                                            <td><input class="form-control" type="hidden" value="'.$getPlayer->id.'" name="gamedetailsid">
                                                <input class="form-control" type="hidden" value="'.$getPlayer->team.'" name="team">
                                                <input class="form-control playerauto" type="text" value="'.$getPlayer->player->playerfullname.'" name="player">
                                                <input class="form-control playerid" type="hidden" value="'.$getPlayer->playerid.'" name="playerid"> 
                                            </td>
                                            <td>
                                                <input class="form-control heroauto" type="text" value="'.$heroname.'" name="hero">
                                                <input class="form-control heroid" type="hidden" value="'.$getPlayer->heroid.'" name="heroid">
                                            </td>
                                            <td><input class="form-control" type="text" value="'.$getPlayer->kill.'" name="kill"></td>
                                            <td><input class="form-control" type="text" value="'.$getPlayer->death.'" name="death"></td>
                                            <td><input class="form-control" type="text" value="'.$getPlayer->assist.'" name="assist"></td>
                                            <td><input class="form-control" type="text" value="'.$getPlayer->rating.'" name="rating"></td>
                                            <td>
                                            <select class="form-control medal" name="medal">
                                                <option value=""></option>
                                                <option value="AFK" '.$afk.'>AFK</option>
                                                <option value="Bronze" '.$bronze.'>Bronze</option>
                                                <option value="Silver" '.$silver.'>Silver</option>
                                                <option value="Gold" '.$gold.'>Gold</option>
                                                </select>
                                            </td>
                                            <td><input class="form-control isvictory" type="checkbox" value="1" name="isvictory"  '.$isvictory.'></td>
                                            <td><input class="form-control ismvpwinning" type="checkbox" value="1" name="ismvpwinning"  '.$ismvpwinning.'></td>
                                            <td><input class="form-control ismvplose" type="checkbox" value="1" name="ismvplose"  '.$ismvplose.'></td>
                                        </tr>';
                                    }
                                }
							}else{
                                for($i = 0; $i < 5; $i++){
                                        echo '<tr>
                                            <td>
                                                <input class="form-control" type="hidden" value="0" name="gamedetailsid">
                                                <input class="form-control" type="hidden" value="A" name="team">
                                                <input class="form-control playerauto" type="text" value="" name="player">
                                                <input class="form-control playerid" type="hidden" value="" name="playerid">
                                            </td>
                                            <td>
                                                <input class="form-control heroauto" type="text" value="" name="hero">
                                                <input class="form-control heroid" type="hidden" value="" name="heroid">
                                            </td>
                                            <td><input class="form-control" type="text" value="0" name="kill"></td>
                                            <td><input class="form-control" type="text" value="0" name="death"></td>
                                            <td><input class="form-control" type="text" value="0" name="assist"></td>
                                            <td><input class="form-control" type="text" value="0" name="rating"></td>
                                            <td>
                                            <select class="form-control medal" name="medal">
                                                <option value=""></option>
                                                <option value="AFK" >AFK</option>
                                                <option value="Bronze" >Bronze</option>
                                                <option value="Silver" >Silver</option>
                                                <option value="Gold" >Gold</option>
                                                </select>
                                            </td>
                                            <td><input class="form-control isvictory" type="checkbox" value="1" name="isvictory"></td>
                                            <td><input class="form-control ismvpwinning" type="checkbox" value="1" name="ismvpwinning"></td>
                                            <td><input class="form-control ismvplose" type="checkbox" value="1" name="ismvplose"></td>
                                        </tr>';
                                }
                            }
						?>
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
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Kill</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Death</th>
                            <th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Assist</th>                              
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
									//print_r($getPlayer->player);
									$afk = $getPlayer->medal == "AFK" ? "selected" : "";
									$bronze = $getPlayer->medal == "Bronze" ? "selected" : "";
									$silver = $getPlayer->medal == "Silver" ? "selected" : "";
									$gold = $getPlayer->medal == "Gold" ? "selected" : "";
									$isvictory = $getPlayer->isvictory ? "checked" : "";
									$ismvpwinning = $getPlayer->ismvpwinning ? "checked" : "";
                                    $ismvplose = $getPlayer->ismvplose ? "checked" : "";
                                    $heroname = $getPlayer->hero != null ? $getPlayer->hero->heroname : "";
									if($getPlayer->team == "B"){
									echo '<tr>
										<td>
											<input class="form-control" type="hidden" value="'.$getPlayer->id.'" name="gamedetailsid">
											<input class="form-control" type="hidden" value="'.$getPlayer->team.'" name="team">
                                            <input class="form-control playerauto" type="text" value="'.$getPlayer->player->playerfullname.'" name="player">
                                            <input class="form-control playerid" type="hidden" value="'.$getPlayer->playerid.'" name="playerid">
                                        </td>
                                        <td>
                                            <input class="form-control heroauto" type="text" value="'.$heroname.'" name="hero">
                                            <input class="form-control heroid" type="hidden" value="'.$getPlayer->heroid.'" name="heroid">
                                        </td>
										<td><input class="form-control" type="text" value="'.$getPlayer->kill.'" name="kill"></td>
										<td><input class="form-control" type="text" value="'.$getPlayer->death.'" name="death"></td>
										<td><input class="form-control" type="text" value="'.$getPlayer->assist.'" name="assist"></td>
										<td><input class="form-control" type="text" value="'.$getPlayer->rating.'" name="rating"></td>
										<td>
										<select class="form-control medal" name="medal">
											<option value=""></option>
											<option value="AFK" '.$afk.'>AFK</option>
											<option value="Bronze" '.$bronze.'>Bronze</option>
											<option value="Silver" '.$silver.'>Silver</option>
											<option value="Gold" '.$gold.'>Gold</option>
											</select>
										</td>
										<td><input class="form-control isvictory" type="checkbox" value="1" name="isvictory"  '.$isvictory.'></td>
										<td><input class="form-control ismvpwinning" type="checkbox" value="1" name="ismvpwinning"  '.$ismvpwinning.'></td>
										<td><input class="form-control ismvplose" type="checkbox" value="1" name="ismvplose"  '.$ismvplose.'></td>
									</tr>';
								}
								}
							}else{
                                for($i = 0; $i < 5; $i++){
                                        echo '<tr>
                                            <td>
                                                <input class="form-control" type="hidden" value="0" name="gamedetailsid">
                                                <input class="form-control" type="hidden" value="B" name="team">
                                                <input class="form-control playerauto" type="text" value="" name="player">
                                                <input class="form-control playerid" type="hidden" value="" name="playerid">
                                            </td>
                                            <td>
                                                <input class="form-control heroauto" type="text" value="" name="hero">
                                                <input class="form-control heroid" type="hidden" value="" name="heroid">
                                            </td>
                                            <td><input class="form-control" type="text" value="0" name="kill"></td>
                                            <td><input class="form-control" type="text" value="0" name="death"></td>
                                            <td><input class="form-control" type="text" value="0" name="assist"></td>
                                            <td><input class="form-control" type="text" value="0" name="rating"></td>
                                            <td>
                                            <select class="form-control medal" name="medal">
                                                <option value=""></option>
                                                <option value="AFK" >AFK</option>
                                                <option value="Bronze" >Bronze</option>
                                                <option value="Silver" >Silver</option>
                                                <option value="Gold" >Gold</option>
                                                </select>
                                            </td>
                                            <td><input class="form-control isvictory" type="checkbox" value="1" name="isvictory"></td>
                                            <td><input class="form-control ismvpwinning" type="checkbox" value="1" name="ismvpwinning"></td>
                                            <td><input class="form-control ismvplose" type="checkbox" value="1" name="ismvplose"></td>
                                        </tr>';
                                }
                            }
						?>
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
