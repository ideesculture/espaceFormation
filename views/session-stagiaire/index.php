<?php

use app\models\SessionStagiaire;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\SessionStagiaireSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Session Stagiaires';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="session-stagiaire-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Session Stagiaire', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'session_id',
            'stagiaire_id',
            'present_demij1',
            'present_demij2',
            //'present_demij3',
            //'present_demij4',
            //'present_demij5',
            //'present_demij6',
            //'present_demij7',
            //'present_demij8',
            //'present_demij9',
            //'present_demij10',
            //'reponses_questionnaire_niveau_initial_json:ntext',
            //'reponses_questionnaire_niveau_final_json:ntext',
            //'reponses_satisfaction_json:ntext',
            //'stagiaire_hors_convention_auditeur_libre',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SessionStagiaire $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
