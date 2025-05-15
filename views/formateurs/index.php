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
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formateurs-index">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <p>
        <?php $user = Yii::$app->user->identity;
        if ($user && $user->role === 'admin'): ?>
            <?= Html::a('Créer Formateurs', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
         //   ['class' => 'yii\grid\SerialColumn'],
         [
            'label' => 'Adresse Email',
            'value' => function (Formateurs $model) {
                return $model->user->email;
            },
        ],
          //  'id',
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