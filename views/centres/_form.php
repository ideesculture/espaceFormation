<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Centres $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="centres-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'lieu')->textInput() ?>

    <?= $form->field($model, 'georeference')->textInput() ?>

    <?= $form->field($model, 'url_lieu1')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
