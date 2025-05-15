<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\FormationSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="formations-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'prerequis') ?>

    <?= $form->field($model, 'objectif1') ?>

    <?= $form->field($model, 'objectif2') ?>

    <?php // echo $form->field($model, 'objectif3') ?>

    <?php // echo $form->field($model, 'objectif4') ?>

    <?php // echo $form->field($model, 'objectif5') ?>

    <?php // echo $form->field($model, 'objectif6') ?>

    <?php // echo $form->field($model, 'objectif7') ?>

    <?php // echo $form->field($model, 'objectif8') ?>

    <?php // echo $form->field($model, 'objectif9') ?>

    <?php // echo $form->field($model, 'objectif10') ?>

    <?php // echo $form->field($model, 'nbmax') ?>

    <?php // echo $form->field($model, 'url_planformation') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Recherche'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Réinitialiser'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
