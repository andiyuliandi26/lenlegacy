<?php

/* @var $this yii\web\View */

$this->title = 'Len Legacy';
?>
<div class="site-index">
	<div class="col-md-12" style="margin-bottom:15px">
		<div class="col-md-4" style="text-align:center;">
			<img src="/images/logolegacy.png" width=450>
		</div>
		<div class="col-md-4" style="text-align:center;">
			<h3>LEGACY Mobile Legends Tournament Standing</h3>
			<h2>Season 2</h2>
			<h5>Data updated : <?= date('d-m-Y H:i:s') ?></h5>
		</div>
		<div class="col-md-4" style="text-align:center;">
		<img src="/images/logomobilelegends.png" width=450>
		</div>
	</div>

	<div class='tabs-x tabs-above tab-bordered tabs-krajee'>
		<ul id="myTab-5" class="nav nav-tabs" role="tablist" >
			<li class="active"><a href="#home-5" role="tab" data-toggle="tab">Standing</a></li>
			<li><a href="#profile-5" role="tab-kv" data-toggle="tab">Player Statistic</a></li>
			<li><a href="#reward-5" role="tab-kv" data-toggle="tab">Reward</a></li>			
		</ul>
		<div id="myTabContent-5" class="tab-content" style="background-color:#F5F5F5;border: 1px solid;">
			<div class="tab-pane fade in active" id="home-5" style="background-color:#F5F5F5;">
				<div class="col-lg-12"  style="padding:20px 20px 10px 10px;" >
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th style="width:2%;text-align:center;vertical-align:middle;" rowspan="2">Rank</th>
								<th style="width:10%;text-align:center;vertical-align:middle;" rowspan="2">Player</th>
								<th style="width:2%;text-align:center;vertical-align:middle;" rowspan="2">Play</th>
								<th style="width:2%;text-align:center;vertical-align:middle;" rowspan="2">Win</th>
								<th style="width:2%;text-align:center;vertical-align:middle;" rowspan="2">Lose</th>								
								<th style="width:2%;text-align:center;vertical-align:middle;" rowspan="2">Win Rate</th>							
								<th style="width:2%;text-align:center;vertical-align:middle;" rowspan="2">MVP Winning</th>
								<th style="width:2%;text-align:center;vertical-align:middle;" rowspan="2">MVP Lose</th>                             
								<th style="width:4%;text-align:center;vertical-align:middle;" colspan="5">Score</th>
							</tr>
							<tr>
								<th style="width:4%;text-align:center;vertical-align:middle;">Rating</th>
								<th style="width:4%;text-align:center;vertical-align:middle;">MVP Win</th>
								<th style="width:4%;text-align:center;vertical-align:middle;">MVP Lose</th>
								<th style="width:4%;text-align:center;vertical-align:middle;">Additional Player</th>
								<th style="width:4%;text-align:center;vertical-align:middle;">Total</th>				
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								foreach($model as $value){
									//var_dump($value);
								//var_dump($value->name);
									echo '<tr>
										<td style="text-align:center;">'.$no.'</td>
										<td><a href="'.Yii::$app->request->baseUrl.'/player/view?id='.$value['playerid'].'">'.$value['name'].'</a></td>
										<td style="text-align:center;">'.$value['play'].'</td>
										<td style="text-align:center;">'.$value['win'].'</td>
										<td style="text-align:center;">'.$value['lose'].'</td>
										<td style="text-align:center;">'.$value['winrate'].'%</td>
										<td style="text-align:center;">'.$value['mvpwinning'].'</td>
										<td style="text-align:center;">'.$value['mvplose'].'</td>
										<td style="text-align:center; color:green;">'.$value['totalrating'].'</td>
										<td style="text-align:center;">'.$value['mvpwinningscore'].'</td>
										<td style="text-align:center;">'.$value['mvplose'].'</td>
										<td style="text-align:center;">'.$value['additionalplayer'].'</td>
										<td style="text-align:center; color:red;">'.$value['totalscore'].'</td>
									</tr>';

									$no++;
								}
								
							?>
						</tbody>
					</table>		
				</div>
			</div>
			<div class="tab-pane fade" id="profile-5"  style="background-color:#F5F5F5;">
				<div class="col-lg-12"  style="padding:20px 20px 10px 10px;" >
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th style="width:2%;text-align:center;vertical-align:middle;" rowspan="2">Rank</th>
								<th style="width:10%;text-align:center;vertical-align:middle;" rowspan="2">Player</th>							
								<th style="width:2%;text-align:center;vertical-align:middle;" colspan="2">MVP</th>
								<th style="width:4%;text-align:center;vertical-align:middle;" colspan="2">Kill</th>
								<th style="width:4%;text-align:center;vertical-align:middle;" colspan="2">Death</th>
								<th style="width:4%;text-align:center;vertical-align:middle;" colspan="2">Assist</th>								
								<th style="width:4%;text-align:center;vertical-align:middle;" rowspan="2">Win Rate</th>
								<th style="width:4%;text-align:center;vertical-align:middle;" colspan="2">Score</th>
							</tr>
							<tr>
								<th style="width:2%;text-align:center;vertical-align:middle;">Winning</th>
								<th style="width:2%;text-align:center;vertical-align:middle;">Lose</th>
								<th style="width:2%;text-align:center;vertical-align:middle;">Total</th>
								<th style="width:2%;text-align:center;vertical-align:middle;">Avg/match</th>
								<th style="width:2%;text-align:center;vertical-align:middle;">Total</th>
								<th style="width:2%;text-align:center;vertical-align:middle;">Avg/match</th>
								<th style="width:2%;text-align:center;vertical-align:middle;">Total</th>
								<th style="width:2%;text-align:center;vertical-align:middle;">Avg/match</th>		
								<th style="width:2%;text-align:center;vertical-align:middle;">Avg</th>
								<th style="width:2%;text-align:center;vertical-align:middle;">Total</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								foreach($statistic as $value){
									//var_dump($value);
								//var_dump($value->name);
									echo '<tr>
										<td style="text-align:center;">'.$no.'</td>
										<td><a href="'.Yii::$app->request->baseUrl.'/player/view?id='.$value->playerid.'">'.$value->player->name.' ('.$value->player->nickname.')</a></td>
										<td style="text-align:center;">'.$value->ismvpwinning.'</td>
										<td style="text-align:center;">'.$value->ismvplose.'</td>
										<td style="text-align:center;">'.$value->kill.'</td>										
										<td style="text-align:center;">'.round($value->avgkill,1).'</td>
										<td style="text-align:center;">'.$value->death.'</td>
										<td style="text-align:center;">'.round($value->avgdeath,1).'</td>
										<td style="text-align:center;">'.$value->assist.'</td>
										<td style="text-align:center;">'.round($value->avgassist,1).'</td>										
										<td style="text-align:center;">'.round($value->winrate,2).'%</td>
										<td style="text-align:center;">'.round($value->avgrating,1).'</td>
										<td style="text-align:center;">'.$value->rating.'</td>
									</tr>';

									$no++;
								}
								
							?>
						</tbody>
					</table>		
				</div>
			</div>

			<div class="tab-pane fade" id="reward-5"  style="background-color:#F5F5F5;">
				<div class="col-md-3" style="padding:20px 20px 10px 10px;">
					<div class="panel panel-danger">
						<div class="panel-heading">Most Kill Player</div>
							<div class="panel-body">
								<table id="w0" class="table table-striped table-bordered detail-view">
									<tbody>
										<tr>
											<th>Name</th>
											<td><?= $mostkill->player->name.' ('.$mostkill->player->nickname.')' ?></td>
										</tr>
										<tr>
											<th>Total Kill</th>
											<td><?= $mostkill->kill ?></td>
										</tr>
										<tr>
											<th>Average Kill/match</th>
											<td><?= round($mostkill->avgkill,1) ?></td>
										</tr>
									</tbody>
								</table>
							</div>
					</div>
				</div>

				<div class="col-md-3" style="padding:20px 20px 10px 10px;">
					<div class="panel panel-success">
						<div class="panel-heading">Most Assist Player</div>
							<div class="panel-body">
								<table id="w0" class="table table-striped table-bordered detail-view">
									<tbody>
										<tr>
											<th>Name</th>
											<td><?= $mostassist->player->name.' ('.$mostassist->player->nickname.')' ?></td>
										</tr>
										<tr>
											<th>Total Assist</th>
											<td><?= $mostassist->assist ?></td>
										</tr>
										<tr>
											<th>Average Assist/match</th>
											<td><?= round($mostassist->avgassist,1) ?></td>
										</tr>
									</tbody>
								</table>
							</div>
					</div>
				</div>

				<div class="col-md-3" style="padding:20px 20px 10px 10px;">
					<div class="panel panel-warning">
						<div class="panel-heading">Most Death Player</div>
							<div class="panel-body">
								<table id="w0" class="table table-striped table-bordered detail-view">
									<tbody>
										<tr>
											<th>Name</th>
											<td><?= $mostdeath->player->name.' ('.$mostdeath->player->nickname.')' ?></td>
										</tr>
										<tr>
											<th>Total Death</th>
											<td><?= $mostdeath->death ?></td>
										</tr>
										<tr>
											<th>Average Death/match</th>
											<td><?= round($mostdeath->avgdeath,1) ?></td>
										</tr>
									</tbody>
								</table>
							</div>
					</div>
				</div>
			</div>			
		</div>
	</div>

</div>
<?php 
	//var_dump($model);
?>