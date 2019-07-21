<?php
// Usages
// $user_ip = '41.66.253.161';
// $geo = new Geoloc($user_ip);
// $geo = $geo->geoInfo();
// print_r($geo['geoplugin_currencySymbol_UTF8']); die();


final class Geoloc
{
	public function __construct($x=''){
		if(empty($x)) {
           $this->_remote_addr = Engine::get_user_ip_address();
        }else {
           $this->_remote_addr = $x;
        }
	}


	public function geoInfo(){
		$y = unserialize(cPost('http://www.geoplugin.net/php.gp', ['ip'=>$this->_remote_addr], 'get', 'raw'));
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
