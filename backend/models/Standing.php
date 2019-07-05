<?php

namespace backend\models;
use \yii\db\Query;

use Yii;

class Standing
{
    public $player;
    public $play;
    public $win;
    public $lose;
    public $kill;
    public $death;
    public $assist;
    public $mvpwinning;
    public $mvpwinningscore;
    public $mvplose;
    public $avgkill;
    public $avgassist;
    public $avgdeath;
    public $avgrating;
    public $rating;
    public $totalrating;
    public $additionalscore;
    public $winrate;

    public static function getDataStanding($sort = "")
    {
        $query = new Query();
            $subQuery = (new \yii\db\Query())
                ->select('t2.*')
                ->from('gamedetails t2')
                ->join('INNER JOIN', 'games g', 'g.id = t2.gameid and g.status ="Done"');

			$query->select([
                't1.id as playerid',
                'CONCAT( t1.name," (",t1.nickname,")") as name',
				'(count(t2.id) - sum(t2.isadditional)) as play',
				'sum(t2.isvictory) as win', 
				'(count(t1.id) - sum(t2.isvictory)) as lose', 
				'sum(t2.kill) as kill', 
				'sum(t2.death) as death', 
				'sum(t2.assist) as assist',				
                'sum(t2.ismvpwinning) as mvpwinning',
                'sum((t2.ismvpwinning * 1.5)) as mvpwinningscore',
                'sum(t2.ismvplose) as mvplose',
                'sum(t2.isadditional) as additionalplayer',
                'sum(t2.rating) as totalrating', 
                'round(avg(t2.rating),1) as avgrating',
                '(sum(t2.rating) + sum((t2.ismvpwinning * 1.5)) + sum(t2.ismvplose) + sum(t2.isadditional)) as totalscore',
                'cast((sum(t2.isvictory)/count(t2.id)) * 100 as decimal(10,2)) as winrate'
			])
			//->joinWith(['gamedetails'])
			->from('player t1')
            ->join('LEFT OUTER JOIN',['t2' => $subQuery],'t1.id = t2.playerid')
            //->join('right JOIN','games t3','t2.gameid = t3.id')
            //->where('t2.isadditional = 0')
			->groupBy(['t1.id'])
			->orderBy($sort);
			//->asArray()
			//->all();
			$command = $query->createCommand();
            $data = $command->queryAll(); 
            
        return $data;
    }

    public static function getDataReward($sort = "", $getReward){
        $dataMax = GameDetails::find()
                    ->select('
                        sum(gamedetails.kill) as kills,
                        sum(gamedetails.assist) as assist,
                        sum(gamedetails.death) as death,
                        ')
                    ->joinWith(['game'])
                    ->where('games.status = "Done" and !isadditional')
                    ->groupBy(['playerid'])
                    ->orderBy($sort)
                    //->limit(1)
                    ->max($getReward);
        
        //$getReward = $getReward == "kills" ? "kill" : $getReward;
        $data = GameDetails::find()
                    ->select('playerid, heroid, team, 
                        sum(gamedetails.kill) as kills,
                        avg(gamedetails.kill) as avgkill,
                        sum(gamedetails.assist) as assist,
                        avg(gamedetails.assist) as avgassist,
                        sum(gamedetails.death) as death,
                        avg(gamedetails.death) as avgdeath
                        ')
                    ->joinWith(['game', 'player'], true, 'LEFT JOIN')
                    ->where('games.status = "Done" and !isadditional')
                    ->groupBy(['playerid'])
                    //->having($getReward.' = '.$dataMax)
                    ->orderBy($sort)
                    ->limit(3)
                    //->max('gamedetails.death')
                    ->all();
                    //var_dump($data);
        return $data; 
    }

    public static function getDataStatistic($sort = ""){
        $data = GameDetails::find()
                    ->select('*, 
                        sum(gamedetails.kill) as kill,
                        avg(gamedetails.kill) as avgkill,
                        sum(gamedetails.assist) as assist,
                        avg(gamedetails.assist) as avgassist,
                        sum(gamedetails.death) as death,
                        avg(gamedetails.death) as avgdeath,
                        sum(gamedetails.rating) as rating,
                        avg(gamedetails.rating) as avgrating,
                        sum(gamedetails.isvictory) as isvictory,
                        sum(gamedetails.ismvpwinning) as ismvpwinning,
                        sum(gamedetails.ismvplose) as ismvplose,
                        count(gamedetails.playerid) as play,
                        (count(gamedetails.playerid) - sum(gamedetails.isvictory)) as lose,
                        (sum(gamedetails.isvictory)/count(gamedetails.playerid) * 100) as winrate
                        ')
                    ->joinWith(['game', 'player'], true, 'LEFT JOIN')
                    ->where('games.status = "Done" and !isadditional')
                    ->groupBy(['playerid'])
                    ->orderBy($sort)
                    //->limit(1)
                    ->all();
        
        return $data; 
    }

    public static function getDataAdditional($playerid){
        $data = GameDetails::find()
                    ->select('*, 
                        sum(gamedetails.isadditional) as isadditional
                        ')
                    ->joinWith(['game', 'player'], true, 'LEFT JOIN')
                    ->where('games.status = "Done" and isadditional and playerid = '.$playerid)
                    ->groupBy(['playerid'])
                    //->orderBy($sort)
                    ->limit(1)
                    ->all();
        //var_dump($data);
        return count($data) > 0 ? $data[0]->isadditional : 0; 
    }
}
