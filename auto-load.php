<?php

# HEADERS
header('Content-Type: text/html; charset=utf-8');
header('Expires: 0');
header('Cache-Control: no-store, no-cache, must-validate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

ini_set('memory_limit'  , '1240M');
ini_set('upload_max_filesize', '1240M');
ini_set('post_max_size' , '1240M');
ini_set('max_execution_time' , 1240);

if(defined('FRWK') == false):
define('FRWK' , $_SERVER['DOCUMENT_ROOT']);
endif;

# _ L O G S
if(defined('ERROR_LOG') == false){
	define( 'ERROR_LOG'   ,		ROOT.DS.'_logs'.DS.'error.log' );
}
define( 'BACKUP_FILE' ,		ROOT.DS.'_logs'.DS.'backup.file' );
define( 'ERROR_FRWK'  ,		FRWK.DS.'_framework'.DS.'error'.DS );

# ERROR HANDLER
if(defined('ERROR') == TRUE && ERROR == TRUE){
	@error_reporting( E_ALL );
	@ini_set( 'log_errors' , 'Off');
	@ini_set( 'display_errors', 'On' );

}else{
	@error_reporting( 0 );
	@ini_set( 'display_errors' , 'Off' );
	@ini_set( 'log_errors' , 'On');
	@ini_set( 'error_log', ERROR_LOG );
}

# ONE VALUES
$a = 1; $b = 1; $c = 1; $d = 1; $e = 1; $f = 1; $g = 1; $h = 1; $i = 1; $j = 1; $k = 1; $l = 1; $m = 1; $n = 1;


# REQUEST KEEPER
if($_REQUEST){
	foreach($_REQUEST as $key => $value){
		$$key = @htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
		$$key = $value;
	}
}


# SYSTEM TIME ZONE
date_default_timezone_set('UTC');
$td = gmdate('Y-m-d H:i:s');
$dt = gmdate('Y-m-d');
$tm = gmdate('H:i:s');
$mt = gmdate('Y-m');


# FRAMEWORK LIBRARIES
require_once dirname(__FILE__).DS.'plugins'.DS.'adodb'.DS.'adodb.inc.php';
require_once dirname(__FILE__).DS.'plugins'.DS.'phpmailer'.DS.'class.phpmailer.php';
require_once dirname(__FILE__).DS.'plugins'.DS.'phpmailer'.DS.'class.smtp.php';
require_once dirname(__FILE__).DS.'plugins'.DS.'turing'.DS.'turing.php';
require_once dirname(__FILE__).DS.'plugins'.DS.'barcode'.DS.'barcode.php';
//require_once dirname(__FILE__).DS.'plugins'.DS.'PHPExcel'.DS.'PHPExcel.php';
//require_once dirname(__FILE__).DS.'plugins'.DS.'PHPpdf'.DS.'fpdf.php';
require_once dirname(__FILE__).DS.'plugins'.DS.'mobile_detect'.DS.'Mobile_Detect.php';
require_once dirname(__FILE__).DS.'plugins'.DS.'getid3'.DS.'getid3.php';
require_once dirname(__FILE__).DS.'plugins'.DS.'libphonenumber'.DS.'PhoneNumberUtil.php';

require_once dirname(__FILE__).DS.'class'.DS.'class.session.php';
require_once dirname(__FILE__).DS.'class'.DS.'class.cookie.php';
require_once dirname(__FILE__).DS.'class'.DS.'class.engine.php';
require_once dirname(__FILE__).DS.'class'.DS.'class.db.php';
require_once dirname(__FILE__).DS.'class'.DS.'class.sql.php';
require_once dirname(__FILE__).DS.'class'.DS.'class.pagination.php';
require_once dirname(__FILE__).DS.'class'.DS.'class.upload.php';
require_once dirname(__FILE__).DS.'class'.DS.'class.permalinks.php';
require_once dirname(__FILE__).DS.'class'.DS.'class.codes.php';
require_once dirname(__FILE__).DS.'class'.DS.'class.encryptAES.php';

require_once dirname(__FILE__).DS.'api'.DS.'geoloc'.DS.'geoloc.php';

require_once dirname(__FILE__).DS.'inc'.DS.'class.alerts.php';
require_once dirname(__FILE__).DS.'inc'.DS.'class.exportto.php';
require_once dirname(__FILE__).DS.'inc'.DS.'class.dates.php';
require_once dirname(__FILE__).DS.'inc'.DS.'browser.detection.php';
require_once dirname(__FILE__).DS.'inc'.DS.'crypt.php';
require_once dirname(__FILE__).DS.'inc'.DS.'backup.restore.php';
require_once dirname(__FILE__).DS.'inc'.DS.'txt.avatar.php';
require_once dirname(__FILE__).DS.'inc'.DS.'iso.country.php';
require_once dirname(__FILE__).DS.'inc'.DS.'maths.captcha.php';
require_once dirname(__FILE__).DS.'inc'.DS.'social.counter.php';
require_once dirname(__FILE__).DS.'inc'.DS.'JSscripts.php';
require_once dirname(__FILE__).DS.'inc'.DS.'chtml.php';
require_once dirname(__FILE__).DS.'inc'.DS.'functions.php';

# SESSION HOLDER FOR USER ALERTS
if(Session::get('msg') == true && Session::get('status') == true) {
	$msg    = Session::get('msg');
	$status = Session::get('status');

	Session::del('msg');
	Session::del('status');
}
// mysql.inc L801

$port = isset($_SERVER['SERVER_PORT'])?$_SERVER['SERVER_PORT']:'';
$host = isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:'';
$script = isset($_SERVER['SCRIPT_NAME'])?$_SERVER['SCRIPT_NAME']:'';
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $port == 443) ? 'https://' : 'http://';
define( 'WEB', $protocol.$host.rtrim(dirname($script), '/.\\') . '/');


define('AGENT', isset($_SERVER['HTTP_USER_AGENT']) === true?$_SERVER['HTTP_USER_AGENT']:'');
define('ADDR', Engine::get_user_ip_address());
define('REFERER', isset($_SERVER['HTTP_REFERER']) === true?$_SERVER['HTTP_REFERER']:'');
if(array_key_exists('HTTP_ORIGIN', $_SERVER)){
    define('ORIGIN', $_SERVER['HTTP_ORIGIN']);
}else if(array_key_exists('HTTP_REFERER', $_SERVER)){
    define('ORIGIN', $_SERVER['HTTP_REFERER']);
}else{
    define('ORIGIN', '::');
}
