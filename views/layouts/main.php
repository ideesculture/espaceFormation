<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
   NavBar::begin([
    'brandLabel' => Html::img('@web/images/logo2.png', ['alt'=>Yii::$app->name, 'class'=>'logo']),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
]);

$items = [
    ['label' => 'Accueil', 'url' => ['/site/index']],
];

if (Yii::$app->user->isGuest) {
    $items[] = ['label' => 'Connexion', 'url' => ['/site/login']];
} else {
    $roleLabel = Yii::$app->user->identity->role; 
 
    if ($roleLabel === 'stagiaire') {
        $stagiaireId = Yii::$app->user->identity->stagiaire->id;
        $items[] = ['label' => 'Mes Infos', 'url' => ['/stagiaires/view', 'id' => $stagiaireId]];
        $items[] = ['label' => 'Mes Formations','url' => ['/stagiaires/mes-formations', 'id' => $stagiaireId]];
    }

    if ($roleLabel === 'formateur') {
        $formateurId = Yii::$app->user->identity->formateur->id;
        $items[] = ['label' => 'Mes Infos', 'url' => ['/formateurs/view', 'id' => $formateurId]];
        $items[] = ['label' => 'Mes Formations','url' => ['/formateurs/mes-formations', 'id' => $formateurId]];
        
    }

    if ($roleLabel === 'admin') {
        $items[] = ['label' => 'Formations', 'url' => ['/formation/index']];
        $items[] = ['label' => 'Centres', 'url' => ['/centres/index']];
        $items[] = ['label' => 'Formateurs', 'url' => ['/formateurs/index']];
        $items[] = ['label' => 'Sessions', 'url' => ['/sessions/index']];
        $items[] = ['label' => 'Stagiaires', 'url' => ['/stagiaires/index']];
        $items[] = ['label' => 'A propos', 'url' => ['/site/about']];
       // $items[] = ['label' => 'Users', 'url' => ['/user/index']];
        $items[] = ['label' => 'Contact', 'url' => ['/site/contact']];
    }

    $items[] = [
        'label' => 'Déconnexion (' . $roleLabel . ')',
        'url' => ['/site/logout'],
        'linkOptions' => ['data-method' => 'post'],
    ];
}

echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => $items,
]);

NavBar::end();
?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">IdéesCulture <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
