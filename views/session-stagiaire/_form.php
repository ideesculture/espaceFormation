<?php

use app\models\Stagiaires;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SessionStagiaire $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="session-stagiaire-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'session_id')->hiddenInput(['readonly' => true]) ?>

    <?= $form->field($model, 'organisation_id')->dropDownList(
     ArrayHelper::map(\app\models\Organisations::find()->all(), 'id', 'nom'),
     ['prompt' => 'Sélectionnez une organisation', 'id' => 'organisation_id']
) ?>

<div id="stagiaire-container">
    <?= $form->field($model, 'stagiaire_id')->dropDownList(
        ArrayHelper::map(Stagiaires::find()->all(), 'id', function ($data) {
            return $data["nom"] . " " . $data["prenom"];
        })
    ); ?>
</div>




   <!-- <?= $form->field($model, 'present_demij1')->textInput() ?>

    <?= $form->field($model, 'present_demij2')->textInput() ?>

    <?= $form->field($model, 'present_demij3')->textInput() ?>

    <?= $form->field($model, 'present_demij4')->textInput() ?>

    <?= $form->field($model, 'present_demij5')->textInput() ?>

    <?= $form->field($model, 'present_demij6')->textInput() ?>

    <?= $form->field($model, 'present_demij7')->textInput() ?>

    <?= $form->field($model, 'present_demij8')->textInput() ?>

    <?= $form->field($model, 'present_demij9')->textInput() ?>

    <?= $form->field($model, 'present_demij10')->textInput() ?>

    <?= $form->field($model, 'reponses_questionnaire_niveau_initial_json')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'reponses_questionnaire_niveau_final_json')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'reponses_satisfaction_json')->textarea(['rows' => 6]) ?>-->

    <?= $form->field($model, 'stagiaire_hors_convention_auditeur_libre')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Sauvegarder', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
