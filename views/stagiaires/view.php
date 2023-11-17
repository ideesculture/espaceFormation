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
    <?php $user = Yii::$app->user->identity;
        if ($user && $user->role === 'admin'): ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Etes-vous sûre de vouloir supprimer ?',
                'method' => 'post',
            ],
        ]) ?>  <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nom:ntext',
            'prenom:ntext',
            'email2:ntext',
            'telephone:ntext',
            'historique_sessions:ntext',
            'derniere_version_reglement_interieur_accepte:ntext',
            'derniere_version_cgv_acceptee:ntext',
            'derniere_version_cgu_acceptee:ntext',
        ],
    ]) ?>

</div>
