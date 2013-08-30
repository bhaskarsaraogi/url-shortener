<?php 

class Url extends Eloquent {
	public $timestamps = false;

	public static $rules = array(
		'url' => 'required|url'
	);

	public static function validate($input) {
		$v = Validator::make($input, static::$rules);
		return $v->fails() ? $v : true;
	}

	public static function getUniqueShortUrl() {
		$shortened = base_convert(rand(10000,99999),10,36);
		if(static::whereShortened($shortened)->first() ) {
			return	static::getUniqueShortUrl();
		}
		return $shortened;
	}
}