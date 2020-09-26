<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Http\Controllers;
use App\Product;
use App\Categorie;
use Carbon\Carbon;

use Illuminate\Http\Request;

class Sitemap extends Controller
{
    public function sitemap() {
    	$sitemap = \App::make('sitemap');
		

	// get all products from db (or wherever you store them)
	$products = \DB::table('products')->orderBy('created_at', 'desc')->get();

	// counters
	$counter = 0;
	$sitemapCounter = 0;
    $sitemap->add('/', Carbon::now()->toDateTimeString(), 1.0, 'daily');
	// add every product to multiple sitemaps with one sitemap index
	foreach ($products as $p) {
		if ($counter == 50000) {
			// generate new sitemap file
			$sitemap->store('xml', 'sitemap-' . $sitemapCounter);
			// add the file to the sitemaps array
			$sitemap->addSitemap(secure_url('sitemap-' . $sitemapCounter . '.xml'));
			// reset items array (clear memory)
			$sitemap->model->resetItems();
			// reset the counter
			$counter = 0;
			// count generated sitemap
			$sitemapCounter++;
		}

		// add product to items array
		$sitemap->add("product/{$p->id}", $p->updated_at, 0.7, 'weekly');
		// count number of elements
		$counter++;
	}

	// you need to check for unused items
	if (!empty($sitemap->model->getItems())) {
		// generate sitemap with last items
		$sitemap->store('xml', 'sitemap-' . $sitemapCounter);
		// add sitemap to sitemaps array
		$sitemap->addSitemap(secure_url('sitemap-' . $sitemapCounter . '.xml'));
		// reset items array
		$sitemap->model->resetItems();
	}

	// generate new sitemapindex that will contain all generated sitemaps above
	$sitemap->store('sitemapindex', 'sitemap');
    }
}