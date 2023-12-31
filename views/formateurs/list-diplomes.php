<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/**  @var app\models\Formateurs $model */
/**  @var array $diplomes */

$this->title = $model->getDisplayName();
\yii\web\YiiAsset::register($this);
?>

<div class="formateurs-list-diplomes">
    <h1>
        <?= Html::encode($this->title) ?>
    </h1>
    <p>
        <?= Html::a('Retour à la fiche formateur', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <h2>Liste des Diplômes :</h2>
    <div class="pdf-container">
        <?php if (!empty($diplomes)) : ?>
            <div class="pdf-flex">
                <?php foreach ($diplomes as $diplome) : ?>
                    <div class="pdf-section">
                        <div class="iframe-container">
                            <?= Html::a(Html::encode($diplome), [
                                'download-diplome', 'id' => $model->id, 'diplome' => $diplome,
                                'inline' => true
                            ], ['target' => '_blank']) ?>
                            <iframe class="pdf-iframe" src="<?= Yii::$app->request->baseUrl . '/' . $model->liste_diplome . '/' . $diplome ?>" width="100%" height="400px"></iframe>
                            <?= Html::a(
                                'Télécharger',
                                ['download-diplome', 'id' => $model->id, 'diplome' => $diplome, 'inline' => false],
                                ['class' => 'btn btn-success']
                            ) ?>
                            <?= Html::a('Supprimer', ['delete-diplome', 'id' => $model->id, 'diplome' => $diplome], [
                                'class' => 'btn btn-danger',
                                'data' => ['confirm' => 'Êtes-vous sûr de vouloir supprimer ce diplôme ?']
                            ]) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p>Aucun diplôme trouvé.</p>
        <?php endif; ?>
    </div>
</div>