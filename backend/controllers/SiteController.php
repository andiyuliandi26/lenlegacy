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
        $data = Standing::getDataStanding('totalscore DESC, kill DESC, assist DESC, name');
        $stats = Standing::getDataStanding('totalrating DESC, kill DESC, assist DESC, name');
        $mostkill = Standing::getDataReward('kills DESC', 'kills');
        $mostassist = Standing::getDataReward('assist DESC', 'assist');
        $mostdeath = Standing::getDataReward('death DESC', 'death');
        $statistic = Standing::getDataStatistic('name, rating DESC, kill DESC, assist DESC');
        
        $standingList = [];
        foreach($statistic as $value){

             $standing = new Standing();
             $standing->player = $value->player;
             $standing->play = $value->play;
             $standing->win = $value->isvictory;
             $standing->lose = $value->lose;
             $standing->kill = $value->kill;
             $standing->death = $value->death;
             $standing->assist = $value->assist;
             $standing->mvpwinning = $value->ismvpwinning;
             $standing->mvpwinningscore = $value->ismvpwinning * 1.5;
             $standing->mvplose = $value->ismvplose;
             $standing->avgkill = $value->avgkill;
             $standing->avgassist = $value->avgassist;
             $standing->avgdeath = $value->avgdeath;
             $standing->avgrating = $value->avgrating;
             $standing->rating = $value->rating;             
             $standing->additionalscore = Standing::getDataAdditional($value->player->id);
             $standing->totalrating = $value->rating + $standing->mvpwinningscore + $standing->mvplose + $standing->additionalscore;
             $standing->winrate = round($value->winrate,2);

             array_push($standingList, $standing);
        }

        $sort = array();
        foreach($standingList as $k=>$v) {
            $sort['totalrating'][$k] = $v->totalrating;
            $sort['kill'][$k] = $v->kill;
            $sort['assist'][$k] = $v->assist;
        }

        array_multisort(
                $sort['totalrating'], SORT_DESC,
                $sort['kill'],SORT_DESC,
                $sort['assist'],SORT_DESC,
                $standingList);

         //usort($standingList,$this->make_cmp(['totalrating'=>'desc', 'kill'=>'desc']));

        // usort($standingList,function($object1, $object2) { 
        //     return $object1->totalrating < $object2->totalrating; 
        // });

        // usort($standingList,function($object1, $object2) { 
        //     return $object1->kill < $object2->kill; 
        // });

        //var_dump($standingList);
        return $this->render('index',[
            'model' => $data,
            'stats' => $stats,
            'statistic' => $statistic,
            'mostkill' => $mostkill,
            'mostassist' => $mostassist,
            'mostdeath' => $mostdeath,
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
