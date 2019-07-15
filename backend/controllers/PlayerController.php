<?php

namespace backend\controllers;

use Yii;
use backend\models\Player;
use backend\models\PlayerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use \yii\db\Query;
use backend\models\GameDetails;
use backend\models\Standing;

/**
 * PlayerController implements the CRUD actions for Player model.
 */
class PlayerController extends Controller
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
                        'actions' => ['index', 'view'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['create','update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Player models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlayerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Player model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
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
            
         $game = GameDetails::find()
                ->select('*, 
                    count(heroid) as herodamage, 
                    sum(gamedetails.kill) as kill,
                    sum(gamedetails.death) as death,
                    sum(gamedetails.assist) as assist,
                    avg(gamedetails.rating) as rating,
                    sum(gamedetails.isvictory) as isvictory,
                    (count(heroid) - sum(gamedetails.isvictory)) as ismvplose,
                ')
                ->joinWith(['game'])
                ->where('playerid = '.$id.' and games.status = "Done" and !isadditional')
                ->groupBy(['heroid'])
                ->orderBy('count(heroid) desc, kill desc, rating desc')
                //->limit(1)
                ->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'standing' => $standingList,
            'games' => $game
        ]);
    }

    /**
     * Creates a new Player model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Player();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Player model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Player model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Player model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Player the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Player::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
