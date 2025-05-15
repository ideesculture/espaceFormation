<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SessionStagiaireSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="session-stagiaire-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'session_id') ?>

    <?= $form->field($model, 'stagiaire_id') ?>

    <?= $form->field($model, 'present_demij1') ?>

    <?= $form->field($model, 'present_demij2') ?>

    <?php // echo $form->field($model, 'present_demij3') ?>

    <?php // echo $form->field($model, 'present_demij4') ?>

    <?php // echo $form->field($model, 'present_demij5') ?>

    <?php // echo $form->field($model, 'present_demij6') ?>

    <?php // echo $form->field($model, 'present_demij7') ?>

    <?php // echo $form->field($model, 'present_demij8') ?>

    <?php // echo $form->field($model, 'present_demij9') ?>

    <?php // echo $form->field($model, 'present_demij10') ?>

    <?php // echo $form->field($model, 'reponses_questionnaire_niveau_initial_json') ?>

    <?php // echo $form->field($model, 'reponses_questionnaire_niveau_final_json') ?>

    <?php // echo $form->field($model, 'reponses_satisfaction_json') ?>

    <?php // echo $form->field($model, 'stagiaire_hors_convention_auditeur_libre') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
