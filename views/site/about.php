<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'A propos';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    	<b>Espace Formation</b>
    </p>

    <p>
			Développé par IdéesCulture
	</p>

	<p>
		Ont participé à ce projet :

	</p>
	<blockquote>
		<ul>
			<li><b>v0.9</b><br/>Gautier Michelin</li>
			<li><b>v0.1</b><br/>Nicolas Simon<br/>Hugo Prost<br/>Marine Deruelle</li>
		</ul>
	</blockquote>
</div>
