<?php
use yii\helpers\Html;
?>
   <?= Html::button('Cocher Tout', ['class' => 'btn btn-link', 'id' => 'cocherToutBtn']) ?>
   <br>
<div class="checkbox-container">
  <?php foreach ($stagiaires as $stagiaire): ?>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="selectedStagiaires[]" value="<?= $stagiaire->id ?>">
                <?= $stagiaire->getDisplayName() ?>
            </label>
        </div>
    <?php endforeach; ?>
</div>