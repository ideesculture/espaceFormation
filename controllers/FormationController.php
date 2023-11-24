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
            // Crée un sous-dossier avec l'ID de la formation
            $folderPath = 'uploads/planFormation/' . $model->id;
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            $uploadFormModel->planFormation = UploadedFile::getInstance($uploadFormModel, 'planFormation');

            // Vérification de l'upload du fichier
            if ($uploadFormModel->planFormation !== null && $uploadFormModel->upload($folderPath)) {
                // Enregistre le fichier dans le sous-dossier
                $uploadFormModel->planFormation->saveAs($folderPath . '/' . $uploadFormModel->planFormation->baseName .
                    '.' . $uploadFormModel->planFormation->extension);

                // Enregistre le chemin complet dans le modèle
                $model->url_planformation = $folderPath . '/' . $uploadFormModel->planFormation->baseName .
                    '.' . $uploadFormModel->planFormation->extension;

                // Sauvegarde à nouveau le modèle avec le chemin complet
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Formations créée avec succès!');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Erreur lors de la sauvegarde du modèle Formations après ajout de l\'url_planformation.');
                }
            } else {
                // pas de fichier, on sauvegarde
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Formations créée avec succès!');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Erreur lors de la sauvegarde du modèle Formations.');
                }
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
     * @param integer $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $uploadFormModel = new UploadForm();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            // Charge le fichier existant dans le modèle UploadForm
            $uploadFormModel->planFormation = UploadedFile::getInstance($uploadFormModel, 'planFormation');

            if ($model->save()) {
                // Vérifier s'il y a un fichier à télécharger
                if ($uploadFormModel->planFormation !== null) {
                    // Supprime le fichier existant s'il y en a un
                    if ($model->url_planformation) {
                        unlink(Yii::getAlias('@webroot') . '/' . $model->url_planformation);
                    }

                    // Crée un sous-dossier avec l'ID de la formation
                    $folderPath = 'uploads/planFormation/' . $model->id;
                    if (!is_dir($folderPath)) {
                        mkdir($folderPath, 0777, true);
                    }

                    // Télécharge le nouveau fichier dans le sous-dossier
                    if ($uploadFormModel->upload($folderPath)) {
                        $model->url_planformation = $folderPath . '/' . $uploadFormModel->planFormation->baseName .
                            '.' . $uploadFormModel->planFormation->extension;

                        // Sauvegarde le modèle après l'upload du fichier
                        if ($model->save()) {
                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {
                            Yii::$app->session->setFlash('error', 'Erreur lors de la sauvegarde du modèle Formations après ajout de l\'url_planformation.');
                        }
                    } else {
                        Yii::$app->session->setFlash('error', 'Erreur lors de l\'upload du fichier.');
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
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
        $model = $this->findModel($id);

        if ($model->url_planformation && file_exists(Yii::getAlias('@webroot') . '/' . $model->url_planformation)) {
            unlink(Yii::getAlias('@webroot') . '/' . $model->url_planformation);
        }

        // Supprimer le dossier s'il existe
        $folderPath = 'uploads/planFormation/' . $id;
        if (is_dir($folderPath)) {
            $this->removeDirectory($folderPath);
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Récursivement supprime un dossier et son contenu.
     * @param string $dir Chemin du dossier à supprimer
     */
    private function removeDirectory($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != '.' && $object != '..') {
                    if (is_dir($dir . '/' . $object)) {
                        $this->removeDirectory($dir . '/' . $object);
                    } else {
                        unlink($dir . '/' . $object);
                    }
                }
            }
            rmdir($dir);
        }
    }

    public function actionDownload($id)
    {
        $model = $this->findModel($id);
        $filePath = Yii::getAlias('@webroot') . '/' . $model->url_planformation;
    
        if (file_exists($filePath)) {
            return Yii::$app->response->sendFile($filePath, $model->name . '_plan_formation.pdf', ['inline' => false]); 
            // true pour affcher le document en ligne plutot que le télécharger
        } else {
            throw new NotFoundHttpException('Le fichier demandé n\'existe pas.');
        }
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
