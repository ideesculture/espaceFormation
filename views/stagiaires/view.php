<?php
use yii\helpers\Html;
use yii\helpers\Url;



/** @var yii\web\View $this */
/** @var app\models\Stagiaires $model */
$stagiaire = $model;


// Chargement des versions des CGU, CGV et règlement
$administratif_dir = __DIR__ .'/../../_administratif';
if(is_file($administratif_dir.'/reglement/local/version.php')) {
	require $administratif_dir.'/reglement/local/version.php';
} else {
	require $administratif_dir.'/reglement/version.php';
}
if(is_file($administratif_dir.'/cgu/local/version.php')) {
	require $administratif_dir.'/cgu/local/version.php';
} else {
	require $administratif_dir.'/cgu/version.php';
}
if(is_file($administratif_dir.'/cgv/local/version.php')) {
	require $administratif_dir.'/cgv/local/version.php';
} else {
	require $administratif_dir.'/cgv/version.php';
}

$this->title = $stagiaire->prenom . ' ' . $stagiaire->nom;
$initials = substr($stagiaire->prenom, 0, 1) . substr($stagiaire->nom, 0, 1);
\yii\web\YiiAsset::register($this);

$Parsedown = new ParsedownExtra();
if(is_file(__DIR__."/../../_administratif/reglement/local/reglement.md")) {
	$reglement_md = $Parsedown->text(file_get_contents(__DIR__."/../../_administratif/reglement/local/reglement.md"));
} else {
	$reglement_md = $Parsedown->text(file_get_contents(__DIR__."/../../_administratif/reglement/reglement.md"));
}
if(is_file(__DIR__."/../../_administratif/cgu/local/cgu.md")) {
	$cgu_md = $Parsedown->text(file_get_contents(__DIR__."/../../_administratif/cgu/local/cgu.md"));
} else {
	$cgu_md = $Parsedown->text(file_get_contents(__DIR__."/../../_administratif/cgu/cgu.md"));
}
if(is_file(__DIR__."/../../_administratif/cgv/local/cgv.md")) {
	$cgv_md = $Parsedown->text(file_get_contents(__DIR__."/../../_administratif/cgv/local/cgv.md"));
} else {
	$cgv_md = $Parsedown->text(file_get_contents(__DIR__."/../../_administratif/cgv/cgv.md"));
}

/*
 * Infos stagiaire : $stagiaire-> ... 
 * id
 * nom
 * prenom
 * email2
 * telephone
 * org : $stagiaire->getOrganisation()->one()
 * reglement_valide_version
 * reglement_valide_date
 * cgv_valide_version
 * cgv_valide_date
 * cgu_valide_version
 * cgu_valide_date
 */


$sessions = $stagiaire->sessionStagiaires;
$sessionNames = [];
$today = new DateTime();
$today->setTime(0, 0, 0);
$sessionNames = [];
foreach ($sessions as $sessionStagiaire) {
	if ($sessionStagiaire->session_id !== null) {
		$sessionActuelle = $sessionStagiaire->session0;

		// Instancier DateTime ici
		$sessionEndDate = new DateTime($sessionActuelle->fin);
		$sessionEndDate->setTime(0, 0, 0);

		// Vérifier si la session est passée
		if ($sessionEndDate < $today) {
			$formationName = $sessionActuelle->formationrel->name;
			$formattedStartDate = Yii::$app->formatter->asDate($sessionActuelle->debut, 'php:d M. Y');
			$formattedEndDate = Yii::$app->formatter->asDate($sessionActuelle->fin, 'php:d M. Y');
			$sessionNames[] = '- ' . $formationName . ' - Du ' . $formattedStartDate . ' Au ' . $formattedEndDate;
		}
	}
}

$user = Yii::$app->user->identity;
if ($user && $user->role === 'admin') : ?>
	<?= Html::a('Modifier', ['update', 'id' => $stagiaire->id], ['class' => 'btn btn-primary']) ?>
	<?= Html::a('Supprimer', ['delete', 'id' => $stagiaire->id], [
		'class' => 'btn btn-danger',
		'data' => [
			'confirm' => 'Etes-vous sûr(e) de vouloir supprimer cet élément?',
			'method' => 'post',
		],
	])  ?>
	<?= Html::a('Retour à la liste des stagiaires', ['index'], ['class' => 'btn btn-success']) ?>

<?php endif;
$default = "https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png";
$gravatar_email = $user->email;
//$gravatar_email = "gautier.michelin@gmail.com";
$grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($gravatar_email))) . "?d=" . urlencode($default) . "&s=128";

$cg_valides = false;
if(
	($stagiaire->reglement_valide_version == __REGLEMENT_VERSION_MAJOR__.".".__REGLEMENT_VERSION_MINOR__) &&
	($stagiaire->cgu_valide_version == __CGU_VERSION_MAJOR__.".".__CGU_VERSION_MINOR__) &&
	($stagiaire->cgv_valide_version == __CGV_VERSION_MAJOR__.".".__CGV_VERSION_MINOR__)
	) { $cg_valides = true;}
?>

