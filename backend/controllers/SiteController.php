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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		//$query = Player::find()
			//->select('name, count(gamedetails.id) as play')
			//->joinWith(['gamedetails'])
			//->leftjoin('gamedetails','player.id = gamedetails.playerid')
			//->groupby(['player.id'])
			//->asArray()
			//->all();

            $query = new Query();
            $subQuery = (new \yii\db\Query())
                ->select('t2.*')
                ->from('gamedetails t2')
                ->join('INNER JOIN', 'games g', 'g.id = t2.gameid and g.status ="Done"');
			$query->select([
                't1.id as playerid',
                'CONCAT( t1.name," (",t1.nickname,")") as name',
				'count(t2.id) as play',
				'sum(t2.isvictory) as win', 
				'(count(t1.id) - sum(t2.isvictory)) as lose', 
				'sum(t2.kill) as kill', 
				'sum(t2.death) as death', 
				'sum(t2.assist) as assist', 
				'(sum(t2.rating) + sum((t2.ismvpwinning * 1.5)) + sum(t2.ismvplose)) as totalscore', 
				'round(avg((t2.rating + (t2.ismvpwinning * 1.5) + t2.ismvplose)),1) as avgscore',
				'sum(t2.ismvpwinning) as mvpwinning',
                'sum(t2.ismvplose) as mvplose',
                'cast((sum(t2.isvictory)/count(t2.id)) * 100 as decimal(10,2)) as winrate'
			])
			//->joinWith(['gamedetails'])
			->from('player t1')
            ->join('LEFT OUTER JOIN',['t2' => $subQuery],'t1.id = t2.playerid')
            //->join('right JOIN','games t3','t2.gameid = t3.id')
            //->where('t3.Status = "Done"')
			->groupBy(['t1.id'])
			->orderBy('totalscore DESC, name');
			//->asArray()
			//->all();
			$command = $query->createCommand();
			$data = $command->queryAll(); 

        return $this->render('index',[
			'model' => $data
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
