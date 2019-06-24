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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
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
			$query->select([
				'CONCAT(t1.name," (",t1.nickname,")") as name',
				'count(t2.id) as play',
				'sum(t2.isvictory) as win', 
				'(count(t1.id) - sum(t2.isvictory)) as lose', 
				'sum(t2.kill) as kill', 
				'sum(t2.death) as death', 
				'sum(t2.assist) as assist', 
				'sum(t2.rating) as totalscore', 
				'avg(t2.rating) as avgscore',
				'sum(t2.ismvpwinning) as mvpwinning',
				'sum(t2.ismvplose) as mvplose'
			])
			//->joinWith(['gamedetails'])
			->from('player t1')
			->join('LEFT OUTER JOIN','gamedetails t2','t1.id = t2.playerid')
			->groupBy(['t1.id'])
			->orderBy('totalscore DESC');
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
