<?php
	//var_dump($session_id);
	//var_dump($stagiaire_id);
?>

<h1>Questionnaire de début de formation</h1>

<script>
	window.questionnaire_url = "http://formation.local/questionnaireDebut.json";
</script>

<script type="module" crossorigin src="/assets/index-CGQy0mow.js"></script>
<link rel="stylesheet" crossorigin href="/assets/index-1-UOyIIK.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<form action="/sessions/questionnaire-debut-formation-save">
	<input type="hidden" name="session_id" value="<?= $session_id ?>">
	<input type="hidden" name="stagiaire_id" value="<?= $stagiaire_id ?>">
	
	<div id="app"></div>

	<datalist id="satisfaction">
	<option value="1" label="très insatisfaisant"></option>
	<option value="2" label="insatisfaisant"></option>
	<option value="3" label="assez insatisfaisant"></option>
	<option value="4" label="assez satisfaisant"></option>
	<option value="5" label="satisfaisant"></option>
	<option value="6" label="très satisfaisant"></option>
	</datalist>
</form>

<style>
	.formkit-input {
		background-color: white;
	}
	.formkit-wrapper,
	.formkit-fieldset {
		max-width: 100%;
	}
	[data-type=range] input.formkit-input {
		background-color: transparent;
	}
	
	.nav-tabs {
		border-bottom: 1px solid #808080;
		margin-top:40px;
		margin-bottom:30px !important;
	}

	.nav-tabs .nav-item .active,
	.nav-tabs .nav-item {
		background-color: transparent;
	}
	.nav-tabs .nav-item .nav-link {
		background-color: transparent;
		border-top:1px solid #e4e4e4;
		border-left:1px solid #e4e4e4;
		border-right:1px solid #e4e4e4;
		background-color: #e4e4e4;
		color:lightgray;
		border-bottom: 1px solid #808080;
		cursor: pointer;
	}
	.nav-tabs .nav-item .nav-link.active {
		background-color: transparent;
		border-top:1px solid gray;
		border-left:1px solid gray;
		border-right:1px solid gray;
		border-bottom:#f4f4f4;
		color:black;
		border-bottom:1px solid #f4f4f4;
	}
	.nav-tabs {
		margin-bottom:10px;
	}
	.fade:not(.show) {
		display: none;
	}
	.formkit-outer .formkit-icon.formkit-suffix-icon {
		width: 32px;
		margin: 0;
		padding: 4px;
	}
	.formkit-suffix-icon svg {
		max-height: none;
		max-width: none;
	}
</style>

<script>
$(document).ready(
	function() {
		$('input[type=submit]').click(
			console.log()
		)
	}
);
</script>