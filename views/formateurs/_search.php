<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\FormateursSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="formateurs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nom') ?>

    <?= $form->field($model, 'prenom') ?>

    <?= $form->field($model, 'chemin_cv') ?>

    <?= $form->field($model, 'liste_diplome') ?>

    <?php // echo $form->field($model, 'numero_decl_activite') ?>

    <?php // echo $form->field($model, 'qualiopi') ?>

    <?php // echo $form->field($model, 'siret') ?>

    <?php // echo $form->field($model, 'adresse') ?>

    <?php // echo $form->field($model, 'attestation_assurance_url') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'email') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
