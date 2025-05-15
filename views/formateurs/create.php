<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Formateurs $model */

$this->title = 'Créer Formateurs';
//$this->params['breadcrumbs'][] = ['label' => 'Formateurs', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formateurs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userModel' => $userModel,
        'uploadFormModel' => $uploadFormModel,
    ]) ?>

</div>
