<?php

namespace app\controllers;

use app\models\Formations;
use app\models\FormationSearch;
use app\models\UploadForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;
use Yii;

/**
 * FormationController implements the CRUD actions for Formations model.
 */
class FormationController extends Controller
{
    /**
     * @inheritDoc
     */public function behaviors()
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
     * Lists all Formations models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FormationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Formations model.
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
     * Creates a new Formations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Formations();
        $uploadFormModel = new UploadForm();
    
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                // Vérification de la sauvegarde du modèle Formations
                if ($model->save()) {
                    $uploadFormModel->planFormation = UploadedFile::getInstance($uploadFormModel, 'planFormation');
                    // Vérification de l'upload du fichier
                    if ($uploadFormModel->upload()) {
                        if ($uploadFormModel->planFormation !== null) {
                            $model->url_planformation = 'uploads/planFormation/' . $uploadFormModel->planFormation->baseName .
                                '.' . $uploadFormModel->planFormation->extension;
                            // Vérification de la sauvegarde après ajout de l'url_planformation
                            if ($model->save()) {
                                return $this->redirect(['view', 'id' => $model->id]);
                            } else {
                                Yii::$app->session->setFlash('error', 'Erreur lors de la sauvegarde du modèle Formations après ajout de l\'url_planformation.');
                            }
                        } else {
                            Yii::$app->session->setFlash('error', 'Fichier planFormation non trouvé.');
                        }
                    } else {
                        Yii::$app->session->setFlash('error', 'Erreur lors de l\'upload du fichier.');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Erreur lors de la sauvegarde du modèle Formations.');
                }
            }
        } else {
            $model->loadDefaultValues();
        }
    
        return $this->render('create', [
            'model' => $model,
            'uploadFormModel' => $uploadFormModel,
        ]);
    }
    

    /**
     * Updates an existing Formations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $uploadFormModel = new UploadForm();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'uploadFormModel' => $uploadFormModel,
        ]);
    }

    /**
     * Deletes an existing Formations model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Formations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Formations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Formations::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
