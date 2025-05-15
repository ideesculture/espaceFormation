<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\OrganisationsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="organisations-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nom') ?>

    <?= $form->field($model, 'personne_a_contacter1') ?>

    <?= $form->field($model, 'email1') ?>

    <?= $form->field($model, 'telephone1') ?>

    <?=  $form->field($model, 'personne_a_contacter2') ?>

    <?=  $form->field($model, 'email2') ?>

    <?= $form->field($model, 'telephone2') ?>

    <div class="form-group">
        <?= Html::submitButton('Recherche', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
