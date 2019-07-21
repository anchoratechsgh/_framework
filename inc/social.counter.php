<?php

class SocialCounter
{
	
	private $api_url;
	private $data;
	private $decode;
	private $kode;
	
	public static function fb($kode='1016694665041151'){
		$api_url = 'http://api.facebook.com/method/fql.query?format=json&query=select+fan_count,name+from+page+where+page_id=';
		$data = Engine::get_contents($api_url . $kode);
		$decode = json_decode($data, true);
		return $decode;
		
		# echo $decode[0]->fan_count.'<br/>';
		# echo $decode[0]->name;
	}#end
	
	public static function yb($kode='UCQq1yfBzyvRFGDs2TjmZTZw',$apikey=''){
		$api_url = 'https://www.googleapis.com/youtube/v3/channels?part=statistics&key='.$kode.'&id='.$apikey;
		$data = Engine::get_contents($api_url);
		$decode = json_decode($data, true);
		return $decode;
		
		# $ytsubscribers = $ytcount['items'][0]['statistics']['subscriberCount'];	
	}
	
	public static function gp($kode='UCQq1yfBzyvRFGDs2TjmZTZw'){
		$api_url = 'https://www.googleapis.com/plus/v1/people/?key=';
		$data = Engine::get_contents($api_url . $kode);
		$decode = json_decode($data,true);
		return $decode;	
	}
	
	public static function ig($kode='UCQq1yfBzyvRFGDs2TjmZTZw'){
		$api_url = 'https://api.instagram.com/v1/users/?access_token=';
		$data = Engine::get_contents($api_url . $kode);
		$decode = json_decode($data, true);
		return $decode;	
	}
	
	public static function vi($kode='UCQq1yfBzyvRFGDs2TjmZTZw'){
		$api_url = 'https://vimeo.com/api/v2/%s/info.json/';
		$data = Engine::get_contents($api_url . $kode);
		$decode = json_decode($data, true);
		return $decode;
	}

	
}#endClass

# $data = SocialCounter::ig();
# print_r($data);
# die();