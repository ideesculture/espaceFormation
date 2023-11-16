<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Sessions $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sessions-view">

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
            'formation',
            'centre',
            'debut',
            'fin',
            'contact_structure_ou_entreprise_nom:ntext',
            'contact_structure_ou_entreprise_prenom:ntext',
            'contact_structure_ou_entreprise_email:ntext',
            'contact_financeur_nom:ntext',
            'contact_financeur_prenom:ntext',
            'contact_financeur_email:ntext',
            'adresse_structure_ou_entreprise:ntext',
            'siret_structure_ou_entreprise:ntext',
            'plan_de_formation:ntext',
            'questionnaire_satisfaction_formateur:ntext',
        ],
    ]) ?>

</div>
