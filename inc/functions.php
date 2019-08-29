<?php
/**
**
**
**
*/
function _md5($x){
	return pCrypt::lite_encode($x);
}


function md5_($x){
	return pCrypt::lite_decode($x);
}


if(extension_loaded('mbstring')){
	mb_internal_encoding('UTF-8');
	function utf8_strlen($string) {
		return mb_strlen($string);
	}

	function utf8_substr($string, $offset, $length = null) {
		if($length === null){
			return mb_substr($string, $offset, utf8_strlen($string));
		}else{
			return mb_substr($string, $offset, $length);
		}
	}
}


function uploadAndResize($mfile, $destination, $name='', $x='250', $y='250', $hex='eee', $overwrite=false, $watermark='', $convert=''){
	$files = array(); $output = array();
	foreach($mfile as $k => $l){
		foreach($l as $i => $v){
			if(!array_key_exists($i, $files))
				$files[$i] = array();
				$files[$i][$k] = $v;
		}
	}
	foreach($files as $file){
		$foo = new Upload($file);
		if($foo->uploaded){
			$foo->file_overwrite     = $overwrite;
			if(empty($name) == false):
				$foo->file_new_name_body = $name;
			endif;
			if(empty($convert) == false):
				$foo->image_convert    	 = $convert;
			endif;
			if(empty($watermark) == false):
				$foo->image_watermark    = $watermark;
				$foo->image_watermark_x = 5;
				$foo->image_watermark_y = 5;
			endif;
			$foo->image_resize       = true;
			$foo->image_ratio_fill   = true;
			$foo->image_y            = $y;
			$foo->image_x            = $x;
			$foo->image_background_color = '#'.$hex;
			$foo->process($destination);
			if($foo->processed){
				$output[] = $foo->file_dst_name;
			}else{
				$output = false;
			}
		}
	}
	return $output;
}#end


function uploadNoResize($mfile, $destination, $name='', $overwrite=false, $watermark='', $convert=''){
	$files = array(); $output = array();
	foreach($mfile as $k => $l){
		foreach($l as $i => $v){
			if(!array_key_exists($i, $files))
				$files[$i] = array();
				$files[$i][$k] = $v;
		}
	}
	foreach($files as $file){
		$foo = new Upload($file);
		if($foo->uploaded){
			$foo->file_overwrite     = $overwrite;
			if(empty($name) == false):
				$foo->file_new_name_body = $name;
			endif;
			if(empty($convert) == false):
				$foo->image_convert    	 = $convert;
			endif;
			if(empty($watermark) == false):
				$foo->image_watermark    = $watermark;
				$foo->image_watermark_x = 5;
				$foo->image_watermark_y = 5;
			endif;
			$foo->image_ratio_fill   = true;
			$foo->process($destination);
			if($foo->processed){
				$output[] = $foo->file_dst_name;
			}else{
				$output = false;
			}
		}
	}
	return $output;
}#end


function social_format($n){
	$n = (0 + str_replace(',','',$n));
	if(!is_numeric($n)) return false;
	if($n > 1000000000000) return round(($n / 1000000000000),1).' T';
	else if($n > 1000000000) return round(($n / 1000000000),1).' B';
	else if($n > 1000000) return round(($n / 1000000),1).' M';
	else if($n > 1000) return round(($n / 1000),1).' K';
	return number_format($n);
}


function fspinner(){
	return '<div style="text-align:center;color:#999;line-height:320px;width:100%;"><i class="fa fa-spin fa-circle-o-notch fa-5x"></i></div>';
}


function fspinner_sm(){
	return '<div style="text-align:center;color:#999;line-height:120px;width:100%;"><i class="fa fa-spin fa-circle-o-notch fa-3x"></i></div>';
}


function fspinner_xs(){
	return '<i class="fa fa-spin fa-circle-o-notch"></i>';
}


