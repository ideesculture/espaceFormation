<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Stagiaires $model */

$this->title = 'Créer Stagiaires';

?>
<div class="stagiaires-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userModel' => $userModel,

    ]) ?>

</div>
