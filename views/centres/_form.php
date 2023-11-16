<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Centres $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="centres-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lieu')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'georeference')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'url_lieu1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'url_lieu2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'url_lieu3')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
