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
    <div class="col-lg-12">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th style="width:2%;text-align:center;vertical-align:middle;">Rank</th>
					<th style="width:10%;text-align:center;vertical-align:middle;">Player</th>
					<th style="width:4%;text-align:center;vertical-align:middle;">Play</th>
					<th style="width:4%;text-align:center;vertical-align:middle;">Win</th>
					<th style="width:4%;text-align:center;vertical-align:middle;">Lose</th>
					<th style="width:4%;text-align:center;vertical-align:middle;">Kill</th>
					<th style="width:4%;text-align:center;vertical-align:middle;">Death</th>
					<th style="width:4%;text-align:center;vertical-align:middle;">Assist</th>                              
					<th style="width:4%;text-align:center;vertical-align:middle;">Total Score</th>
					<th style="width:4%;text-align:center;vertical-align:middle;">Average Score</th>
					<th style="width:2%;text-align:center;vertical-align:middle;">MVP Winning</th>
					<th style="width:2%;text-align:center;vertical-align:middle;">MVP Lose</th>
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
							<td style="text-align:center;">'.$value['kill'].'</td>
							<td style="text-align:center;">'.$value['death'].'</td>
							<td style="text-align:center;">'.$value['assist'].'</td>
							<td style="text-align:center;">'.$value['totalscore'].'</td>
							<td style="text-align:center;">'.$value['avgscore'].'</td>
							<td style="text-align:center;">'.$value['mvpwinning'].'</td>
							<td style="text-align:center;">'.$value['mvplose'].'</td>
						</tr>';

						$no++;
					}
					
				?>
			</tbody>
	</table>
    </div>  
</div>
<?php 
	//var_dump($model);
?>