<?php
if(is_file(__DIR__.'/../../_administratif/livret-accueil/local/livret-accueil.md')) {
	$livret_md = file_get_contents(__DIR__.'/../../_administratif/livret-accueil/local/livret-accueil.md');
} else {
	$livret_md = file_get_contents(__DIR__.'/../../_administratif/livret-accueil/livret-accueil.md');
}
//$Parsedown = new ParsedownExtra();
$Parsedown = new \ParsedownToC();

$livret = $Parsedown->text($livret_md);
?>
<div class='row'>
	<div class='col-12'>
		<img src='/assets/livret_accueil/livret_accueil.png' alt='Livret d'accueil' class='img-fluid' style='height:180px'>
		<?= $livret ?>
	</div>
</div>



<style>
	h2 {
		font-size:24px;
	}
</style>