<?php

namespace app\controllers;

use yii\web\Controller;
use SimplePie;
use Yii;

class RssController extends Controller
{
    public function actionIndex()
    {
        // Définir le chemin du répertoire de cache
        $cacheDir = \Yii::getAlias('@webroot') . '/cache';

        // Vérifier si le répertoire de cache existe, sinon le créer
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0777, true);
        }

        // Liste des URL des flux RSS
        $feedUrls = [
            'https://www.lemondeinformatique.fr/flux-rss/thematique/internet/rss.xml',
            'https://feeds.feedburner.com/lesintegristes',
            // Ajoutez d'autres URLs de flux RSS ici
        ];

        $feeds = [];

        foreach ($feedUrls as $url) {
            // Création d'une nouvelle instance de SimplePie
            $feed = new SimplePie();
            $feed->set_feed_url($url);
            $feed->set_cache_location($cacheDir);
            $feed->init();

            // Ajouter le flux à la liste des flux
            $feeds[] = $feed;
        }

        return $this->render('index', [
            'feeds' => $feeds,
        ]);
    }

    public function actionCentreInffo()
    {
        // Définir le chemin du répertoire de cache
        $cacheDir = \Yii::getAlias('@webroot') . '/cache';

        // Vérifier si le répertoire de cache existe, sinon le créer
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0777, true);
        }

        // Liste des URL des flux RSS
        $feedUrls = [
            'https://www.centre-inffo.fr/category/site-centre-inffo/actualites-centre-inffo/le-quotidien-de-la-formation-actualite-formation-professionnelle-apprentissage/feed',
            'https://www.centre-inffo.fr/category/innovation-formation/feed',
			'https://www.centre-inffo.fr/category/videos/feed',
			// Ajoutez d'autres URLs de flux RSS ici
        ];

        $feeds = [];

		// Store the feed content in file cache
		$cacheFile = $cacheDir . '/centre-inffo-cache.txt';
		$cacheTime = 3600; // Cache duration in seconds
		if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $cacheTime)) {
			$feeds = unserialize(file_get_contents($cacheFile));
		} else {
			foreach ($feedUrls as $url) {
				// Création d'une nouvelle instance de SimplePie
				$feed = new SimplePie\SimplePie();
				$feed->enable_cache(true); // Activer la mise en cache
				$cacheDir = \Yii::getAlias('@webroot') . '/cache'; // Répertoire de cache
				$feed->set_cache_location($cacheDir); // Répertoire de cache
				$feed->set_cache_class('SimplePie_Cache_File'); // Utiliser la classe de cache par défaut
				$feed->set_cache_duration(3600); // Durée de mise en cache (en secondes)
				$feed->set_feed_url($url);
				//$feed->set_cache_location($cacheDir);
				
				$feed->init();

				// Ajouter le flux à la liste des flux
				$feeds[] = $feed;
			}
			file_put_contents($cacheFile, serialize($feeds));
		}

        return $this->render('centre-inffo', [
            'feeds' => $feeds,
        ]);
    }

}