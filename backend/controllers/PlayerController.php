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
                ->where('playerid = '.$id.' and games.status = "Done"')
                ->groupBy(['heroid'])
                ->orderBy('count(heroid) desc, kill desc, rating desc')
                //->limit(1)
                ->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'standing' => $data,
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
