<?php

namespace app\controllers;

use app\models\Formateurs;
use app\models\FormateursSearch;
use app\models\UploadForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;

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
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $user = Yii::$app->user->identity;
                            return $user->role === 'admin' || $user->role === 'formateur';
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
        $uploadFormModel = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $userModel->load(Yii::$app->request->post());

            // Valide et sauvegarde l'utilisateur
            $userModel->password = Yii::$app->security->generatePasswordHash($userModel->password);
            $userModel->role = 'formateur';

            if ($userModel->validate() && $userModel->save()) {
                // Associe le modèle User au modèle Formateurs
                $model->user_id = $userModel->id;

                // Upoad PDF et récupération du lien
                $uploadFormModel->pdfFile = UploadedFile::getInstance($uploadFormModel, 'pdfFile');
                $uploadFormModel->uploadedCV = UploadedFile::getInstance($uploadFormModel, 'uploadedCV');

                if ($uploadFormModel->upload()) {
                    if ($uploadFormModel->pdfFile !== null) {
                        $model->attestation_assurance_url = 'uploads/formateurs/' . $uploadFormModel->pdfFile->baseName . '.' . $uploadFormModel->pdfFile->extension;
                    }
                    if ($uploadFormModel->uploadedCV !== null) {
                        $model->chemin_cv = 'uploads/formateurs/' . $uploadFormModel->uploadedCV->baseName . '.' . $uploadFormModel->uploadedCV->extension;
                    }
                }

                // Valide et sauvegarde le formateur
                if ($model->validate() && $model->save()) {
                    Yii::$app->session->setFlash('success', 'Formateur créé avec succès!');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Erreur lors de la validation du formateur.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Erreur lors de l\'enregistrement de l\'utilisateur.');
            }
        }

        return $this->render('create', [
            'model' => $model,
            'userModel' => $userModel,
            'uploadFormModel' => $uploadFormModel,
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
        $uploadFormModel = new UploadForm();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $userModel->load($this->request->post());
            $uploadFormModel->pdfFile = UploadedFile::getInstance($uploadFormModel, 'pdfFile');
            $uploadFormModel->uploadedCV = UploadedFile::getInstance($uploadFormModel, 'uploadedCV');

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

                if ($uploadFormModel->pdfFile) {
                    $uploadFormModel->upload();
                    $model->attestation_assurance_url = 'uploads/formateurs/' . $uploadFormModel->pdfFile->baseName . '.' . $uploadFormModel->pdfFile->extension;
                }

                // Si un fichier CV est chargé, effectue le traitement
                if ($uploadFormModel->uploadedCV) {
                    $uploadFormModel->upload();
                    $model->chemin_cv = 'uploads/formateurs/' . $uploadFormModel->uploadedCV->baseName . '.' . $uploadFormModel->uploadedCV->extension;
                }

                $model->save();

                Yii::$app->session->setFlash('success', 'Formateur mis à jour avec succès.');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Erreur lors de la mise à jour du formateur.');
            }
        }

        return $this->render('update', [
            'model' => $model,
            'userModel' => $userModel,
            'uploadFormModel' => $uploadFormModel,
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
        $user = $model->user;

        // Supprimer les fichiers PDF et CV associés
        $pdfFilePath = 'uploads/formateurs/' . $model->attestation_assurance_url;
        $cvFilePath = 'uploads/formateurs/' . $model->chemin_cv;

        // if (file_exists($pdfFilePath)) {
        //     unlink($pdfFilePath);
        // }

        // if (file_exists($cvFilePath)) {
        //     unlink($cvFilePath);
        // }


        if ($user) {
            $user->delete();
        }

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

    public function actionDownload($id)
{
    $model = $this->findModel($id);
    $filePath = Yii::getAlias('@webroot').'/'.$model->attestation_assurance_url;

    if (file_exists($filePath)) {
        Yii::$app->response->sendFile($filePath)->send();
    } else {
        Yii::$app->session->setFlash('error', 'Le fichier PDF n\'existe pas.');
        return $this->redirect(['view', 'id' => $id]);
    }
}

public function actionDownloadCv($id)
{
    $model = $this->findModel($id);
    $filePath = Yii::getAlias('@webroot') . '/' . $model->chemin_cv;

    if (file_exists($filePath)) {
        Yii::$app->response->sendFile($filePath)->send();
    } else {
        throw new NotFoundHttpException('Le fichier CV n\'existe pas.');
    }
}


}
