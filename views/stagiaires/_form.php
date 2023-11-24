<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Stagiaires $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="stagiaires-form">

    <?php $form = ActiveForm::begin(); ?>

     <!-- Champs stagiaires -->
    <?= $form->field($model, 'nom')->textInput() ?>
    <?= $form->field($model, 'prenom')->textInput() ?>

    <!-- Champs pour le modèle User -->
    <?= $form->field($userModel, 'email')->textInput() ?>
    <?= $form->field($userModel, 'password')->passwordInput() ?>

    <!-- Autres champs stagiaires -->
    <?= $form->field($model, 'telephone')->textInput() ?>
    <?= $form->field($model, 'email2')->textInput() ?>
    <?= $form->field($model, 'historique_sessions')->textInput() ?>
    <?= $form->field($model, 'derniere_version_reglement_interieur_accepte')->textInput() ?>
    <?= $form->field($model, 'derniere_version_cgv_acceptee')->textInput() ?>
    <?= $form->field($model, 'derniere_version_cgu_acceptee')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Sauvegarder', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
