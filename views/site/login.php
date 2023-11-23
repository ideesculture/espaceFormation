<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Se Connecter';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Merci de remplir les champs ci dessous pour vous connecter:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-3 col-form-label mr-lg-4'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

      
<?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

<?php if (!$model->resetPasswordToken): ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
<?php else: ?>
    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Nouveau mot de passe']) ?>
<?php endif; ?>


<?= $form->field($model, 'rememberMe')->checkbox([
    'template' => "<div class=\"col-lg-3 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}". 
    Html::a('Mot de passe oublié ?', ['site/request-password-reset'])."</div>",
]) ?>

<?php if (!$model->resetPasswordToken): ?>
    <div class="form-group">
        <div class="col-lg-11">
            <?= Html::submitButton('Se Connecter', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>
<?php else: ?>
    <div class="form-group">
        <div class="col-lg-11">
            <?= Html::submitButton('Réinitialiser le mot de passe', ['class' => 'btn btn-primary', 'name' => 'reset-password-button']) ?>
        </div>
    </div>
<?php endif; ?>

<?php ActiveForm::end(); ?>

</div>
