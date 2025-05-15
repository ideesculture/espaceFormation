<?php

use yii\helpers\Html;

$this->title = 'Flux RSS';

?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="rss-feeds">
	<div class="row">
    <?php foreach ($feeds as $feed): ?>
		<div>
			<?= $feed->get_title(); ?>
		</div>
		<?php foreach ($feed->get_items() as $item): 
			$description = $item->get_description();
			preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $description, $image);
			$img_src = $image['src'];
			$content = preg_replace("/<img[^>]+\>/i", "", $description); 
			?>
		<div class="col-sm-3">
			<div class="card">
				<?php if($img_src): ?><img src="<?= $img_src ?>" class="card-img-top" alt="Image : <?= $item->get_title() ?>"><?php endif; ?>
				<div class="card-body">
					<h5 class="card-title"><?= Html::encode($item->get_title()) ?></h5>
					<p class="card-text">Date de publication: <?= $item->get_date('j F Y | g:i a'); ?></p>
					<p class="card-text"><?= $content ?></p>
					<a href="<?= $item->get_permalink() ?>" class="btn btn-primary">Afficher</a>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
    <?php endforeach; ?>
	</div>
</div>

<style>
	.card {
		padding:0;
	}
</style>