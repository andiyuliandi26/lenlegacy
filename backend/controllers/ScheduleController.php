<?php

namespace backend\controllers;

use Yii;
use backend\models\Schedule;
use backend\models\ScheduleSearch;
use backend\models\Games;
use backend\models\GamesSearch;
use backend\models\GameDetails;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ScheduleController implements the CRUD actions for Schedule model.
 */
class ScheduleController extends Controller
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
                        'actions' => ['index', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['create'],
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
     * Lists all Schedule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Games::find()
            ->where('status = "Scheduled"')
            ->all();

        return $this->render('index', [
            'model' => $model
        ]);
    }

    /**
     * Displays a single Schedule model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Schedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Games();
        $models = new GameDetails();
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'models'=> $models
        ]);
    }

    /**
     * Updates an existing Schedule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$models = new GameDetails();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'models'=> $models
        ]);
    }

    /**
     * Deletes an existing Schedule model.
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
     * Finds the Schedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Schedule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Schedule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSaveSchedule(){
				
        $code = 0;
		if(Yii::$app->request->isAjax){
			$data = Yii::$app->request->post();
            $getSchedule = $data["Schedule"];

			if($getSchedule["id"] != "" && $getSchedule["id"] != 0){
				//$Schedule->id = $getSchedule["id"];
				$Schedule = Schedule::findOne($getSchedule["id"]);
			}else{
				$Schedule = new Schedule();
			}

            $Schedule->seasonid = $getSchedule["seasonid"];
            $Schedule->gamename = preg_replace("/[^0-9]/", "", $getSchedule["gamedate"]);
            $Schedule->gamedate = $getSchedule["gamedate"];
            //$Schedule->gameduration = $getSchedule["gameduration"];
            $gamedetailscount = count($getSchedule["gamedetails"]);
			//$Scheduledetails = explode(":", $data['Scheduledetails']);
			
			if($Schedule->save()){
                $result = $Schedule->id;

                if($gamedetailscount > 0){
                    for($i = 0; $i < $gamedetailscount; $i++){
                        $getDetails = $getSchedule["gamedetails"][$i];                        

						if($getDetails["gamedetailsid"] != "" && $getDetails["gamedetailsid"] != 0){
							//$gamedetails->id = $getDetails["gamedetailsid"];
							$gamedetails = GameDetails::findOne($getDetails["gamedetailsid"]);
						}else{
							$gamedetails = new GameDetails();
						}

                        $gamedetails->gameid = $Schedule->id;
                        $gamedetails->team = $getDetails["team"];
                        $gamedetails->playerid = $getDetails["playerid"];
                        $gamedetails->heroid = $getDetails["heroid"];
                        $gamedetails->herodamage = $getDetails["herodamage"];
                        $gamedetails->herodamagepersentage = $getDetails["herodamagepersentage"];
                        $gamedetails->turretdamage = $getDetails["turretdamage"];
                        $gamedetails->turretdamagepersentage = $getDetails["turretdamagepersentage"];
                        $gamedetails->damagetaken = $getDetails["damagetaken"];
                        $gamedetails->damagetakenpersentage = $getDetails["damagetakenpersentage"];
                        $gamedetails->kill = $getDetails["kill"];
                        $gamedetails->death = $getDetails["death"];
                        $gamedetails->assist = $getDetails["assist"];
                        $gamedetails->gold = $getDetails["gold"];
                        $gamedetails->rating = $getDetails["rating"];
                        $gamedetails->medal = $getDetails["medal"];
                        $gamedetails->isvictory = $getDetails["isvictory"];
                        $gamedetails->ismvpwinning = $getDetails["ismvpwinning"];
                        $gamedetails->ismvplose = $getDetails["ismvplose"];

                        if($gamedetails->save()){
                            $code = 300;
                        }
                    }
                }
            }else{
                $result = $Schedule->getErrors();
            }
			    
			    
				
			//}else{
				//$result = "false";
			//}
			
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return [
				'status' => $result,
				'code' => $gamedetailscount,
				'data' => $getSchedule["gamedetails"],
			];
		}	
	}
}
