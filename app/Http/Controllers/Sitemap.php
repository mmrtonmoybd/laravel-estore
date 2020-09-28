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
use URL;

use Illuminate\Http\Request;

class Sitemap extends Controller
{
	public $index;
    public function genarate() {
    	
    	//Home, category and pages sitemap
    	$main = \App::make('sitemap');
    	$main->add('/', Carbon::now()->toDateTimeString(), 1.0, 'daily');
    	$main->add('about/', Carbon::now()->toDateTimeString(), 0.6, 'monthly');
    	$main->add('contact/', Carbon::now()->toDateTimeString(), 0.6, 'monthly');
    	
    	$categoris = Categorie::where('products', '>', 0)->get();
    	foreach ($categoris as $category) {
    		$main->add('category/'. $category->id, $category->updated_at, 0.7, 'daily');
    	}
    	$main->store('xml', 'mainsitemap');
    	//$main->addSitemap(URL::to('mainsitemap.xml'));
    //	return $main->render('sitemapindex');
    	
    	
    	$sitemap = \App::make('sitemap');
    	$sitemap->addSitemap(URL::to('mainsitemap.xml'), Carbon::now()->toDateTimeString());
		

	// get all products from db (or wherever you store them)
	$products = Product::latest()->get();

	// counters
	$counter = 0;
	$sitemapCounter = 0;
	// add every product to multiple sitemaps with one sitemap index
	foreach ($products as $p) {
		if ($counter == 50000) {
			// generate new sitemap file
			$sitemap->store('xml', 'productsitemap-' . $sitemapCounter);
			// add the file to the sitemaps array
			$sitemap->addSitemap(URL::to('productsitemap-' . $sitemapCounter . '.xml'), Carbon::now()->toDateTimeString());
			// reset items array (clear memory)
			$sitemap->model->resetItems();
			// reset the counter
			$counter = 0;
			// count generated sitemap
			$sitemapCounter++;
		}
		$image = [
		[
		'title' => $p->title,
		'caption' => substr($p->description, 0, 160),
		'url' => "products/{$p->image}"
		]
		];

		// add product to items array
		$sitemap->add("product/{$p->id}", $p->updated_at, 0.7, 'weekly', $image);
		// count number of elements
		$counter++;
	}

	// you need to check for unused items
	if (!empty($sitemap->model->getItems())) {
		// generate sitemap with last items
		$sitemap->store('xml', 'productsitemap-' . $sitemapCounter);
		// add sitemap to sitemaps array
		$sitemap->addSitemap(URL::to('productsitemap-' . $sitemapCounter . '.xml'), Carbon::now()->toDateTimeString());
		// reset items array
		$sitemap->model->resetItems();
	}

	// generate new sitemapindex that will contain all generated sitemaps above
	return $sitemap->store('sitemapindex', config('app.name'));
    }
    
    public function sitemap() {
    	//header("Content-type: text/xml; charset=utf-8");
    	$this->genarate();
    	$file = file_get_contents(public_path(config('app.name') . '.xml'));
    //	echo $file;
    	return response($file, 200)->
    	header("Content-type", "text/xml; charset=utf-8")->
    	header("Charset", "utf-8");
    }
}