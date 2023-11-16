<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\StagiairesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="stagiaires-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nom') ?>

    <?= $form->field($model, 'prenom') ?>

    <?= $form->field($model, 'email2') ?>

    <?php // echo $form->field($model, 'telephone') ?>

    <?php // echo $form->field($model, 'historique_sessions') ?>

    <?php // echo $form->field($model, 'derniere_version_reglement_interieur_accepte') ?>

    <?php // echo $form->field($model, 'derniere_version_cgv_acceptee') ?>

    <?php // echo $form->field($model, 'derniere_version_cgu_acceptee') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
