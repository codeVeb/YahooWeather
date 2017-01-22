<?php
namespace YahooWeather;

#	Author		:	Vaibhav Khedekar
#	link		:	http://www.vebport.com
#	CodeName	:	Yahoo Weather Wrapper 1.0.0

/*INTRO : This class is used to intract with yahoo`s free service called weather api. You can used this class file to simply get updates about weather.*/
class Api{

	private $woeid = 0;
	private $yql_base = 'http://query.yahooapis.com/v1/public/yql?q=';
	private $weatherData = array();

	public function __construct( $woeid=0 ){
		if( $woeid == 0 ){
			exit( $this->error['NO_WOEID'] );
		}else{
			$this->woeid = $woeid;
			$this->getWeather();
		}
	}

	public function getAll(){
		return $this->_isset($this->weatherData);
	}

	public function title(){
		return $this->_isset($this->weatherData['channel']['description']);
	}

	public function lastBuild(){
		return $this->_isset($this->weatherData['channel']['lastBuildDate']);
	}

	public function location(){
		return $this->_isset($this->weatherData['channel']['location']);
	}

	public function units(){
		return $this->_isset($this->weatherData['channel']['units']);
	}

	public function wind(){
		return $this->_isset($this->weatherData['channel']['wind']);
	}

	public function atmosphere(){
		return $this->_isset($this->weatherData['channel']['atmosphere']);
	}

	public function astronomy(){
		return $this->_isset($this->weatherData['channel']['astronomy']);
	}

	public function now(){

		$timestamp = strtotime($this->weatherData['channel']['item']['pubDate']);

		$now = array(
		'title'=>$this->weatherData['channel']['location']['city'].','.$this->weatherData['channel']['location']['country'],
		'day'=>date('D',$timestamp),
		'date'=>date('d M Y',$timestamp),
		'time'=>date('H:i a',$timestamp),
		'condition'=>$this->weatherData['channel']['item']['condition']['text'],
		'temperature'=>Util::fah2Cel($this->weatherData['channel']['item']['condition']['temp']),
		);

		return $now;
	}

	public function forecast(){

		$forecast = $this->weatherData['channel']['item']['forecast'];
		$count = 0;

		foreach( $forecast as $day ){
			$forecast[$count]['high'] = Util::fah2Cel($day['high']);
			$forecast[$count]['low'] = Util::fah2Cel($day['low']);
			$count++;
		}

		return $forecast;

	}

	public function poweredBy( $style = 'default' ){

		if( $style == 'dark' )
			return '<a href="https://www.yahoo.com/?ilc=401" target="_blank"><img src="https://poweredby.yahoo.com/white.png" width="134" height="29"/></a>';

		return '<a href="https://www.yahoo.com/?ilc=401" target="_blank"><img src="https://poweredby.yahoo.com/purple.png" width="134" height="29"/></a>';
	}

	public function getWeather(){

		$yql_param ="select * from weather.forecast where woeid=".$this->woeid;

		$this->weatherData = Curl::Request( $this->yql_base . urlencode($yql_param) . '&format=json' )['query']['results'];

		if($this->weatherData['channel']['item']['title'] == 'City not found'){
			exit($this->error['UNDEFINED_WOEID']);
		}
	}


	private function _isset( $data ){
		if(isset($data)) return $data;
		return array('NO_DATA'=>'no data available');
	}

	private $error = array('NO_WOEID'=>'Please enter WOEID(where on earth ID) for your region.. <a href="http://woeid.rosselliot.co.nz/">WOEID lookup</a>',
	'UNDEFINED_FORMAT'=>"Undefined return format. (Use 'json' or 'xml')",
	'CURL_FETCH_ERROR'=>'error while fetching data from server.',
	'UNDEFINED_WOEID'=>'Undefined WOEID. please check..');
}
?>
