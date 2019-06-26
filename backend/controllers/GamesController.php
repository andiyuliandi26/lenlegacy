<?php

namespace backend\controllers;

use Yii;
use backend\models\Games;
use backend\models\GamesSearch;
use backend\models\GameDetails;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * GamesController implements the CRUD actions for Games model.
 */
class GamesController extends Controller
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
     * Lists all Games models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GamesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = Games::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * Displays a single Games model.
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
     * Creates a new Games model.
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
     * Updates an existing Games model.
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
     * Deletes an existing Games model.
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
     * Finds the Games model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Games the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Games::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSavegames(){
				
        $code = 0;
		if(Yii::$app->request->isAjax){
			$data = Yii::$app->request->post();
            $getGames = $data["games"];

			if($getGames["id"] != "" && $getGames["id"] != 0){
				//$games->id = $getGames["id"];
				$games = Games::findOne($getGames["id"]);
			}else{
				$games = new Games();
			}

            $games->seasonid = $getGames["seasonid"];
            $games->gamename = preg_replace("/[^0-9]/", "", $getGames["gamedate"]);
            $games->gamedate = $getGames["gamedate"];
            $games->status = $getGames["status"];
            $gamedetailscount = count($getGames["gamedetails"]);
			//$gamesdetails = explode(":", $data['gamesdetails']);
			
			if($games->save()){
                $result = $games->id;

                if($gamedetailscount > 0){
                    for($i = 0; $i < $gamedetailscount; $i++){
                        $getDetails = $getGames["gamedetails"][$i];                        

						if($getDetails["gamedetailsid"] != "" && $getDetails["gamedetailsid"] != 0){
							//$gamedetails->id = $getDetails["gamedetailsid"];
							$gamedetails = GameDetails::findOne($getDetails["gamedetailsid"]);
						}else{
							$gamedetails = new GameDetails();
						}

                        $gamedetails->gameid = $games->id;
                        $gamedetails->team = $getDetails["team"];
                        $gamedetails->playerid = $getDetails["playerid"];
                        $gamedetails->heroid = $getDetails["heroid"];
                        $gamedetails->kill = $getDetails["kill"];
                        $gamedetails->death = $getDetails["death"];
                        $gamedetails->assist = $getDetails["assist"];
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
                $result = $games->getErrors();
            }
			    
			    
				
			//}else{
				//$result = "false";
			//}
			
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return [
				'status' => $result,
				'code' => $gamedetailscount,
				'data' => $getGames["gamedetails"],
			];
		}	
	}
}
