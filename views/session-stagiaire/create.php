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


<?php $this->registerJsFile('/js/dropdown_stagiaires.js', ['depends' => [yii\web\JqueryAsset::class]]); ?>
</div>
