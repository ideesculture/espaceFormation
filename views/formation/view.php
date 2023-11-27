<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Formations $model */

$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Formations'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="formations-view">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modifier'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Supprimer'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Etes-vous sûr(e) de vouloir supprimer cet élément?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'name:ntext',
            'prerequis:ntext',
            'objectif1:ntext',
            'objectif2:ntext',
            'objectif3:ntext',
            'objectif4:ntext',
            'objectif5:ntext',
            'objectif6:ntext',
            'objectif7:ntext',
            'objectif8:ntext',
            'objectif9:ntext',
            'objectif10:ntext',
            'nbmax',
            'url_planformation:ntext',
        ],
    ]) ?>

    <div class="pdf-container">
        <?php if (!empty($model->url_planformation)): ?>
            <div class="pdf-section">
                <h3>Plan de formation</h3>
                <iframe class="pdf-iframe" src="<?= Yii::$app->request->baseUrl . '/' . $model->url_planformation ?>"
                    width="100%" height="400px"></iframe>
                <?= Html::a('Télécharger l\'attestation d\'assurance', ['download', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </div>
        <?php else: ?>
            <p>Aucun plan de formation disponible.</p>
        <?php endif; ?>

    </div>
</div>