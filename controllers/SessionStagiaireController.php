<?php

namespace app\controllers;

use app\models\SessionStagiaire;
use app\models\SessionStagiaireSearch;
use app\models\Stagiaires;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * SessionStagiaireController implements the CRUD actions for SessionStagiaire model.
 */
class SessionStagiaireController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->role === 'admin';
                        },
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
     * Lists all SessionStagiaire models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SessionStagiaireSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SessionStagiaire model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SessionStagiaire model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SessionStagiaire();
    
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
            
                $sessionId = $model->session_id;
    
                // Récupérer les ID des stagiaires cochés
                $selectedStagiaires = $this->request->post('selectedStagiaires');
                if (!empty($selectedStagiaires)) {
                    foreach ($selectedStagiaires as $stagiaireId) {
                        // Vérifie si le stagiaire n'est pas déjà associé à cette session
                        $existingAssociation = SessionStagiaire::findOne(['session_id' => $model->session_id, 'stagiaire_id' => $stagiaireId]);
            
                        if ($existingAssociation === null) {
                            // Le stagiaire n'est pas déjà associé, on peut l'ajouter
                            $sessionStagiaire = new SessionStagiaire();
                            $sessionStagiaire->session_id = $model->session_id;
                            $sessionStagiaire->stagiaire_id = $stagiaireId;
                            $sessionStagiaire->save();
                        }
                    }
                }
            
                return $this->redirect(['/sessions/view', 'id' => $sessionId]);
            }
        } else {
            $sessionId = Yii::$app->request->get('session_id');
    
            $model->loadDefaultValues();
            $model->setAttribute("session_id", $sessionId);
        }
    
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SessionStagiaire model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SessionStagiaire model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $sessionId = $this->findModel($id)->session_id;
        $this->findModel($id)->delete();

        return $this->redirect(['/sessions/view', 'id' => $sessionId]);
    }

    /**
     * Finds the SessionStagiaire model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SessionStagiaire the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SessionStagiaire::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Méthode pour charger les stagiaires d'une entrerise non inscrit à la session en cours
     */
    public function actionChargerStagiaires($organisationId)
    {
        // Récupérer la liste des stagiaires de l'organisation qui ne sont pas inscrits à la session
        $stagiaires = Stagiaires::find()
            ->where(['organisation_id' => $organisationId])
            ->all();

        return $this->renderAjax('_dropdown_stagiaires', [
            'stagiaires' => $stagiaires,
        ]);
    }
}
