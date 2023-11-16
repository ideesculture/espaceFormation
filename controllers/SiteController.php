<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
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
                    return $this->redirect(['site/mes-formations']);
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
}
