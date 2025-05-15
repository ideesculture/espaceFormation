<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Sessions $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sessions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'formation')->textInput() ?>

    <?= $form->field($model, 'centre')->textInput() ?>

    <?= $form->field($model, 'debut')->textInput() ?>

    <?= $form->field($model, 'fin')->textInput() ?>

    <?= $form->field($model, 'contact_structure_ou_entreprise_nom')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'contact_structure_ou_entreprise_prenom')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'contact_structure_ou_entreprise_email')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'contact_financeur_nom')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'contact_financeur_prenom')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'contact_financeur_email')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'adresse_structure_ou_entreprise')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'siret_structure_ou_entreprise')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'plan_de_formation')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'questionnaire_satisfaction_formateur')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Sauvegarder', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
