<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Player;
use backend\models\Standing;
use backend\models\GameDetails;
use \yii\db\Query;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            // 'access' => [
            //     'class' => AccessControl::className(),
            //     'rules' => [
            //         [
            //             'actions' => ['login', 'error'],
            //             'allow' => true,
            //         ],
            //         [
            //             'actions' => ['logout', 'index'],
            //             'allow' => true,
            //             'roles' => ['@'],
            //         ],
            //     ],
            // ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    private function comparator($object1, $object2) { 
        return $object1->totalrating < $object2->totalrating; 
    }

    public function make_cmp(array $sortValues)
    {
        return function ($a, $b) use (&$sortValues) {
            foreach ($sortValues as $column => $sortDir) {
                $diff = strcmp($a->$column, $b->$column);
                if ($diff !== 0) {
                    if ('asc' === $sortDir) {
                        return $diff;
                    }
                    return $diff * -1;
                }
            }
            return 0;
        };
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //$data = Standing::getDataStanding('totalscore DESC, kill DESC, assist DESC, name');
        //$stats = Standing::getDataStanding('totalrating DESC, kill DESC, assist DESC, name');
        $mostkill = array();
        
        $mostassist = array();
        $mostdeath = Standing::getDataReward('death DESC', 'death');
        $survival = Standing::getDataReward('death ASC', 'death');
        $statistic = Standing::getDataStatistic('rating DESC, kills DESC, assist DESC, name');
        
        //print_r(json_encode($statistic));
        $standingList = array();
        $mostkillList = array();
        $mostassistList = array();

        foreach($statistic as $value){
             $standing = new Standing();
             $standing->player = $value->player;
             $standing->play = $value->play;
             $standing->win = $value->isvictory;
             $standing->lose = $value->lose;
             $standing->kill = $value->kills;
             $standing->death = $value->death;
             $standing->assist = round($value->assist,1);
             $standing->mvpwinning = $value->ismvpwinning;
             $standing->mvpwinningscore = $value->ismvpwinning * 1.5;
             $standing->mvplose = $value->ismvplose;
             $standing->avgkill = $value->avgkill;
             $standing->avgassist = $value->avgassist;
             $standing->avgdeath = $value->avgdeath;
             $standing->avgrating = $value->avgrating;
             $standing->rating = round($value->rating,1);             
             $standing->additionalscore = Standing::getDataAdditional($value->player->id);
             $standing->totalrating = round($value->rating,1) + $standing->mvpwinningscore + $standing->mvplose + $standing->additionalscore;
             $standing->winrate = round($value->winrate,2);

             array_push($standingList, $standing);
             array_push($mostkillList, $standing);
             array_push($mostassistList, $standing);
        }

        $sort = array();
        foreach($standingList as $k=>$v) {
            $sort['totalrating'][$k] = $v->totalrating;
            $sort['kill'][$k] = $v->kill;
            $sort['assist'][$k] = $v->assist;
            $sort['winrate'][$k] = $v->winrate;
        }

        $sort2 = array();
        foreach($mostkillList as $k=>$v) {
            $sort2['totalrating'][$k] = $v->totalrating;
            $sort2['kill'][$k] = $v->kill;
            $sort2['assist'][$k] = $v->assist;
            $sort2['winrate'][$k] = $v->winrate;
        }

        $sort3 = array();
        foreach($mostassistList as $k=>$v) {
            $sort3['totalrating'][$k] = $v->totalrating;
            $sort3['kill'][$k] = $v->kill;
            $sort3['assist'][$k] = $v->assist;
            $sort3['winrate'][$k] = $v->winrate;
        }
        
        array_multisort( $sort['totalrating'],SORT_DESC, $sort['kill'],SORT_DESC, $sort['assist'],SORT_DESC, $standingList);
        array_multisort( $sort2['kill'],SORT_DESC, $sort2['totalrating'],SORT_DESC, $sort2['winrate'],SORT_DESC, $mostkillList);
        array_multisort( $sort3['assist'],SORT_DESC, $sort3['totalrating'],SORT_DESC, $sort3['winrate'],SORT_DESC, $mostassistList);
        //print_r(json_encode($sort));
        for($i = 0; $i < 3; $i++){
            array_push($mostkill, $mostkillList[$i]);
        }

        for($i = 0; $i < 3; $i++){
            array_push($mostassist, $mostassistList[$i]);
        }

        return $this->render('index',[
            //'model' => $data,
            //'stats' => $stats,
            'statistic' => $statistic,
            'mostkill' => $mostkill,
            'mostassist' => $mostassist,
            'mostdeath' => $mostdeath,
            'survival' => $survival,
            'standing' => (object) $standingList,
		]);
    }

    

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
