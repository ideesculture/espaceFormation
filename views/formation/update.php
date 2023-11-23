<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Formations $model */

$this->title = Yii::t('app', 'Update Formations: {name}', [
    'name' => $model->name,
]);
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Formations'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="formations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
