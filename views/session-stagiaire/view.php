<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\SessionStagiaire $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Session Stagiaires', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="session-stagiaire-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Êtes-vous sûr(e) de vouloir supprimer cet élément ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'session_id',
            'stagiaire_id',
            'present_demij1',
            'present_demij2',
            'present_demij3',
            'present_demij4',
            'present_demij5',
            'present_demij6',
            'present_demij7',
            'present_demij8',
            'present_demij9',
            'present_demij10',
            'reponses_questionnaire_niveau_initial_json:ntext',
            'reponses_questionnaire_niveau_final_json:ntext',
            'reponses_satisfaction_json:ntext',
            'stagiaire_hors_convention_auditeur_libre',
        ],
    ]) ?>

</div>
