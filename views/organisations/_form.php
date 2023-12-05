<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Organisations $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="organisations-form">

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'nom',['labelOptions' => ['class' => 'required-label control-label']])->textInput() ?>

<?= $form->field($model, 'personne_a_contacter1')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'email1')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'telephone1')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'personne_a_contacter2')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'email2')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'telephone2')->textInput(['maxlength' => true]) ?>

<div class="form-group">
    <?= Html::submitButton('Sauvegarder', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
