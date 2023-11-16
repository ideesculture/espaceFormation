<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Formateurs $model */

$this->title = 'Update Formateurs: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Formateurs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="formateurs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userModel' => $userModel,
    ]) ?>

</div>