function cPost($url='/', $params=[], $engine='curl', $decode='json'){
	global $apiToken;
	switch($engine){
		case 'curl':
			$ch = curl_init();
			$headers = array('Content-Type: multipart/form-data', 'Origin: '.WEB, 'Referer: '.REFERER);
			$params = array_merge($params, array('ADDR'=>ADDR, 'AGENT'=>AGENT, 'REFERER'=>REFERER));
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_REFERER, WEB);
			$result = curl_exec($ch);
			curl_close($ch);
		break;
		case 'json':
			$ch = curl_init();
			$headers = array('Content-Type: application/json',  $apiToken, 'Origin: '.WEB, 'Referer: '.REFERER);
			$params = array_merge($params, array('ADDR'=>ADDR, 'AGENT'=>AGENT, 'REFERER'=>REFERER));
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_REFERER, WEB);
			$result = curl_exec($ch);
			curl_close($ch);
		break;
		case 'get':
			$ch = curl_init();
			$headers = array('Content-Type: multipart/form-data', 'Origin: '.WEB, 'Referer: '.REFERER);
			$params = http_build_query($params);
			curl_setopt($ch, CURLOPT_URL, $url.'?'.$params);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 3);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			$result = curl_exec($ch);
			curl_close($ch);
		break;
		case 'file':
			$ch = http_build_query($params);
			$ch = urldecode($ch);
			$result = file_get_contents($url.'?'.$ch);
		break;
	}
	switch($decode){
		case 'json':
			return json_decode($result, true);
		break;
		default:
			return $result;
		break;
	}
}


function MBI($w,$h){
	return ($w * $w) / $h;
}

function https() {
	global $argv;
	$host = isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:'cron';
	$host = explode('.', $host); $host = $host[0];
	$local = array('localhost', 'anchoratechs', 'restapi', 'api', 'ledapi', 'cron');
	if(in_array($host, $local) == false && empty($argv) == true){
		if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off'){
			$redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.$redirect);
			exit();
		}
	}
}
// https();

if (function_exists('random_bytes') == false) {
	function random_bytes($length) {
		return openssl_random_pseudo_bytes($length);
	}
}


if (function_exists('array_column') == false) {
    /**
     * Returns the values from a single column of the input array, identified by
     * the $columnKey.
     *
     * Optionally, you may provide an $indexKey to index the values in the returned
     * array by the values from the $indexKey column in the input array.
     *
     * @param array $input A multi-dimensional array (record set) from which to pull
     *                     a column of values.
     * @param mixed $columnKey The column of values to return. This value may be the
     *                         integer key of the column you wish to retrieve, or it
     *                         may be the string key name for an associative array.
     * @param mixed $indexKey (Optional.) The column to use as the index/keys for
     *                        the returned array. This value may be the integer key
     *                        of the column, or it may be the string key name.
     * @return array
     */
    function array_column($input=NULL, $columnKey=NULL, $indexKey=NULL){
        // Using func_get_args() in order to check for proper number of
        // parameters and trigger errors exactly as the built-in array_column()
        // does in PHP 5.5.
        $argc = func_num_args();
        $params = func_get_args();
        if ($argc < 2) {
            trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
            return null;
        }
        if (!is_array($params[0])) {
            trigger_error(
                'array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given',
                E_USER_WARNING
            );
            return null;
        }
        if (!is_int($params[1])
            && !is_float($params[1])
            && !is_string($params[1])
            && $params[1] !== null
            && !(is_object($params[1]) && method_exists($params[1], '__toString'))
        ) {
            trigger_error('array_column(): The column key should be either a string or an integer', E_USER_WARNING);
            return false;
        }
        if (isset($params[2])
            && !is_int($params[2])
            && !is_float($params[2])
            && !is_string($params[2])
            && !(is_object($params[2]) && method_exists($params[2], '__toString'))
        ) {
            trigger_error('array_column(): The index key should be either a string or an integer', E_USER_WARNING);
            return false;
        }
        $paramsInput = $params[0];
        $paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;
        $paramsIndexKey = null;
        if (isset($params[2])) {
            if (is_float($params[2]) || is_int($params[2])) {
                $paramsIndexKey = (int) $params[2];
            } else {
                $paramsIndexKey = (string) $params[2];
            }
        }
        $resultArray = array();
        foreach ($paramsInput as $row) {
            $key = $value = null;
            $keySet = $valueSet = false;
            if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
                $keySet = true;
                $key = (string) $row[$paramsIndexKey];
            }
            if ($paramsColumnKey === null) {
                $valueSet = true;
                $value = $row;
            } elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
                $valueSet = true;
                $value = $row[$paramsColumnKey];
            }
            if ($valueSet) {
                if ($keySet) {
                    $resultArray[$key] = $value;
                } else {
                    $resultArray[] = $value;
                }
            }
        }
        return $resultArray;
    }

}
