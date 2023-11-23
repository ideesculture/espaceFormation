<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>

<div class="password-reset">
    <p>Bonjour <?= Html::encode($user->email) ?>,</p>

    <p>Suivez ce lien pour réinitialiser votre mot de passe :</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>