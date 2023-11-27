<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Sessions $model */

$this->title = 'Créer Sessions';
$this->params['breadcrumbs'][] = ['label' => 'Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sessions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
