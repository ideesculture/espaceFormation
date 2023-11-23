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

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <p>
        <?php $user = Yii::$app->user->identity;
        if ($user && ($user->role == 'admin')): ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Etes-vous sûre de vouloir supprimer ?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?php if ($user && (($user->role == 'formateur') || ($user->role == 'admin')  )): ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
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


    <div class="pdf-container">
        <?php if (!empty($model->attestation_assurance_url)): ?>
            <div class="pdf-section">
                <h3>Attestation Assurance</h3>
                <iframe class="pdf-iframe"
                    src="<?= Yii::$app->request->baseUrl . '/' . $model->attestation_assurance_url ?>" width="100%"
                    height="400px"></iframe>
                <?= Html::a('Télécharger l\'attestation d\'assurance', ['download', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </div>
        <?php else: ?>
            <p>Aucun fichier d'attestation d'assurance disponible.</p>
        <?php endif; ?>

        <?php if (!empty($model->chemin_cv)): ?>
            <div class="pdf-section">
                <h3>CV</h3>
                <iframe class="pdf-iframe" src="<?= Yii::$app->request->baseUrl . '/' . $model->chemin_cv ?>" width="100%"
                    height="400px"></iframe>
                    <?= Html::a('Télécharger le CV', ['download-cv', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

            </div>
        <?php else: ?>
            <p>Aucun CV disponible.</p>
        <?php endif; ?>
    </div>

</div>