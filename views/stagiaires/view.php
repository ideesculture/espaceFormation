<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Stagiaires $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Stagiaires', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="stagiaires-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nom:ntext',
            'prenom:ntext',
            'email:ntext',
            'email2:ntext',
            'telephone:ntext',
            'historique_sessions:ntext',
            'password:ntext',
            'derniere_version_reglement_interieur_accepte:ntext',
            'derniere_version_cgv_acceptee:ntext',
            'derniere_version_cgu_acceptee:ntext',
        ],
    ]) ?>

</div>
