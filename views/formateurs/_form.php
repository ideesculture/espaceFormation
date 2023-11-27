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

                    <!-- Champs pour le modèle Formateurs -->
                    <div class="mb-3">
                        <?= $form->field($model, 'nom')->textInput()->label('Nom') ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'prenom')->textInput()->label('Prénom') ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'liste_diplome')->textarea(['rows' => 4])->label('Liste des diplômes') ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'numero_decl_activite')->textInput()->label('Numéro de déclaration d\'activité') ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'qualiopi')->textInput()->label('Qualiopi') ?>
                    </div>

                </div>
                <div class="col-md-6">

                    <!-- Champs pour le modèle User -->
                    <!-- <div class="mb-3">
                    $form->field($userModel, 'email')->textInput()->label('Email') ?>
                    </div>
                    <div class="mb-3">
                     $form->field($userModel, 'password')->passwordInput()->label('Mot de passe') ?>
                    </div> -->

                    <div class="mb-3">
                        <?= $form->field($model, 'siret')->textInput()->label('Siret') ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'adresse')->textarea(['rows' => 4])->label('Adresse') ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'chemin_cv')->textInput()->label('Chemin CV') ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($uploadFormModel, 'uploadedCV')->fileInput()->label('CV') ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'attestation_assurance_url')->textInput()->label('Attestation assurance') ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($uploadFormModel, 'pdfFile')->fileInput()->label('PDF') ?>
                    </div>
                </div>
            </div>

            <d  iv class="form-group mt-4 text-center">
                <?= Html::submitButton('Sauvegarder', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>