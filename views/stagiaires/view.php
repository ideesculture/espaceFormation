<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use DateTime;

/** @var yii\web\View $this */
/** @var app\models\Stagiaires $model */

$this->title = $model->nom . ' ' . $model->prenom;
//$this->params['breadcrumbs'][] = ['label' => 'Stagiaires', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="stagiaires-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php $user = Yii::$app->user->identity;
        if ($user && $user->role === 'admin') : ?>
            <?= Html::a('Modifier', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Supprimer', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Etes-vous sûr(e) de vouloir supprimer cet élément?',
                    'method' => 'post',
                ],
            ])  ?>
            <?= Html::a('Retour à la liste des stagiaires', ['index'], ['class' => 'btn btn-success']) ?>

        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nom:ntext',
            'prenom:ntext',
            'email2:ntext',
            'telephone:ntext',
            [
                'label' => 'Organisation',
                'value' => function ($model) {
                    $organisation = $model->getOrganisation()->one();
                    return $organisation ? $organisation->nom : 'Aucune organisation';
                },
            ],
            [
                'label' => 'Historique Sessions',
                'format' => 'html',
                'value' => function ($model) {
                    $sessions = $model->sessionStagiaires;
                    $sessionNames = [];
                    $today = new DateTime();
                    $today->setTime(0, 0, 0);

                    foreach ($sessions as $sessionStagiaire) {
                        if ($sessionStagiaire->session_id !== null) {
                            $sessionActuelle = $sessionStagiaire->session0;

                            // Instancier DateTime ici
                            $sessionEndDate = new DateTime($sessionActuelle->fin);
                            $sessionEndDate->setTime(0, 0, 0);

                            // Vérifier si la session est passée
                            if ($sessionEndDate < $today) {
                                $formationName = $sessionActuelle->formationrel->name;
                                $formattedStartDate = Yii::$app->formatter->asDate($sessionActuelle->debut, 'php:d M. Y');
                                $formattedEndDate = Yii::$app->formatter->asDate($sessionActuelle->fin, 'php:d M. Y');
                                $sessionNames[] = '- ' . $formationName . ' - Du ' . $formattedStartDate . ' Au ' . $formattedEndDate;
                            }
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