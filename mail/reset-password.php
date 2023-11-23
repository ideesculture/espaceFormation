<?php
use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\models\User $user
*/

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>

    <div class="password-reset">
        <p>Bonjour <?= Html::encode($user->email) ?>,</p>

        <p>Suivez ce lien pour réinitialiser votre mot de passe (Valable pour une durée 15 minutes):</p>

        <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
    </div>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
