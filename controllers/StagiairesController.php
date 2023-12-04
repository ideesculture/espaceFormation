<?php

namespace app\controllers;

use app\models\Organisations;
use app\models\Stagiaires;
use app\models\StagiairesSearch;
use app\models\SessionStagiaire;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * StagiairesController implements the CRUD actions for Stagiaires model.
 */
class StagiairesController extends Controller
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
                            $user = Yii::$app->user->identity;
                            return $user->role === 'admin' || ($user->role === 'stagiaire' && $this->isOwnProfile());
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

    protected function isOwnProfile()
    {
        $userIdInUrl = Yii::$app->request->get('id');
        $user = Yii::$app->user->identity;
        $stagiaireId = $user->stagiaire->id;
        return $userIdInUrl !== null && $userIdInUrl == $stagiaireId;
    }

    public function actionMesFormations()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role !== 'stagiaire') {
            return $this->goHome();
        }
        // Récupére user connecté
        $user = User::findOne(Yii::$app->user->id);
        // Récup Le stagiaire associé
        $stagiaire = $user->stagiaire;
        $sessions = [];
        $formations = [];

        if ($user->role === 'stagiaire') {
            $stagiaire = $user->stagiaire;

            if ($stagiaire !== null) {

                $sessionsStagiaire = $stagiaire->sessionStagiaires;
                if (!empty($sessionsStagiaire)) {
                    foreach ($sessionsStagiaire as $sessionStagiaire) {
                        if ($sessionStagiaire->session0 !== null) {
                            $formation = $sessionStagiaire->session0->formationrel;
                            // Stocke les sessions et formations dans des tableaux
                            $sessions[] = $sessionStagiaire->session0;
                            $formations[] = $formation;
                        }
                    }
                }
            }
        }
        return $this->render('mes-formations', [
            'sessions' => $sessions,
            'formations' => $formations,
        ]);
    }

    /**
     * Lists all Stagiaires models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StagiairesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Stagiaires model.
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
     * Creates a new Stagiaires model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Stagiaires();
        $userModel = new User();


        if ($model->load(Yii::$app->request->post()) && $userModel->load(Yii::$app->request->post())) {

            // Valide et sauvegarde l'utilisateur
            $userModel->password = Yii::$app->security->generatePasswordHash($userModel->password);
            $userModel->role = 'stagiaire';
            if ($userModel->validate() && $userModel->save()) {

                // Associe le modèle User au modèle stagiaire
                $model->user_id = $userModel->id;

                // Valide et sauvegarde le stagiaire
                if ($model->validate() && $model->save()) {
                    Yii::$app->session->setFlash('success', 'Stagiaire créé avec Succès !');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Erreur lors de l\'enregistrement du stagiaire.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Erreur lors de l\'enregistrement de l\'utilisateur.');
            }
        }
        return $this->render('create', [
            'model' => $model,
            'userModel' => $userModel
        ]);
    }

    /**
     * Updates an existing Stagiaires model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $userModel = $model->user;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $userModel->load($this->request->post())) {

                // Vérifie si les modif sont sur le user
                $userAttributesChanged = $userModel->isAttributeChanged('email') || $userModel->isAttributeChanged('password');
                // Si oui alors on save
                if ($userAttributesChanged) {
                    $userModel->password = Yii::$app->security->generatePasswordHash($userModel->password);
                    if (!$userModel->save()) {
                        Yii::$app->session->setFlash('error', 'Erreur lors de la mise à jour de l\'utilisateur.');
                        return $this->render('update', ['model' => $model]);
                    }
                }

                // Save modèle Stagiaire
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Stagiaire mis à jour avec succès.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Erreur lors de la mise à jour du stagiaire.');
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'userModel' => $userModel,
        ]);
    }

    /**
     * Deletes an existing Stagiaires model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $user = $model->user;
        if ($this->request->isPost) {
            //On supprime les sessions pour la contriante de clé étrangère
            SessionStagiaire::deleteAll(['stagiaire_id' => $model->id]);
            if ($user) {
                $user->delete();
            }
            $model->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Stagiaires model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Stagiaires the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stagiaires::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
