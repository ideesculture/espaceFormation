<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Organisations $model */

$this->title = 'Create Organisations';
$this->params['breadcrumbs'][] = ['label' => 'Organisations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organisations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
