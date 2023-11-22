<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Formateurs $model */

//$this->title = $model->nom;
//$this->params['breadcrumbs'][] = ['label' => 'Formateurs', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="formateurs-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p> 
    <?php $user = Yii::$app->user->identity;
        if ($user && ($user->role == 'admin')): ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Etes-vous sûre de vouloir supprimer ?',
                'method' => 'post',
            ],
        ]) ?> <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nom:ntext',
            'prenom:ntext',
            'chemin_cv:ntext',
            'liste_diplome:ntext',
            'numero_decl_activite:ntext',
            'qualiopi:ntext',
            'siret:ntext',
            'adresse:ntext',
            'attestation_assurance_url:ntext',
            'user_id',
        ],
    ]) ?>

</div>
