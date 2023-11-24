<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Formations $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="formations-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name',['labelOptions' => ['class' => 'required-label control-label']])->textInput() ?>

    <?= $form->field($model, 'prerequis')->textInput() ?>

    <?= $form->field($model, 'objectif1')->textInput() ?>

    <?= $form->field($model, 'objectif2')->textInput() ?>

    <?= $form->field($model, 'objectif3')->textInput() ?>

    <?= $form->field($model, 'objectif4')->textInput() ?>

    <?= $form->field($model, 'objectif5')->textInput() ?>

    <?= $form->field($model, 'nbmax')->textInput() ?>

    <?= $form->field($model, 'url_planformation')->textInput() ?>
    <?= $form->field($uploadFormModel, 'planFormation')->fileInput() ?>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Sauvegarder'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

     <!-- Afficher les erreurs d'upload -->
     <?php if ($uploadFormModel->hasErrors()): ?>
        <div class="alert alert-danger">
            <?= $form->errorSummary($uploadFormModel); ?>
        </div>
    <?php endif; ?>

</div>
