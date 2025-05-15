<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SessionsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sessions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'formation') ?>

    <?= $form->field($model, 'centre') ?>

    <?= $form->field($model, 'debut') ?>

    <?= $form->field($model, 'fin') ?>

    <?php // echo $form->field($model, 'contact_structure_ou_entreprise_nom') ?>

    <?php // echo $form->field($model, 'contact_structure_ou_entreprise_prenom') ?>

    <?php // echo $form->field($model, 'contact_structure_ou_entreprise_email') ?>

    <?php // echo $form->field($model, 'contact_financeur_nom') ?>

    <?php // echo $form->field($model, 'contact_financeur_prenom') ?>

    <?php // echo $form->field($model, 'contact_financeur_email') ?>

    <?php // echo $form->field($model, 'adresse_structure_ou_entreprise') ?>

    <?php // echo $form->field($model, 'siret_structure_ou_entreprise') ?>

    <?php // echo $form->field($model, 'plan_de_formation') ?>

    <?php // echo $form->field($model, 'questionnaire_satisfaction_formateur') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
