<?php
use yii\helpers\Html;

/** @var $session \app\models\Sessions */
/** @var $stagiaire \app\models\Stagiaires */
/** @var $formation \app\models\Formations */
/** @var $formateur \app\models\Formateurs */

?>

<div style="max-width: 1000px; margin: 30px auto; padding: 20px; border: 2px solid black;">
    <img src="<?= Yii::getAlias('@web') ?>/images/logo2.png" style="height: 80px;">
    <h1 style="text-align: center;">Attestation de formation</h1>

    <p>
        Je, soussigné <?= Html::encode($formateur->prenom) ?> <?= Html::encode($formateur->nom) ?>,
        <?= Html::encode($formateur->poste) ?>
        <?= (in_array(strtolower(Html::encode($formateur->organisation)[0]), ['a','e','i','o','u','y'])) ? "d'" : "de " ?><strong><?= Html::encode($formateur->organisation) ?></strong>,
        atteste que <strong><?= Html::encode($stagiaire->nom) ?> <?= Html::encode($stagiaire->prenom) ?></strong>
        a participé à la formation intitulée 
        "<?= Html::encode($formation->name) ?>" 
        qui a eu lieu du <?= Yii::$app->formatter->asDate($session->debut) ?>
        au <?= Yii::$app->formatter->asDate($session->fin) ?>. <em><small>(<?= Html::encode($session->precisions_rythme) ?>)</small></em>
    </p>

    <p>
        Engagés auprès de nos stagiaires pour leur offrir la meilleure des formations, nous souhaitons par ce document remercier <strong><?= Html::encode($stagiaire->nom) ?> <?= Html::encode($stagiaire->prenom) ?></strong>
        pour son assiduité et la qualité de son implication et de ses interventions durant la formation, qui restent les meilleurs gages d'acquisition de compétences que nous connaissons.
    </p>
    
    <p>
        Fait à Le Mans, le <?= Yii::$app->formatter->asDate($session->fin) ?>
    </p>


    <!-- Signatures -->
    <div style="margin-top: 80px; display: flex; justify-content: space-between;">

        <div style="text-align: right;">
            <p><strong>Pour <?= Html::encode($formateur->organisation) ?>,</strong></p>
            <p><?= Html::encode($formateur->nom) ?> <?= Html::encode($formateur->prenom) ?></p>
        </div>
        <?php if (!($formateur->prenom === 'Gautier' && $formateur->nom === 'MICHELIN')): ?>
            <div>
                <p><strong>Pour IdéesCulture,</strong></p>
                <p>Gautier Michelin</p>
            </div>
        <?php endif; ?>

    </div>
</div>

