<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Formateurs $model */

\yii\web\YiiAsset::register($this);
$this->title = $model->getDisplayName();

?>
<div class="formateurs-view">

    <h1 class="center-titre">
        <?= Html::encode($this->title) ?>
    </h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'user.email',
                'label' => 'Adresse Email',
            ],
            'nom:ntext',
            'prenom:ntext',
            //  'chemin_cv:ntext',
            //  'liste_diplome:ntext',
            'numero_decl_activite:ntext',
            'qualiopi:ntext',
            'siret:ntext',
            'adresse:ntext',
            // 'attestation_assurance_url:ntext',
        ],
    ]) ?>

<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
    <?= Html::a('Lister Diplômes', ['list-diplomes', 'id' => $model->id], ['class' => 'btn btn-warning mr-4']) ?>
    
    <?php $user = Yii::$app->user->identity; ?>
    <?php if ($user && ($user->role == 'admin')): ?>
        <?= Html::a('Supprimer', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger mr-2',
            'data' => [
                'confirm' => 'Etes-vous sûr(e) de vouloir supprimer cet élément?',
                'method' => 'post',
            ],
        ]) ?>
    <?php endif; ?>

    <?php if ($user && (($user->role == 'formateur') || ($user->role == 'admin'))): ?>
        <?= Html::a('Modifier', ['update', 'id' => $model->id], ['class' => 'btn btn-primary mr-4']) ?>
    <?php endif; ?>
</div>


    <div class="pdf-container">
        <?php if (!empty($model->attestation_assurance_url)): ?>
            <div class="pdf-section2">
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
            <div class="pdf-section2">
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