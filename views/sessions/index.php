<?php

use app\models\Sessions;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\SessionsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sessions' ;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sessions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php
        $user = Yii::$app->user->identity;
        if ($user && $user->role !== 'stagiaire'): ?>
       <?= Html::a('Create Sessions', ['create'], ['class' => 'btn btn-success']) ?>
       <?php endif; ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                "attribute" => "formation_id",
                "value" =>'formationrel.name'
            ],
            [
                "attribute" => "centre_id",
                "value" =>'centrerel.name'
            ],
            'debut',
            'fin',
            //'contact_structure_ou_entreprise_nom:ntext',
            //'contact_structure_ou_entreprise_prenom:ntext',
            //'contact_structure_ou_entreprise_email:ntext',
            //'contact_financeur_nom:ntext',
            //'contact_financeur_prenom:ntext',
            //'contact_financeur_email:ntext',
            //'adresse_structure_ou_entreprise:ntext',
            //'siret_structure_ou_entreprise:ntext',
            //'plan_de_formation:ntext',
            //'questionnaire_satisfaction_formateur:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Sessions $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
