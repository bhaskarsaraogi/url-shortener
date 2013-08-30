<?php


Route::get('/u', function()
{
	return View::make('i');
});

Route::post('/u', function() {
	$url = Input::get('url'); //http://google.com
	
	// Validate url
	$v = Url::validate(array('url' => $url));
	// $validation = Validator::make(array('url' => $url), Url::$rules);

	if( $v !== true ) {
		return Redirect::to('/u')->withErrors($v->errors());
	}

	// If the url is alreadt in table return it
	$record = Url::whereUrl($url)->first();
		
	if($record) {
		return View::make('results')
               ->with('shortened', $record->shortened);
		}

	// Otheriwse add a new row and return the shortened url
	
	$shortened = Url::getUniqueShortUrl();
		
	$row = new Url;
	$row->url = $url;
	$row->shortened = $shortened;
	$row->save();

		// $row = Url::create(array(
		// 		'url' => $url,
		// 		'shortened' => $shortened));

	// Create a results view, and prsent the shortened url to user
		if($row) {
			return View::make('results')
					->with('shortened', $row->shortened);
		} else {
			return Redirect::to('/u');
		}
	// If the row does not get created, redirect

});

Route::get('/{any?}', function($u) {
		

	// Query the db for a row with that short url
	$row = Url::whereShortened($u)->first();

	// If not found, redirect to homepage
	if(is_null($row)) { return Redirect::to('/u'); }
	// Otherwise fetch the url and redirect
	return Redirect::to($row->url);
	});