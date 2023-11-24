<?php

use app\models\Centres;
use app\models\Formations;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/** @var yii\web\View $this */
/** @var app\models\Sessions $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sessions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=    $form->field($model, 'formation_id')->dropDownList(
        ArrayHelper::map(Formations::find()->all(),'id','name')); ?>

    <?=$form->field($model, 'centre_id')->dropDownList(
        ArrayHelper::map(Centres::find()->all(),'id','name')); ?>

    <?= $form->field($model, 'debut')->textInput()->widget(\yii\jui\DatePicker::className(), [
    'options' => ['class' => 'form-control'],
    'language' => 'fr',
    'dateFormat' => "dd-MM-yyyy"]) ?>

    <?= $form->field($model, 'fin')->textInput()->widget(\yii\jui\DatePicker::className(), [
    'options' => ['class' => 'form-control'],
    'language' => 'fr',
    'dateFormat' => "dd-MM-yyyy"]) ?>
    <?= $form->field($model, 'contact_structure_ou_entreprise')->textInput() ?>

    <?= $form->field($model, 'contact_structure_ou_entreprise_email')->textInput() ?>

    <?= $form->field($model, 'contact_financeur')->textInput() ?>

    <?= $form->field($model, 'contact_financeur_email')->textInput() ?>

    <?= $form->field($model, 'adresse_structure_ou_entreprise')->textInput()?>

    <?= $form->field($model, 'siret_structure_ou_entreprise')->textInput() ?>

    <?= $form->field($model, 'plan_de_formation')->textInput() ?>

    <?= $form->field($model, 'questionnaire_satisfaction_formateur')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Sauvegarder', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
