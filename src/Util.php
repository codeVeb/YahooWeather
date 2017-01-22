<?php
namespace YahooWeather;

/**
 *
 */
class Util {

	public static function fah2Cel( $f ){
		$c = ( $f - 32 ) / 1.8;
		return round($c,2) . ' &#8451;';
	}

	public static function cel2Fah( $c ){
		$f = ( $c * 1.8 ) + 32;
		return round($f,2) . ' &#8457;';
	}
}

?>
