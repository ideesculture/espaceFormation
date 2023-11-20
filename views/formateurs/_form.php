<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Formateurs $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="formateurs-form">
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>


<!-- Champ pour l'image -->
<?= $form->field($model, 'uploadedImage')->fileInput() ?>

    <!-- Champs pour le modèle Formateurs -->
    <?= $form->field($model, 'nom')->textInput() ?>
    <?= $form->field($model, 'prenom')->textInput() ?>

    <!-- Champs pour le modèle User -->
    <?= $form->field($userModel, 'email')->textInput() ?>
    <?= $form->field($userModel, 'password')->passwordInput() ?>
    
    <!-- Autres champs formateurs -->
    <?= $form->field($model, 'chemin_cv')->textInput() ?>
    <?= $form->field($model, 'liste_diplome')->textarea() ?>
    <?= $form->field($model, 'numero_decl_activite')->textInput() ?>
    <?= $form->field($model, 'qualiopi')->textInput() ?>
    <?= $form->field($model, 'siret')->textInput() ?>
    <?= $form->field($model, 'adresse')->textarea(['rows' => 4]) ?>
    <?= $form->field($model, 'attestation_assurance_url')->textInput() ?>

    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>