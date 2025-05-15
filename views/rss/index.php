<?php

use yii\helpers\Html;

$this->title = 'Flux RSS';

?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="rss-feeds">
    <?php foreach ($feeds as $feed): ?>
        <div class="rss-feed">
            <h2><?= Html::encode($feed->get_title()) ?></h2>
            <?php foreach ($feed->get_items() as $item): ?>
                <div class="rss-item">
                    <h3><?= Html::a($item->get_title(), $item->get_permalink()) ?></h3>
                    <p><?= $item->get_description(); ?></p>
                    <p>Date de publication: <?= $item->get_date('j F Y | g:i a'); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>