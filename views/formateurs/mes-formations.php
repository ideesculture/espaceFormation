<?php

use yii\helpers\Html;


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
        $formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::LONG, \IntlDateFormatter::NONE);

        usort($sessions, function($a, $b) {
            return strtotime($b->debut) - strtotime($a->debut);
        });
        $sessions = array_values($sessions);

        foreach ($sessions as $index => $session) {
            $formation = $formations[$index];
            $startDate = new DateTime($session->debut);
            $endDate = new DateTime($session->fin);

            // Détermine le statut (À venir, En cours, Passé)
            $status = ($endDate >= $today) ? (($startDate > $today) ? 'future' : 'current') : 'past';
            ?>
            <div class="card <?= $status ?>">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= Html::a(Html::encode($formation->name), ['sessions/view', 'id' => $formation->id]) ?>
                    </h5>
                    <p class="card-text">
                        Formation:
                        <?= Html::encode($formation->name) ?><br>
                        Date de début:
                        <?= $formatter->format(strtotime($session->debut)) ?><br>
                        Date de fin:
                        <?= $formatter->format(strtotime($session->fin)) ?><br>

                        <?php
                        if ($endDate >= $today) {
                            if ($startDate > $today) {
                                echo 'Statut: À venir<br>';
                            } else {
                                echo 'Statut: En cours<br>';
                            }
                        } else {
                            echo 'Statut: Passé<br>';
                        }
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