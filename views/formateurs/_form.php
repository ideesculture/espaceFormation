<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Formateurs $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="formateurs-form">
    <div class="card">
        <div class="card-body">

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

            <div class="row">
                <div class="col-md-6">
                    <!-- Champs pour le modèle User -->
                    <div class="mb-3">
                        <?= $form->field($userModel, 'email', ['labelOptions' => ['class' => 'required-label control-label']])
                        ->textInput()->label('Email') ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($userModel, 'password',['labelOptions' => ['class' => 'required-label control-label']])
                        ->passwordInput()->label('Mot de passe') ?>
                    </div>
                    <!-- Champs pour le modèle Formateurs -->
                    <div class="mb-3">
                        <?= $form->field($model, 'nom', ['labelOptions' => ['class' => 'required-label control-label']])
                        ->textInput()->label('Nom') ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'prenom',['labelOptions' => ['class' => 'required-label control-label']])
                        ->textInput()->label('Prénom') ?>
                    </div>
                    <div class="mb-3">

                        <?= $form->field($model, 'adresse')->textarea(['rows' => 4])->label('Adresse') ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'chemin_cv')->textInput(['disabled' => true])->label('URL du CV') ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($uploadFormModel, 'uploadedCV')->fileInput()->label('Curriculum vitæ (PDF, JPEG, PNG') ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <?= $form->field($model, 'liste_diplome')->textInput(['disabled' => true])->label('Liste des Diplômes (6 fichiers max)') ?>

                        <?= $form->field($uploadFormModel, 'listeDiplome[]')->fileInput(['multiple' => true])->label('Diplômes (PDF, JPEG, PNG)') ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'siret')->textInput()->label('Siret') ?>
                    </div>

                    <div class="mb-3">
                        <?= $form->field($model, 'qualiopi')->textInput()->label('Qualiopi') ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'numero_decl_activite')->textInput()->label('Numéro de déclaration d\'activité') ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'attestation_assurance_url')->textInput(['disabled' => true])->label('URL Attestation assurance') ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($uploadFormModel, 'pdfFile')->fileInput()->label('Attestation d\'assurance (PDF, JPEG, PNG)') ?>
                    </div>
                </div>
            </div>

            <div class="form-group mt-4 text-center">
                <?= Html::submitButton('Sauvegarder', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>