<?php
namespace YahooWeather;

/**
 *
 */
class Curl {
  public static $useragent;
  public static $default_useragent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';

  public function __construct(){
    self::$useragent = (isset($_SERVER ['HTTP_USER_AGENT'])) ? $_SERVER ['HTTP_USER_AGENT'] : self::$default_useragent;
  }

  public static function Request( $url ){
    $ch = curl_init();

		$option = [
      CURLOPT_URL=>$url,
      CURLOPT_USERAGENT=>self::$useragent,
      CURLOPT_RETURNTRANSFER=>true
    ];

		curl_setopt_array( $ch, $option );

    $weather_data = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if($httpcode=200){
			return json_decode( $weather_data, true );
		}
		else return $this->error['CURL_FETCH_ERROR'];
	}
}
?>
