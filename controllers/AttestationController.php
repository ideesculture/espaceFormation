<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Attestation;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class AttestationController extends Controller
{
    public function actionView($session, $stagiaire)
{
    $sessionModel = \app\models\Sessions::findOne($session);
    $stagiaireModel = \app\models\Stagiaires::findOne($stagiaire);

    $formationModel = \app\models\Formations::findOne($sessionModel->formation_id);

    // Formateur : on prend le premier trouvé
    $sessionFormateur = \app\models\Sessionformateur::find()->where(['session_id' => $session])->one();
    $formateurModel = \app\models\Formateurs::findOne($sessionFormateur->formateur_id);

    return $this->render('view', [
        'session' => $sessionModel,
        'stagiaire' => $stagiaireModel,
        'formation' => $formationModel,
        'formateur' => $formateurModel,
    ]);
}



}



