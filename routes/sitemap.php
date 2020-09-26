<?php
Route::get('sitemap.xml', function() {

	// create new sitemap object
	$sitemap = App::make('sitemap');

	// set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
	// by default cache is disabled
	$sitemap->setCache('laravel.sitemap', 60);

	// check if there is cached sitemap and build new only if is not
	if (!$sitemap->isCached()) {
		// add item to the sitemap (url, date, priority, freq)
		$sitemap->add(URL::to('/'), '2012-08-25T20:10:00+02:00', '1.0', 'daily');
		//$sitemap->add(URL::to('page'), '2012-08-26T12:30:00+02:00', '0.9', 'monthly');

		// get all posts from db, with image relations
		$products = \DB::table('products')->orderBy('created_at', 'desc')->get();

		// add every post to the sitemap
		foreach ($products as $product) {
			// get all images for the current post
				$images = array(
					'url' => $product->url,
					'title' => $product->title,
					'caption' => substr($product->description, 0, 100)
				);
			}

			$sitemap->add("product/{$product->id}", $product->updated_at, 0.7, 'weekly', $images);
	}

	// show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
	return $sitemap->render('xml');
});
?>