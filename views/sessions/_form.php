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
    'dateFormat' => "yyyy-MM-dd"
    ]) ?>

    <?= $form->field($model, 'fin')->textInput()->widget(\yii\jui\DatePicker::className(), [
    'options' => ['class' => 'form-control'],
    'language' => 'fr',
    'dateFormat' => "yyyy-MM-dd"]) ?>
    <?= $form->field($model, 'contact_structure_ou_entreprise')->textInput() ?>


    <?= $form->field($model, 'contact_structure_ou_entreprise_email')->textInput() ?>

    <?= $form->field($model, 'contact_financeur')->textInput() ?>


    <?= $form->field($model, 'contact_financeur_email')->textInput() ?>

    <?= $form->field($model, 'adresse_structure_ou_entreprise')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'siret_structure_ou_entreprise')->textInput() ?>

    <?= $form->field($model, 'plan_de_formation')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'questionnaire_satisfaction_formateur')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
