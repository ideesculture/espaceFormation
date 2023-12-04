<?php

use app\models\Centres;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Formations;
use app\models\SessionStagiaire;

/** @var yii\web\View $this */
/** @var app\models\Sessions $model */

$this->title = $model->formationrel->name . " - " . date("d/m/Y", strtotime($model->debut)) . " au " . date("d/m/Y", strtotime($model->fin));
// $this->params['breadcrumbs'][] = ['label' => 'Sessions', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sessions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
   <?php $user = Yii::$app->user->identity;
        if ($user && $user->role === 'admin'): ?>
        <?= Html::a('Modifier', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Supprimer', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Etes-vous sûr(e) de vouloir supprimer cet élément?',
                'method' => 'post',
            ],
        ]) ?> <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'formation_id',
                'value' => Formations::findOne(["id" => $model->formationrel])->name
            ],
            [
                'attribute' => 'centre_id',
                'value' => Centres::findOne(["id" => $model->centrerel])->name
            ],
            [
                'attribute' => 'debut',
                'value' => date("d/m/Y", strtotime($model->debut))
            ],
            [
                'attribute' => 'fin',
                'value' => date("d/m/Y", strtotime($model->fin))
            ],
            'contact_structure_ou_entreprise:ntext',
            'contact_structure_ou_entreprise_email:ntext',
            'contact_financeur:ntext',
            'contact_financeur_email:ntext',
            'adresse_structure_ou_entreprise:ntext',
            'siret_structure_ou_entreprise:ntext',
          //  'plan_de_formation:ntext',
          //  'questionnaire_satisfaction_formateur:ntext',

        ],
    ]);
    ?>

    <!-- Affichage du plan de formation -->
    <div class="pdf-container">
        <?php if (!empty( $model->formationrel->url_planformation)): ?>
            <div class="pdf-section">
            <h3>Plan de formation</h3>
                <iframe class="pdf-iframe" src="<?= $model->formationrel->url_planformation ?>" width="100%" height="600px"></iframe>
                <?php
                    // Vérifier si le fichier existe avant d'afficher le bouton
                    $filePath = Yii::getAlias('@webroot') . '/' . $model->formationrel->url_planformation;
                    if (file_exists($filePath)) {
                        echo Html::a('Télécharger le plan de formation', $model->formationrel->url_planformation, ['class' => 'btn btn-primary', 'target' => '_blank', 'download' => '']);
                    } else {
                        echo '<p>Aucun plan de formation disponible pour le téléchargement.</p>';
                    }
                ?>
            </div>
        <?php else: ?>
            <p>Aucun plan de formation disponible.</p>
        <?php endif; ?>
    </div> <?php

      // Affichage des Stagiaires inscrits à la session si Admin
    if ($user && $user->role === 'admin'): ?>
    <h1> Liste des stagiaires </h1>
    <a class="btn btn-primary" href="/index.php?r=session-stagiaire%2Fcreate&session_id=<?=$model->id?>">Ajouter un stagiaire</a>
    <ul>
        <?php
        foreach ($model->getSessionStagiaires()->all() as $response) {
            $sessionStagaire = SessionStagiaire::findOne($response["id"]);
            if ($sessionStagaire && $sessionStagaire->stagiaire0) {
                print "<li>" . $sessionStagaire->stagiaire0->getDisplayName() . '<a href="/index.php?r=session-stagiaire%2Fdelete&amp;id='.$response["id"].'" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Êtes-vous sûr(e) de vouloir supprimer cet élément ?" data-method="post"><svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:.875em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0048 48h288a48 48 0 0048-48V128H32zm272-256a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zM432 32H312l-9-19a24 24 0 00-22-13H167a24 24 0 00-22 13l-9 19H16A16 16 0 000 48v32a16 16 0 0016 16h416a16 16 0 0016-16V48a16 16 0 00-16-16z"></path></svg></a></li>';
            }   
        } endif; ?> 
    </ul>

</div>