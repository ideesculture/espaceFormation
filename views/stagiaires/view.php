<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Stagiaires $model */

$this->title = $model->nom;
//$this->params['breadcrumbs'][] = ['label' => 'Stagiaires', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="stagiaires-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php $user = Yii::$app->user->identity;
        if ($user && $user->role === 'admin'): ?>
        <?= Html::a('Modifier', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Supprimer', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Etes-vous sûr(e) de vouloir supprimer cet élément?',
                'method' => 'post',
            ],
        ]) ?>  <?php endif; ?>
    </p>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'nom:ntext',
        'prenom:ntext',
        'email2:ntext',
        'telephone:ntext',
        [
            'label' => 'Historique Sessions',
            'format' => 'html',
            'value' => function ($model) {
                $sessions = $model->sessionStagiaires;
                $sessionNames = [];
                $today = new DateTime();
    
                foreach ($sessions as $sessionStagiaire) {
                    $session = $sessionStagiaire->session0;
                    // Vérifier si la session est passée
                    $sessionEndDate = new DateTime($session->fin);
                    
                    if ($sessionEndDate < $today) {
                        $formationName = $session->formationrel->name;
                        $formattedStartDate = Yii::$app->formatter->asDate($session->debut, 'php:d M. Y');
                        $formattedEndDate = Yii::$app->formatter->asDate($session->fin, 'php:d M. Y');
                        $sessionNames[] = '- ' . $formationName . ' - Du ' . $formattedStartDate . ' Au ' . $formattedEndDate;
                    }
                }
                return implode('<br>', $sessionNames);
            },
        ],
        'derniere_version_reglement_interieur_accepte:ntext',
        'derniere_version_cgv_acceptee:ntext',
        'derniere_version_cgu_acceptee:ntext',
    ],
]) ?>

</div>
