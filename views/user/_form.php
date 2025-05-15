<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

     <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email',['labelOptions' => ['class' => 'required-label control-label']])
    ->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password',['labelOptions' => ['class' => 'required-label control-label']])
    ->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role',['labelOptions' => ['class' => 'required-label control-label']])
    ->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Sauvegarder', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
