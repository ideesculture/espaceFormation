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

    /**
     * Creates a new Formateurs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     * @throws \Exception en cas d'échec de la transaction
     */
    public function actionCreate()
    {
        $model = new Formateurs();
        $userModel = new User();
        $uploadFormModel = new UploadForm();

        //Mise en place d'une transaction pour ne pas créer le User si erreur sur la création du formateur.
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if ($this->request->isPost) {
                $model->load($this->request->post());
                $userModel->load($this->request->post());
                $userModel->password = Yii::$app->security->generatePasswordHash($userModel->password);
                $userModel->role = 'formateur';

                // Valide et sauvegarde l'utilisateur
                if (!$userModel->validate() || !$userModel->save()) {
                    throw new \Exception('Erreur lors de la validation ou de la sauvegarde de l\'utilisateur.');
                }

                // Associe le modèle User au modèle Formateurs
                $model->user_id = $userModel->id;

                // Valide et sauvegarde le formateur
                if (!$model->validate() || !$model->save()) {
                    throw new \Exception('Erreur lors de la validation ou de la sauvegarde du formateur.');
                }

                // Crée un sous-dossier pour chaque formateur avec son ID
                $uploadDir = 'uploads/formateurs/' . $model->id;
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Upoad PDF et récupération du lien
                $uploadFormModel->pdfFile = UploadedFile::getInstance($uploadFormModel, 'pdfFile');
                $uploadFormModel->uploadedCV = UploadedFile::getInstance($uploadFormModel, 'uploadedCV');

                if ($uploadFormModel->upload($uploadDir)) {
                    if ($uploadFormModel->pdfFile !== null) {
                        $model->attestation_assurance_url = $uploadDir . '/' . $uploadFormModel->pdfFile->baseName . '.' . $uploadFormModel->pdfFile->extension;
                    }
                    if ($uploadFormModel->uploadedCV !== null) {
                        $model->chemin_cv = $uploadDir . '/' . $uploadFormModel->uploadedCV->baseName . '.' . $uploadFormModel->uploadedCV->extension;
                    }
                }

                // Sauvegarde le modèle Formateurs avec les chemins des pdf
                if (!$model->save()) {
                    throw new \Exception('Erreur lors de la sauvegarde du modèle Formateurs après ajout des chemins complets.');
                }

                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Formateur créé avec succès!');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('error', $e->getMessage());
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

        // Sauvegarde des anciens chemins pour les PDF
        $oldAttestationUrl = $model->attestation_assurance_url;
        $oldCVUrl = $model->chemin_cv;

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $userModel->load($this->request->post());
            $uploadFormModel->pdfFile = UploadedFile::getInstance($uploadFormModel, 'pdfFile');
            $uploadFormModel->uploadedCV = UploadedFile::getInstance($uploadFormModel, 'uploadedCV');

            // Vérifie si les modifs sont sur les champs user
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

                // Traitement des fichiers PDF et CV
                $uploadDir = 'uploads/formateurs/' . $model->id;
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $pdfUploadFormModel = new UploadForm();
                $pdfUploadFormModel->pdfFile = $uploadFormModel->pdfFile;
                if ($pdfUploadFormModel->pdfFile) {
                    $pdfUploadFormModel->upload($uploadDir);
                    $model->attestation_assurance_url = $uploadDir . '/' . $pdfUploadFormModel->pdfFile->baseName . '.' . $pdfUploadFormModel->pdfFile->extension;
                    // Supprime l'ancien fichier PDF
                    if (!empty($oldAttestationUrl) && file_exists($oldAttestationUrl)) {
                        unlink($oldAttestationUrl);
                    }
                }

                $cvUploadFormModel = new UploadForm();
                $cvUploadFormModel->uploadedCV = $uploadFormModel->uploadedCV;
                if ($cvUploadFormModel->uploadedCV) {
                    $cvUploadFormModel->upload($uploadDir);
                    $model->chemin_cv = $uploadDir . '/' . $cvUploadFormModel->uploadedCV->baseName . '.' . $cvUploadFormModel->uploadedCV->extension;
                    // Supprime l'ancien fichier CV
                    if (!empty($oldCVUrl) && file_exists($oldCVUrl)) {
                        unlink($oldCVUrl);
                    }
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
        $attestationUrl = $model->attestation_assurance_url;
        $cvUrl = $model->chemin_cv;

        // Suppression du modèle Formateurs et user associé
        $model->delete();
        $model->user->delete();

        // Suppression des dossiers et fichiers
        if (!empty($attestationUrl) && file_exists($attestationUrl)) {
            unlink($attestationUrl);
            $this->deleteDirectory(dirname($attestationUrl));
        }
        if (!empty($cvUrl) && file_exists($cvUrl)) {
            unlink($cvUrl);
            $this->deleteDirectory(dirname($cvUrl));
        }

        Yii::$app->session->setFlash('success', 'Formateur supprimé avec succès.');
        return $this->redirect(['index']);
    }

    /**
     * Supprime un dossier et son contenu récursivement.
     * @param string $dir Le chemin du dossier à supprimer.
     */
    private function deleteDirectory($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir . "/" . $object)) {
                        $this->deleteDirectory($dir . "/" . $object);
                    } else {
                        unlink($dir . "/" . $object);
                    }
                }
            }
            rmdir($dir);
        }
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
        $filePath = Yii::getAlias('@webroot') . '/' . $model->attestation_assurance_url;

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

    public function actionMesFormations()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $user = User::findOne(Yii::$app->user->id);
        $formateur = $user->formateur;
        $sessions = [];
        $formations = [];

        if ($user->role === 'formateur' && $formateur !== null) {
            $sessionsFormateur = $formateur->sessionFormateurs;

            if (!empty($sessionsFormateur)) {
                foreach ($sessionsFormateur as $sessionFormateur) {
                    if ($sessionFormateur->session !== null) {
                        $formation = $sessionFormateur->session->formationrel;

                        // Stocke les sessions et formations dans des tableaux
                        $sessions[] = $sessionFormateur->session;
                        $formations[] = $formation;
                    }
                }
            }
        }

        return $this->render('mes-formations', [
            'sessions' => $sessions,
            'formations' => $formations,
        ]);
    }

}
