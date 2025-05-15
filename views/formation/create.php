<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Formations $model */

 $this->title = Yii::t('app', 'Création d\'une Formation');
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Formations'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="formations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'uploadFormModel' => $uploadFormModel,
    ]) ?>

</div>
