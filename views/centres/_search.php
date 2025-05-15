<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CentresSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="centres-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'lieu') ?>

    <?= $form->field($model, 'georeference') ?>

    <?= $form->field($model, 'url_lieu1') ?>

    <?php // echo $form->field($model, 'url_lieu2') ?>

    <?php // echo $form->field($model, 'url_lieu3') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
