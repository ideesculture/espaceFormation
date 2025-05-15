<?php
	$reglement_valide=false;
	$cgu_valide=false;
	$cgv_valide=false;

	if($stagiaire->reglement_valide_version == __REGLEMENT_VERSION_MAJOR__.".".__REGLEMENT_VERSION_MINOR__) {
		$reglement_valide = true;
	}
	if($stagiaire->cgu_valide_version == __CGU_VERSION_MAJOR__.".".__CGU_VERSION_MINOR__) {
		$cgu_valide = true;
	}
	if($stagiaire->cgv_valide_version == __CGV_VERSION_MAJOR__.".".__CGV_VERSION_MINOR__) {
		$cgv_valide = true;
	}
?>
<div class="row">
	<div class="col-12">
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<i class="fas fa-exclamation-triangle"></i>

			<strong>Validation requise</strong> Vous devez valider le règlement intérieur, les CGU de l'espace formation et nos CGV pour continuer.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	</div>
	<div class="col-12">
		<div class="card conditions">
			<div class="card-body">
				<div><button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseReglement" aria-expanded="false" aria-controls="collapseExample">
						Afficher le règlement intérieur <i class="fas fa-chevron-circle-down"></i>
					</button>
				</div>
				<div class="collapse" id="collapseReglement">
					<?= $reglement_md ?>
				</div>
			</div>
			<div class="card-footer" style="border-bottom: 1px solid lightgray;">
				<div class="form-check form-switch">
					<?php if($reglement_valide) : ?>
						<input class="form-check-input" type="checkbox" id="switchReglement" disabled="disabled" checked="checked">
						<label class="form-check-label" for="switchReglement" id="switchReglementlabel">Règlement validé le <?= date('d/m/Y', strtotime($stagiaire->reglement_valide_date)) ?></label>
					<?php else: ?>
						<input class="form-check-input" type="checkbox" id="switchReglement">
						<label class="form-check-label" for="switchReglement" id="switchReglementlabel">J'accepte le règlement intérieur</label>
					<?php endif; ?>
				</div>
			</div>
			<div class="card-body">
				<div><button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCGU" aria-expanded="false" aria-controls="collapseExample">
						Afficher les conditions d'utilisation de cet espace formation (CGU) <i class="fas fa-chevron-circle-down"></i>
					</button>
				</div>
				<div class="collapse" id="collapseCGU">
					<?= $cgu_md ?>
				</div>
			</div>
			<div class="card-footer" style="border-bottom: 1px solid lightgray;">
				<div class="form-check form-switch">
					<?php if($cgu_valide) : ?>
						<input class="form-check-input" type="checkbox" id="switchCGU" disabled="disabled" checked="checked">
						<label class="form-check-label" for="switchCGU" id="switchCGUlabel">CGU validées le <?= date('d/m/Y', strtotime($stagiaire->cgu_valide_date)) ?></label>
					<?php else: ?>
						<input class="form-check-input" type="checkbox" id="switchCGU">
						<label class="form-check-label" for="switchCGU" id="switchCGUlabel">J'accepte les CGU</label>
					<?php endif; ?>
				</div>
			</div>
			<div class="card-body">
				<div><button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCGV" aria-expanded="false" aria-controls="collapseExample">
						Afficher les conditions générales de vente (CGV) <i class="fas fa-chevron-circle-down"></i>
					</button>
				</div>
				<div class="collapse" id="collapseCGV">
					<?= $cgv_md ?>
				</div>
			</div>
			<div class="card-footer">
				<div class="form-check form-switch">
					<?php if($cgv_valide) : ?>
						<input class="form-check-input" type="checkbox" id="switchCGV" disabled="disabled" checked="checked">
						<label class="form-check-label" for="switchCGV" id="switchCGVlabel">CGV validées le <?= date('d/m/Y', strtotime($stagiaire->cgv_valide_date)) ?></label>
					<?php else: ?>
						<input class="form-check-input" type="checkbox" id="switchCGV">
						<label class="form-check-label" for="switchCGV" id="switchCGVlabel">J'accepte les CGV</label>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12">
		<button type="submit" class="btn btn-primary" onClick="window.location.reload()">Valider</button>
	</div>
</div>