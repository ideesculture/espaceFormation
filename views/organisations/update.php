<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Organisations $model */

$this->title = 'Modifier Organisation: ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Organisations', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="organisations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
