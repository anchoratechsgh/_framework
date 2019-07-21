<?php
class Geoloc
{	
	public function __construct($x=''){
		if(empty($x)) {
           $this->_remote_addr = (!empty($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:getenv('REMOTE_ADDR'));
        }else {
           $this->_remote_addr = $x;
        }
	}
	
	public function geoInfo(){
		$y = unserialize(Engine::get_contents("http://www.geoplugin.net/php.gp?ip=$this->_remote_addr"));
		if($y == true){
			return $y;
		}
		/* ** **
			geoplugin_request
			geoplugin_status
			geoplugin_credit
			geoplugin_city
			geoplugin_region
			geoplugin_areaCode
			geoplugin_dmaCode
			geoplugin_countryCode
			geoplugin_countryName
			geoplugin_continentCode
			geoplugin_latitude
			geoplugin_longitude
			geoplugin_regionCode
			geoplugin_regionName
			geoplugin_currencyCode
			geoplugin_currencySymbol
			geoplugin_currencySymbol_UTF8
			geoplugin_currencyConverter
		** ** */
	}
}

# $user_ip = '168.235.200.190';
# $geo = new Geoloc($user_ip);
# $geo = $geo->geoInfo();
# echo $geo['geoplugin_countryName']; die();


