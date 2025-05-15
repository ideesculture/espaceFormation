<?php

namespace app\controllers;

use app\models\Sessions;
use app\models\SessionsSearch;
use app\models\SessionStagiaire;
use app\models\Stagiaires;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
use Yii;

/**
 * SessionsController implements the CRUD actions for Sessions model.
 */
class SessionsController extends Controller {
    /**
     * @inheritDoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {    
                             $user = Yii::$app->user->identity;
                            return $user->role === 'admin' || $user->role === 'stagiaire' || $user->role === 'formateur';},
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    throw new ForbiddenHttpException('Access denied.');
                },
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Sessions models.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModel = new SessionsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sessions model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
		$sessionStagiaire = new SessionStagiaire();

		//Extrait le stagiaire_id depuis la table Stagiaires en fonction du user_id de l'utilisateur logué
		$stagiaires = new Stagiaires();
		$stagiaire = $stagiaires->findOne(['user_id' => Yii::$app->user->id]);
		
		// Récupére user connecté
		//Yii::$app->user->id;
		// Récup Le stagiaire associé
		//$stagiaire->id;
		$connection = Yii::$app->getDb();
		if($stagiaire->id) {
			$command = $connection->createCommand("SELECT count(id) as num FROM questionnaire_fin_formation where session_id = ".$id." and stagiaire_id = ".$stagiaire->id);
			$result = $command->queryAll();
			
			return $this->render('view', [
				'model' => $this->findModel($id),
				'stagiaire' => $stagiaire,
				'enable_questionnaire_fin_formation' => !$result[0]['num']
			]);
		} else {
			return $this->render('view', [
				'model' => $this->findModel($id)
			]);
		}

		
		

		//$stagiaire = $sessionStagiaire->findOne(['session_id' => $id, 'stagiaire_id' => Yii::$app->user->id]);
        
    }

    /**
     * Creates a new Sessions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {
        $model = new Sessions();
        // $model->debut = Yii::$app->formatter->asDate(DateTime::createFromFormat('d-m-Y', $model->debut), 'yyyy-MM-dd');
        // $model->fin = Yii::$app->formatter->asDate(DateTime::createFromFormat('d-m-Y', $model->fin), 'yyyy-MM-dd');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }


        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Sessions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
      
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Sessions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->verifStagiaire();
		// first delete all records with the session_id in the table session_stagiaire

        $this->findModel($id)->delete();
        return $this->redirect(['index']);

    }

    public function verifStagiaire() {
        // Vérifie si l'utilisateur est un stagiaire
        $user = Yii::$app->user->identity;
        if ($user && ($user->role === 'stagiaire' || $user->role === 'formateur')){
            throw new ForbiddenHttpException('Accès interdit.');
        } else {
            return;
        }
    }

    /**
     * Finds the Sessions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Sessions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Sessions::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

	/**
     * Displays page : questionnaire-debut-formation
     *
     * @return string
     */
    public function actionQuestionnaireDebutFormation($session, $stagiaire)
    {
        return $this->render('questionnaire-debut-formation', [
            'session_id' => $session,
			'stagiaire_id' => $stagiaire
        ]);
    }

	/**
     * Displays page : questionnaire-fin-formation
     *
     * @return string
     */
    public function actionQuestionnaireFinFormation($session, $stagiaire)
    {
        return $this->render('questionnaire-fin-formation', [
            'session_id' => $session,
			'stagiaire_id' => $stagiaire
        ]);
    }

    /**
     * Displays page : questionnaire-debut-formation
     *
     * @return string
     */
    public function actionQuestionnaireDebutFormationSave($session_id, $stagiaire_id)
    {
		// get all URL parameters
		$allParams = Yii::$app->request->queryParams;
		// get all POST parameters
		$allParams2 = Yii::$app->request->post();
		// get all GET parameters
		$allParams3 = Yii::$app->request->get();
		// merge all parameters
		$allParams = array_merge($allParams, $allParams2, $allParams3);
		// loop through all parameters, remove if empty value
		foreach ($allParams as $key => $value) {
			if (empty($value) || $value=="") {
				unset($allParams[$key]);
				continue;
			}
			// remove all tags, filter for XSS
			$allParams[$key] = strip_tags($value);
			// keep only ASCII and european accents, ".,:; " as punctuation, filter for SQL injection
			$allParams[$key] = str_replace(";","\n",$value);
			$allParams[$key] = preg_replace('|[^a-zA-Z0-9éèàùâêîôûäëïöüçÿÊËÏÜÇÔÎÛÂÆæÙÌÒÈ.,:\s/\-]|', '', $value);
		}
		
		$connection = Yii::$app->getDb();
		// Loop through allParams and add keys as new columns (TEXT) in the database if they don't already exist
		foreach ($allParams as $key => $value) {
			$command = $connection->createCommand("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'questionnaire_debut_formation' AND COLUMN_NAME = '$key'");
			$result = $command->queryAll();
			if (empty($result)) {
				$command = $connection->createCommand("ALTER TABLE questionnaire_debut_formation ADD COLUMN $key TEXT");
				$result = $command->queryAll();
			}
		}

		// Now insert the values into the database
		$columns = implode(", ", array_keys($allParams));
		$values = implode("', '", array_values($allParams));
		$command = $connection->createCommand("REPLACE INTO questionnaire_debut_formation ($columns) VALUES ('$values')");

		$result = $command->queryAll();
		
        return $this->render('questionnaire-merci');
    }

	/**
     * Displays page : questionnaire-fin-formation
     *
     * @return string
     */
    public function actionQuestionnaireFinFormationSave($session_id, $stagiaire_id)
    {
		// get all URL parameters
		$allParams = Yii::$app->request->queryParams;
		// get all POST parameters
		$allParams2 = Yii::$app->request->post();
		// get all GET parameters
		$allParams3 = Yii::$app->request->get();
		// merge all parameters
		$allParams = array_merge($allParams, $allParams2, $allParams3);
		// loop through all parameters, remove if empty value
		foreach ($allParams as $key => $value) {
			if (empty($value) || $value=="") {
				unset($allParams[$key]);
				continue;
			}
			// remove all tags, filter for XSS
			$allParams[$key] = strip_tags($value);
			// keep only ASCII and european accents, ".,:; " as punctuation, filter for SQL injection
			$allParams[$key] = str_replace(";","\n",$value);
			$allParams[$key] = preg_replace('|[^a-zA-Z0-9éèàùâêîôûäëïöüçÿÊËÏÜÇÔÎÛÂÆæÙÌÒÈ.,:\s/\-]|', '', $value);
		}
		
		$connection = Yii::$app->getDb();
		// Loop through allParams and add keys as new columns (TEXT) in the database if they don't already exist
		foreach ($allParams as $key => $value) {
			$command = $connection->createCommand("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'questionnaire_fin_formation' AND COLUMN_NAME = '$key'");
			$result = $command->queryAll();
			if (empty($result)) {
				$command = $connection->createCommand("ALTER TABLE questionnaire_fin_formation ADD COLUMN $key TEXT");
				$result = $command->queryAll();
			}
		}

		// Now insert the values into the database
		$columns = implode(", ", array_keys($allParams));
		$values = implode("', '", array_values($allParams));
		$command = $connection->createCommand("REPLACE INTO questionnaire_fin_formation ($columns) VALUES ('$values')");

		$result = $command->queryAll();
		
		//var_dump($this->request->url);die();
        return $this->render('questionnaire-merci');
    }
}
