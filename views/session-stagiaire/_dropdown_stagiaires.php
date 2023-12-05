<?php foreach ($stagiaires as $stagiaire): ?>
    <div class="checkbox">
        <label>
            <input type="checkbox" name="selectedStagiaires[]" value="<?= $stagiaire->id ?>">
            <?= $stagiaire->getDisplayName() ?>
        </label>
    </div>
<?php endforeach; ?>