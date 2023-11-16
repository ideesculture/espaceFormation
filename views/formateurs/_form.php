<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Formateurs $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="formateurs-form">
    <?php $form = ActiveForm::begin(); ?>

    <!-- Champs pour le modèle Formateurs -->
    <?= $form->field($model, 'nom')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'prenom')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'chemin_cv')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'liste_diplome')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'numero_decl_activite')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'qualiopi')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'siret')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'adresse')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'attestation_assurance_url')->textarea(['rows' => 6]) ?>

    <!-- Champs pour le modèle User -->
    <?= $form->field($userModel, 'email')->textInput() ?>
    <?= $form->field($userModel, 'password')->passwordInput() ?>    


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
