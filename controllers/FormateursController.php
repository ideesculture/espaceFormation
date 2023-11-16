<?php

namespace app\controllers;

use app\models\Formateurs;
use app\models\FormateursSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use Yii;

/**
 * FormateursController implements the CRUD actions for Formateurs model.
 */
class FormateursController extends Controller
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
     * Lists all Formateurs models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FormateursSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Formateurs model.
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

    public function actionCreate()
    {
        $model = new Formateurs();
        $userModel = new User();

        if ($model->load(Yii::$app->request->post()) && $userModel->load(Yii::$app->request->post())) {
        
            // Valide et sauvegarde l'utilisateur
            $userModel->password = Yii::$app->security->generatePasswordHash($userModel->password);
            $userModel->role = 'formateur';
            if ($userModel->validate() && $userModel->save()) {
                
                // Associe le modèle User au modèle Formateurs
                $model->user_id = $userModel->id;
    
                // Valide et sauvegarde le formateur
                if ($model->validate() && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Erreur lors de l\'enregistrement du formateur.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Erreur lors de l\'enregistrement de l\'utilisateur.');
            }
        }
        return $this->render('create', [
            'model' => $model,
            'userModel' => $userModel,
        ]);
    }

    /**
     * Updates an existing Formateurs model.
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
    
                // Vérifie si les modif sont user
                $userAttributesChanged = $userModel->isAttributeChanged('email') || $userModel->isAttributeChanged('password');
                // Si oui alors on save
                if ($userAttributesChanged) {
                    $userModel->password = Yii::$app->security->generatePasswordHash($userModel->password);
                    if (!$userModel->save()) {
                        Yii::$app->session->setFlash('error', 'Erreur lors de la mise à jour de l\'utilisateur.');
                        return $this->render('update', ['model' => $model]);
                    }
                }
    
                // Save modèle Formateurs
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Formateur mis à jour avec succès.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Erreur lors de la mise à jour du formateur.');
                }
            }
        }
    
        return $this->render('update', [
            'model' => $model,
            'userModel' => $userModel,
        ]);
    }


    /**
     * Deletes an existing Formateurs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        // On récupère le User et on le supprime
        $user = $model->user;  
          
        if ($user) {

            $user->delete();
        }
        // puis on Supprime le formateur
        $model->delete();
    
        return $this->redirect(['index']);
    }


    /**
     * Finds the Formateurs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Formateurs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Formateurs::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