<div class="stagiaires-view">
	<?php if(!$cg_valides) : 
		require(__DIR__ . '/view_valider_cg.php');
	else: ?>
	<div class="content row">
		<div class="col-8">
			<div class="card mb-3 usercard" style="">
				<div class="row g-0">
					<div class="col-md-4">
						<img src="<?= $grav_url ?>" class="img-fluid rounded-start profile-img" alt="profile" style="width:100%;height:100%;object-fit: cover;">
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<h5 class="card-title">Bonjour <?= Html::encode($this->title) ?></h5>
							<p class="card-text">

								<?php if (($stagiaire->user_id) == ($user->id)) : ?>
							<p><i class="fas fa-envelope"></i> <?= $user->email ?></p>
						<?php endif; ?>
						<p><i class="fas fa-phone"></i><?= $stagiaire->telephone ?></p>
						</p>
						<p class="card-text text-end"><small class="text-muted">Dernière connexion JJ/MM/AAAA</small></p>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="col-4">
			<div class="card cgu-cgv">
				<div class="accordion accordion-flush" id="accordionFlushExample">
					<div class="accordion-item">
						<h2 class="accordion-header" id="flush-headingOne">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
								Règlement intérieur
							</button>
						</h2>
						<div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
							<div class="accordion-body">
								<div style="padding-top:4px;float:right">
									<span class="badge bg-light text-dark">Accepté le 27/04/2024</span>
								</div>
								<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file"></i></button>
								<button type="button" class="btn btn-dark btn-sm"><i class="fas fa-file-download"></i></button>
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header" id="flush-headingTwo">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
								Conditions générales d'utilisation
							</button>
						</h2>
						<div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
							<div class="accordion-body">
								<div style="padding-top:4px;float:right">
									<span class="badge bg-light text-dark">Accepté le 27/04/2024</span>
								</div>
								<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file"></i></button>
								<button type="button" class="btn btn-dark btn-sm"><i class="fas fa-file-download"></i></button>
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header" id="flush-headingThree">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
								Conditions générales de vente
							</button>
						</h2>
						<div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
							<div class="accordion-body">
								<div style="padding-top:4px;float:right">
									<span class="badge bg-light text-dark">Accepté le 27/04/2024</span>
								</div>
								<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-file"></i></button>
								<button type="button" class="btn btn-dark btn-sm"><i class="fas fa-file-download"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-8">
			<h5 class="card-title">Formations à venir</h5>
			<ul>
				<li>Formation 1</li>
				<li>Formation 2</li>
				<li>Formation 3</li>
			</ul>
			<h5 class="card-title">Formations passées</h5>
			<ul>
				<?php foreach ($sessionNames as $sessionName) : //http://formation.local/sessions/view?id=9 ?>
					<li>
						<?= $sessionName ?>
					</li>
					<?php
					//print $user-


					?>
					 <?php //if (Html::encode($questionnaire_debut_formation->stagiaire_id) === $stagiaireId): ?>
                        <span style="color:red;">Formulaire de debut de formation non remplie</span> <br>
                    <?php //endif; ?>

                    <?php //if (Html::encode($questionnaire_fin_formation->stagiaire_id) === $stagiaireId): ?>
                       <span style="color:red;">Formulaire de fin de formation non remplie</span> <br>
                    <?php //endif; ?>

                    
                    <?php // if(! $enable_questionnaire_fin_formation and ! $enable_questionnaire_debut_formation): ?>
						 <span style="color:red;">Attestation</span>
					<?//php endif; ?>

				<?php endforeach; ?>
			</ul>
		</div>
		<div class="col-4">
			<h5 class="card-title">Je consulte mon livret d'accueil</h5>
			<a href="/site/livret-accueil"><img src="/assets/livret_accueil/livret_accueil.png" alt="Livret d'accueil" class="img-fluid" style="padding:0 40px"></a>
		</div>
	</div>
	<?php endif; ?>
</div>
<style>
	.usercard i.fas {
		display: inline-block;
		height: 30px;
		width: 30px;
		margin-top: -8px;
		background: gray;
		color: white;
		padding: 4px 7px;
		line-height: 24px;
		border-radius: 6px;
	}

	.cgu-cgv .accordion-body {
		/*padding: 8px 0;*/
	}

	.cgu-cgv .accordion-body .form-switch {
		padding-top: 8px;
	}
	.conditions .collapsing,
	.conditions .collapse {
		padding-top: 0.5rem;
		max-height:500px !important;
		overflow: scroll;
	}
</style>
<script src="/js/jquery-3.7.1.min.js"></script>
<script>
	$(document).ready(function() {
		let today = new Date();
		$("#switchReglement").click(function() {
			$.ajax({
				type: "POST",
				url: "<?= Url::toRoute('stagiaires-ajax/reglement?id='.$stagiaire->id); ?>",
				success: function(msg) {
					$("#switchReglementlabel").text("Règlement intérieur validé le "+today.toLocaleDateString("fr"));
					$("#switchReglement").attr("disabled",true);
					console.log("Success ", msg);
				},
				error: function(err) {
					alert("Erreur" + err);
				}
			});
		});

		$("#switchCGV").click(function() {
			$.ajax({
				type: "POST",
				url: "<?= Url::toRoute('stagiaires-ajax/cgv?id='.$stagiaire->id); ?>",
				success: function(msg) {
					$("#switchCGVlabel").text("CGV validées le "+today.toLocaleDateString("fr"));
					$("#switchCGV").attr("disabled",true);
					console.log("Success ", msg);
				},
				error: function(err) {
					alert("Erreur" + err);
				}
			});
		});

		$("#switchCGU").click(function() {
			$.ajax({
				type: "POST",
				url: "<?= Url::toRoute('stagiaires-ajax/cgu?id='.$stagiaire->id); ?>",
				success: function(msg) {
					$("#switchCGUlabel").text("CGU validées le "+today.toLocaleDateString("fr"));
					$("#switchCGU").attr("disabled",true);
					console.log("Success ", msg);
				},
				error: function(err) {
					alert("Erreur" + err);
				}
			});
		});
	});
	
</script>