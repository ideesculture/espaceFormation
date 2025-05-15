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
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stagiaires-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Créer Stagiaire', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],
           // 'id',
            'nom:ntext',
            'prenom:ntext',
            'telephone:ntext',
            [
                'attribute' => 'user.email', 
                'label' => 'Adresse Email',
            ],
            [
                'label' => 'Organisation',
                'value' => function ($model) {
                    return $model->organisationNom;
                    },
            ],
            'email2:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Stagiaires $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
