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

// Chargement des versions des CGU, CGV et règlement
$administratif_dir = __DIR__ .'/../_administratif';
if(is_file($administratif_dir.'/reglement/local/version.php')) {
	require $administratif_dir.'/reglement/local/version.php';
} else {
	require $administratif_dir.'/reglement/version.php';
}
if(is_file($administratif_dir.'/cgu/local/version.php')) {
	require $administratif_dir.'/cgu/local/version.php';
} else {
	require $administratif_dir.'/cgu/version.php';
}
if(is_file($administratif_dir.'/cgv/local/version.php')) {
	require $administratif_dir.'/cgv/local/version.php';
} else {
	require $administratif_dir.'/cgv/version.php';
}

/**
 * StagiairesAjaxController
 */
class StagiairesAjaxController extends Controller {

	public function actionReglement() {
		$userIdInUrl = Yii::$app->request->get('id');
		//$model = new Stagiaires();
		$stagiaire = Stagiaires::findOne($userIdInUrl);
		$stagiaire->reglement_valide_version =  __REGLEMENT_VERSION_MAJOR__.".".__REGLEMENT_VERSION_MINOR__;
		$stagiaire->reglement_valide_date = date('Y-m-d H:i:s');
		if($stagiaire->validate()) {
			$stagiaire->save();
			echo "done";
		}
		Yii::$app->end();
	}

	public function actionCgu() {
		$userIdInUrl = Yii::$app->request->get('id');
		//$model = new Stagiaires();
		$stagiaire = Stagiaires::findOne($userIdInUrl);
		$stagiaire->cgu_valide_version =  __CGU_VERSION_MAJOR__.".".__CGU_VERSION_MINOR__;
		$stagiaire->cgu_valide_date = date('Y-m-d H:i:s');
		if($stagiaire->validate()) {
			$stagiaire->save();
			echo "done";
		}
		Yii::$app->end();
	}

	public function actionCgv() {
		$userIdInUrl = Yii::$app->request->get('id');
		//$model = new Stagiaires();
		$stagiaire = Stagiaires::findOne($userIdInUrl);
		$stagiaire->cgv_valide_version =  __CGV_VERSION_MAJOR__.".".__CGV_VERSION_MINOR__;
		$stagiaire->cgv_valide_date = date('Y-m-d H:i:s');
		if($stagiaire->validate()) {
			$stagiaire->save();
			echo "done";
		}
		Yii::$app->end();
	}
}