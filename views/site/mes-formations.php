<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$title = 'Mes Formations';
$params['breadcrumbs'][] = $title;
?>

<div class="mes-formations">

    <h1>
        <?= Html::encode($title) ?>
    </h1>
    <?php
if (!empty($sessions)) {
    $today = new DateTime();
    $formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::LONG, \IntlDateFormatter::NONE);       //Format des dates

    foreach ($sessions as $index => $session) {
        $formation = $formations[$index];
        $startDate = new DateTime($session->debut);
        $endDate = new DateTime($session->fin); ?>
    <div>
    
    <?=    Html::a(Html::encode($formation->name), ['sessions/view', 'id' => $formation->id]) ?>
    </div>
    <?php 
        echo 'Formation: ' . $formation->name . '<br>';
        echo 'Date de début: ' . $formatter->format(strtotime($session->debut)) . '<br>';
        echo 'Date de fin: ' . $formatter->format(strtotime($session->fin)) . '<br>';
        echo '<hr>';

        if ($endDate >= $today) {
            if ($startDate > $today) {
                echo 'Statut: À venir<br>';
            } else {
                echo 'Statut: En cours<br>';
            }
        } else {
            echo 'Statut: Passé<br>';
        }
        echo '<hr>';
    }
} else {
    echo 'Aucune formation en cours, à venir ou passée.';
}
?>


</div>