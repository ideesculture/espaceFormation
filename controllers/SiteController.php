<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\UploadForm;
use app\models\ContactForm;
use app\models\ResetPasswordForm;
use yii\web\UploadedFile;
use app\models\User;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->pdfFile = UploadedFile::getInstance($model, 'pdfFile');
            $model->uploadedCV = UploadedFile::getInstance($model, 'uploadedCV');
            if ($model->upload()) {
                // Le fichier est téléchargé avec succès
                Yii::$app->session->setFlash('success', 'Fichier téléchargé avec succès!');

                return $this->redirect(['site/upload']);
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $role = '';

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $role = Yii::$app->user->identity->role;
            //redirection selon le role
            switch ($role) {
                case 'stagiaire':
                    return $this->redirect(['stagiaires/mes-formations']);
                case 'formateur':
                    return $this->redirect(['formateurs/mes-formations']);
                case 'admin':
                    return $this->goHome();
                default:
                    return $this->goBack();
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Demande de réinitialisation de mot de passe
     */
    public function actionRequestPasswordReset()
    {
        $model = new \app\models\PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->sendPasswordResetEmail()) {
            Yii::$app->session->setFlash('success', 'Vérifiez votre boîte de réception pour les instructions de réinitialisation du mot de passe.');
            return $this->goHome();
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }


    /**
     * Reset User password.
     *
     * @param string $token The password reset token
     * @return string|Response
     */
    public function actionResetPassword($token)
    {
        $model = new ResetPasswordForm(['token' => $token]);
        $user = User::findByPasswordResetToken($token);
    
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
    
            if ($user === null) {
                Yii::$app->session->setFlash('error', 'Le lien de réinitialisation du mot de passe est expiré ou invalide.');
            } else {
                Yii::$app->session->setFlash('success', 'Votre mot de passe a été réinitialisé avec succès.');
            }
    
            return $this->redirect(['site/login']); // Redirige l'utilisateur vers la page de connexion
        }
    
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }


}

