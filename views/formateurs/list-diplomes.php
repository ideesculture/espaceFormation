<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/**  @var app\models\Formateurs $model */
/**  @var array $diplomes */

$this->title = $model->getDisplayName();
\yii\web\YiiAsset::register($this);
?>

<div class="formateurs-list-diplomes">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Retour à la fiche formateur', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <h3>Liste des Diplômes :</h3>

<?php if (!empty($diplomes)) : ?>
    <ul>
        <?php foreach ($diplomes as $diplome) : ?>
            <li><?= Html::a(Html::encode($diplome), ['download-diplome', 'id' => $model->id, 'diplome' => $diplome]) ?></li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Aucun diplôme trouvé.</p>
<?php endif; ?>

</div>