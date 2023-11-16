<?php

use app\models\Formateurs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FormateursSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Formateurs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formateurs-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Formateurs', ['create'], ['class' => 'btn btn-success']) ?>
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
            'chemin_cv:ntext',
            'liste_diplome:ntext',
            //'numero_decl_activite:ntext',
            'qualiopi:ntext',
            //'siret:ntext',
            //'adresse:ntext',
            //'attestation_assurance_url:ntext',
            [
                'attribute' => 'user.email', 
                'label' => 'Adresse Email',
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Formateurs $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
