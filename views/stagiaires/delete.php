<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var  app\models\Stagiaires $model*/
/** @var  app\models\User $user */

//$this->title = 'Supprimer Stagiaires';
//$this->params['breadcrumbs'][] = ['label' => 'Stagiaires', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stagiaires-delete">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Êtes vous sûre de vouloir supprimer ce Stagiaire ?
     L'utilisateur associé au mail ci dessous sera supprimé lui aussi :<br><?= Html::encode($user->email) ?>?</p>

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::submitButton('Yes', ['class' => 'btn btn-danger']) ?>
    <?= Html::a('No', ['index'], ['class' => 'btn btn-default']) ?>

    <?php ActiveForm::end(); ?>

</div>
