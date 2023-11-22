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
        echo '<br>';

        // Supprimer les heures pour la comparaison
        $today->setTime(0, 0, 0);
        $startDate->setTime(0, 0, 0);
        $endDate->setTime(0, 0, 0);

        if ($endDate < $today) {           
            // Si la date de fin est passée
            echo 'Statut: Passée<br>';
        } elseif ($startDate > $today) {
            // Si la date de début est à venir
            echo 'Statut: À venir<br>';
        } else {
            // Si la date de début est passée et la date de fin est à venir
            echo 'Statut: En cours<br>';
        }


         if ($session->isLastDay()): ?>
            <!-- Afficher le lien vers le formulaire Google -->
            <span style="color:red;">Merci de remplir le formulaire de d'évaluation -> </span>
            <a href="https://docs.google.com/forms/d/e/1FAIpQLSeFJjPox-8jXsVkcf4kE0JfHvf45tlIx8GOYAoUCsUcxm1YOw/viewform" target="_blank">Formulaire d'évaluation de formation</a>
        <?php endif;
        echo '<hr>';
    }
} else {
    echo 'Aucune formation en cours, à venir ou passée.';
}
?>


</div>