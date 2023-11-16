<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Stagiaires $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="stagiaires-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nom')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'prenom')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'telephone')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'historique_sessions')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'password')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'derniere_version_reglement_interieur_accepte')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'derniere_version_cgv_acceptee')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'derniere_version_cgu_acceptee')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
