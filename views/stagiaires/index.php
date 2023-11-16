<?php

use app\models\Stagiaires;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\StagiairesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Stagiaires';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stagiaires-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Stagiaires', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nom:ntext',
            'prenom:ntext',
            'email:ntext',
            'email2:ntext',
            //'telephone:ntext',
            //'historique_sessions:ntext',
            //'password:ntext',
            //'derniere_version_reglement_interieur_accepte:ntext',
            //'derniere_version_cgv_acceptee:ntext',
            //'derniere_version_cgu_acceptee:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Stagiaires $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
