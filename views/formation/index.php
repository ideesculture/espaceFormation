<?php

use app\models\Formations;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FormationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Formations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Formations'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:ntext',
            'prerequis:ntext',
            'objectif1:ntext',
            'objectif2:ntext',
            //'objectif3:ntext',
            //'objectif4:ntext',
            //'objectif5:ntext',
            //'objectif6:ntext',
            //'objectif7:ntext',
            //'objectif8:ntext',
            //'objectif9:ntext',
            //'objectif10:ntext',
            //'nbmax',
            //'url_planformation:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Formations $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
