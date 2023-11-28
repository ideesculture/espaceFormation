<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$title = 'Mes Formations';
$params['breadcrumbs'][] = $title;
?>

<div class="mes-formations">

    <h1 class="center-titre">
        <?= Html::encode($title) ?>
    </h1>
    <?php
    if (!empty($sessions)) {

        /**
         *  Fonction de comparaison pour le tri
         * */
        function compareSessions($a, $b)
        {
            $dateA = new DateTime($a->debut);
            $dateB = new DateTime($b->debut);
        
            // Si les dates de début sont égales, compare les dates de fin
            if ($dateA == $dateB) {
                $endDateA = new DateTime($a->fin);
                $endDateB = new DateTime($b->fin);
                return $endDateB <=> $endDateA;
            }
            return $dateB <=> $dateA;
        }
        usort($sessions, 'compareSessions');

        $today = new DateTime();
        $formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::LONG, \IntlDateFormatter::NONE);// Format des dates
    
        foreach ($sessions as $index => $session) {
            $formation = $formations[$index];
            $startDate = new DateTime($session->debut);
            $endDate = new DateTime($session->fin); 


            $status = ($endDate >= $today) ? (($startDate > $today) ? 'future' : 'current') : 'past';
            ?>
            <div class="card <?= $status ?>">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= Html::a(Html::encode($formation->name), ['sessions/view', 'id' => $formation->id]) ?>
                    </h5>
                    <p class="card-text">
                        Formation:
                        <?= $formation->name ?><br>
                        Date de début:
                        <?= $formatter->format(strtotime($session->debut)) ?><br>
                        Date de fin:
                        <?= $formatter->format(strtotime($session->fin)) ?><br>

                        <?php
                        // Supprimer les heures pour la comparaison
                        $today->setTime(0, 0, 0);
                        $startDate->setTime(0, 0, 0);
                        $endDate->setTime(0, 0, 0);

                        if ($endDate < $today) {
                            echo 'Statut: Passée<br>';
                        } elseif ($startDate > $today) {
                            echo 'Statut: À venir<br>';
                        } else {
                            echo 'Statut: En cours<br>';
                        }

                        if ($session->isLastDay()): ?>
                            <!-- Afficher le lien vers le formulaire Google -->
                            <span style="color:red;">Merci de remplir le formulaire de d'évaluation -> </span>
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSeFJjPox-8jXsVkcf4kE0JfHvf45tlIx8GOYAoUCsUcxm1YOw/viewform"
                                target="_blank" class="text-white">Formulaire d'évaluation de formation</a>
                        <?php endif;
                        echo '<hr>';
                        ?>
                    </p>
                </div>
            </div>
            <?php
        }
    } else {
        echo 'Aucune formation en cours, à venir ou passée.';
    }
    ?>

</div>