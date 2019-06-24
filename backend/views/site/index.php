<?php

/* @var $this yii\web\View */

$this->title = 'Len Legacy';
?>
<div class="site-index">

    <div class="jumbotron">
        <h3>Klasemen Len Legacy Tournamen</h3>

        <small class="text-small">You have successfully created your Yii-powered application.</small>
    </div>
    <div class="col-lg-12">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
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
					foreach($model as $value){
						//var_dump($value);
					//var_dump($value->name);
						echo '<tr>
							<td>'.$value['name'].'</td>
							<td>'.$value['play'].'</td>
							<td>'.$value['win'].'</td>
							<td>'.$value['lose'].'</td>
							<td>'.$value['kill'].'</td>
							<td>'.$value['death'].'</td>
							<td>'.$value['assist'].'</td>
							<td>'.$value['totalscore'].'</td>
							<td>'.$value['avgscore'].'</td>
							<td>'.$value['mvpwinning'].'</td>
							<td>'.$value['mvplose'].'</td>
						</tr>';
					}
					
				?>
			</tbody>
	</table>
    </div>  
</div>
<?php 
	//var_dump($model);
?>