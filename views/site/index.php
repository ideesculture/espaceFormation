<?php

/** @var yii\web\View $this */

$this->title = 'IdéesCulture - espace formation';
?>
<div class="site-index">

<div class="jumbotron text-center bg-transparent home-jumbotron">
    <img src="<?= Yii::$app->request->baseUrl ?>/images/logo.png" alt="Logo de l'entreprise" class="logo-img">
    <h1 class="display-4">Espace formation</h1>
    <p class="lead">Accédez à votre espace, préparez votre formation, téléchargez vos supports</p>

    <?php if (Yii::$app->user->isGuest): ?>
        <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to(['site/login']) ?>">Je me connecte</a></p>
    <?php endif; ?>
</div>
<?php if (Yii::$app->user->isGuest): 
	if(is_file(__DIR__ . '/../../guest_index.html')) {
		include(__DIR__ . '/../../guest_index.html');
	} else {
?>
    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h2>Pour votre formation</h2>

                <p>Vous allez participer à une formation organisée par <?= __NOM_DE_LA_STRUCTURE__ ?>. </p>
                <p><a class="btn btn-outline-secondary" href="<?= __SITE_WEB_DE_LA_STRUCTURE__ ?>">En savoir plus &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Prolongez votre formation</h2>

                <p>Depuis ce site internet, votre espace personnel de formation, retrouvez toutes les infos liées à votre formation : support, documentation, questionnaires de satisfaction, ...</p>

                <p><a class="btn btn-outline-secondary" href="/site/login">Se connecter &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Retrouvez vos supports</h2>

                <p>Un bon support de formation est un support dont on a pas besoin... jusqu'au jour où...</p>
				<p>Depuis votre espace, accédez à vos anciennes formations et retrouvez vos supports.</p>

                <p><a class="btn btn-outline-secondary disabled" href="#">Supports &raquo;</a></p>
            </div>
        </div>

    </div>
<?php
	}
?>
<?php else: 

	if(is_file(__DIR__ . '/../../logged_index.html')) {
		include(__DIR__ . '/../../logged_index.html');
	} else {
?>
<div class="body-content">
	<div class="row">
		<div class="col-lg-4">
                <h2>Pour votre formation</h2>

                <p>Vous allez participer à une formation organisée par <?= __NOM_DE_LA_STRUCTURE__ ?>. </p>
                <p><a class="btn btn-outline-secondary" href="<?= __SITE_WEB_DE_LA_STRUCTURE__ ?>">En savoir plus &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Prolongez votre formation</h2>

                <p>Depuis ce site internet, votre espace personnel de formation, retrouvez toutes les infos liées à votre formation : support, documentation, questionnaires de satisfaction, ...</p>

                <p><a class="btn btn-outline-secondary" href="/site/login">Se connecter &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Retrouvez vos supports</h2>

                <p>Un bon support de formation est un support dont on a pas besoin... jusqu'au jour où...</p>
				<p>Depuis votre espace, accédez à vos anciennes formations et retrouvez vos supports.</p>

                <p><a class="btn btn-outline-secondary disabled" href="#">Supports &raquo;</a></p>
            </div>
        </div>

    </div>
<?php }
	endif; ?>
</div>
