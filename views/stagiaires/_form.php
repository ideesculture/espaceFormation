<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Organisations;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Stagiaires $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="stagiaires-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Champs stagiaires -->
    <?= $form->field($model, 'nom',['labelOptions' => ['class' => 'required-label control-label']])->textInput() ?>
    <?= $form->field($model, 'prenom',['labelOptions' => ['class' => 'required-label control-label']])->textInput() ?>

    <!-- Champs pour le modèle User -->
    <?= $form->field($userModel, 'email',['labelOptions' => ['class' => 'required-label control-label']])->textInput() ?>
    <?= $form->field($userModel, 'password',['labelOptions' => ['class' => 'required-label control-label']])->passwordInput() ?>

    <!-- Autres champs stagiaires -->
    <?= $form->field($model, 'telephone')->textInput() ?>
    <?= $form->field($model, 'email2')->textInput() ?>
    <?= $form->field($model, 'historique_sessions')->textInput() ?>
    <?= $form->field($model, 'derniere_version_reglement_interieur_accepte')->textInput() ?>
    <?= $form->field($model, 'derniere_version_cgv_acceptee')->textInput() ?>
    <?= $form->field($model, 'derniere_version_cgu_acceptee')->textInput() ?>

    <?= $form->field($model, 'organisation_id')->dropDownList(
        ArrayHelper::map(Organisations::find()->all(), 'id', 'nom'),
        ['prompt' => 'Sélectionnez une organisation']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Sauvegarder', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
