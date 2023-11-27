<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Formateurs $model */

$this->title = 'Modifier Formateur';
?>
<div class="formateurs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userModel' => $userModel,
        'uploadFormModel' => $uploadFormModel,
    ]) ?>

</div>
