<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SessionStagiaire $model */

$this->title = 'Ajouter un stagiaire à la session';
// $this->params['breadcrumbs'][] = ['label' => 'Session Stagiaires', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="session-stagiaire-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


<!-- --------------------------------- JAVASCRIPT ------------------------------- -->
<script> 
        // Assurez-vous de personnaliser les ID et les routes selon votre application
        document.getElementById('organisation_id').addEventListener('change', function () {
            var organisationId = this.value;

            fetch('/session-stagiaire/charger-stagiaires?organisationId=' + organisationId)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('stagiaire-container').innerHTML = data;
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des stagiaires:', error);
                });
        });
    </script>
<!-- ----------------------------------------------------------------------------- -->

</div>
