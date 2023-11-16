<?php

namespace app\controllers;

use app\models\Stagiaires;
use app\models\StagiairesSearch;
use app\models\SessionStagiaire;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use Yii;

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
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
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

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                // Crée un nouvel utilisateur avec les info entrées dans le stagiaire
                $user = new User();
                $user->email = $model->email;
                $user->password = Yii::$app->security->generatePasswordHash($model->password);
                $user->role = 'stagiaire';

                if ($user->validate()) {
                    $user->save();
                    // Associe le user_id du nouvel utilisateur au stagiaire
                    $model->user_id = $user->id;
                    // Valide et sauvegarde le stagiaire
                    if ($model->validate()) {
                        $model->save();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
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
        $user = $model->user;
        
      //TODO DEBUG UPDATE QUI NE MET PAS A JOUR L'EMAIL USER 
        if ($this->request->isPost) {
            // Avant la sauvegarde du modèle
            Yii::info('Model before save: ' . json_encode($model->attributes));
    
            //On charge les données du formulaire stagiaire et save
            if ($model->load($this->request->post()) && $model->save()) {
                // Après la sauvegarde du modèle
                Yii::info('Model after save: ' . json_encode($model->attributes));
    
                // On charge et save le User
                // Avant la sauvegarde de l'utilisateur
                Yii::info('User before save: ' . json_encode($user->attributes));
    
                if ($user->load($this->request->post())) {
                    $user->email = $model->email;
                    $user->password = Yii::$app->security->generatePasswordHash($user->password);
                    $user->save();
    
                    // Après la sauvegarde de l'utilisateur
                    Yii::info('User after save: ' . json_encode($user->attributes));
                }
    
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'user' => $user,
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
            $model->delete();
            $user->delete();
            return $this->redirect(['index']);
        }

        return $this->render('delete', [
            'model' => $model,
            'user' => $user,
        ]);
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
