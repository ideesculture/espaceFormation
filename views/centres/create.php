<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Centres $model */

$this->title = Yii::t('app', 'Créer un Centre de formation');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Centres'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centres-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
