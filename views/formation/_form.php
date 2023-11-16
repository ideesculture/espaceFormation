<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Formations $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="formations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'prerequis')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'objectif1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'objectif2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'objectif3')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'objectif4')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'objectif5')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'objectif6')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'objectif7')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'objectif8')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'objectif9')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'objectif10')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nbmax')->textInput() ?>

    <?= $form->field($model, 'url_planformation')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
