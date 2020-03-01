<?php $ago = new Dates();

class Dates {

  private static function convert_datetime($str) {
   	list($date, $time) = explode(' ', $str);
    list($year, $month, $day) = explode('-', $date);
    list($hour, $minute, $second) = explode(':', $time);
    $timestamp = mktime($hour, $minute, $second, $month, $day, $year);
    return $timestamp;
  }#end


	public static function makeAgo($date){
    global $td;
		$edate = explode('-', $date);
		if(isset($edate[0]) == true && isset($edate[1]) == true && isset($edate[2]) == true){
			$date = self::convert_datetime($date);
			$difference = strtotime($td) - $date;
			$periods = array("sec", "min", "hr", "day", "week", "month", "year", "decade");
			$lengths = array("60","60","24","7","4.35","12","10");
			for($j = 0; $difference >= $lengths[$j]; $j++)
				$difference /= $lengths[$j];
				$difference = round($difference);
			if($difference != 1) $periods[$j].= "s";
				$ago = "$difference $periods[$j] ago";
				return $ago;
		}else{
			return $date;
		}
  }#end


	public static function makeDiff($date, $format='a'){
		// '%y Year; %m Month; %a Day; %h Hours; %i Minute; %s Seconds'
		global $td;
		$exp = date_diff(date_create($td), date_create($date));
		return $exp->format('%R%'.$format);
	}#end


  public static function makeDiffDates($old, $new, $format='%a Day and %h hours'){
		// '%y Year; %m Month; %a Day; %h Hours; %i Minute; %s Seconds'
    $old = new DateTime($old);
    $new = new DateTime($new);
    $dif =  $new->diff($old);
    return $dif->format($format);   


		// $exp = date_diff(date_create($new), date_create($old));
		// return $exp->format('%'.$format);
	}#end


  public static function hoursDiff($old, $new){
    // '2020-02-02', '2020-01-04'
		// '%y Year; %m Month; %a Day; %h Hours; %i Minute; %s Seconds'
    $t1 = strtotime($new);
    $t2 = strtotime($old);
    $diff = $t1 - $t2;
    $hours = ($diff / ( 60 * 60 ));
    return $hours;
	}#end


	/*
	*@name makeZero()
	*@desc returns tax fraction
	*@param $x => number
	*/
	public static function makeZero($x){
    $x = ''.$x.'';
		$b = strlen($x);
		switch($b){
			case 2;
				$a = $x[0];
			break;
			case 3;
				$a = $x[0].''.$x[1];
			break;
			case 4;
				$a = $x[0].''.$x[1].''.$x[2];
			break;
			case 5;
				$a = $x[0].''.$x[1].''.$x[2].'0';
			break;
			case 6;
				$a = $x[0].''.$x[1].''.$x[2].''.$x[3].''.$x[4];
			break;
			default:
				$a = $x;
			break;
		}
		return number_format($a.'0',0).'+';
  }#end


	public static function getAge($dob){
		global $__;
		$now = explode('-', date('Y-m-d'));
    $dob = explode('-', $dob);
		$dif = $now[0] - $dob[0];
		if($dob[1] > $now[1]){ // birthday month has not hit this year
			$dif -= 1;
		}elseif($dob[1] == $now[1]){ // birthday month is this month, check day
			if($dob[2] > $now[2]) {
				$dif -= 1;
			}elseif($dob[2] == $now[2]){ // Happy Birthday!
				$dif = $dif.' '.$__::__('Happy Birthday!');
			};
    };
    return $dif;
  }#end


	public static function getNextBD($dob){
		global $__;
    $dob = explode('-', $dob);
		$dif = $dob[1] - date('m');
		if($dif > 0){
			return $__::__('in').' '.$dif.' '.$__::__('months');
		}else{
			if($dob[1] == date('m')){
				$dif = $dob[2] - date('d');
				if($dif > 0){
					return $__::__('in').' '.$dif.' '.$__::__('days');
				}else{
					return 'passed';
				}
			}else{
				return 'passed';
			}
		}
  }#end


	public static function validateDate($date, $format='Y-m-d H:i:s'){
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}#end


	public static function formatDate($indate, $format='Y-M-D'){
    $output = $indate;
    $year = ''; $month = ''; $day = '';
    switch(strtoupper($format)) {
      case 'D/M/Y':
          $split = explode('/', $indate);
          $year = $split[2];
          $month = $split[1];
          $day = $split[0];
      break;
      case 'Y-M-D':
        $split = explode('-', $indate);
        $year = $split[0]; $month = $split[1]; $day = $split[2];
      break;
      case 'Y-M-D':
        $output = $year.'-'.$month.'-'.$day;
      break;
      case 'D/M/Y':
        $output = $day.'/'.$month.'/'.$year;
      break;
    }
    return $output;
  }#end


  public static function formatDateReadable($minutes){
    $d = floor($minutes / 1440);
    $h = floor(($minutes - $d * 1440) / 60);
    $m = $minutes - ($d * 1440) - ($h * 60);

    $d = $d > 0?$d.' d ':'';
    $h = $h > 0?$h.' hr ':'';
    $m = $m > 0?$m.' min ':'';
    return $d.$h.$m;
  }#end


  /*
  *@name: daysBetween()
  *@desc: Returns all dates between two dates
  *@param: $x => startdate
  *@param: $y => enddate
  */
  public static function daysBetween($x, $y, $z='Y-m-d'){
  	$sTime = strtotime($x);
  	$eTime = strtotime($y);
  	$numDays = round(($eTime - $sTime) / 86400) + 1;
  	$days = array();
  	for($d=0; $d < $numDays; $d++){
  		$days[] = date($z, ($sTime + ($d * 86400)));
  	}
  	return $days;
  }

  /*
	*@name: addRemoveMinute()
	*@desc: add or remove a number of days from a date
	*@param: $x => number of minutes to add or remove
	*@param: $y => parse in a date or use current date
	*@usage Engine::addRemoveDay('+2');
	*/
	public static function addRemoveMinute($x, $y=''){
    global $dt;
		$y = empty($y)?$td:$y;
    $date = strtotime($x.' minutes', strtotime($y));
		$date = date('Y-m-d H:i:s', $date);
		return $date;
	}#end

  /*
	*@name: addRemoveDay()
	*@desc: add or remove a number of days from a date
	*@param: $x => number of days to add or remove
	*@param: $y => parse in a date or use current date
	*@usage Engine::addRemoveDay('+2');
	*/
	public static function addRemoveDay($x, $y=''){
    global $dt;
		$y = empty($y)?$dt:$y;
    $date = strtotime($x.' days', strtotime($y));
		$date = date('Y-m-d', $date);
		return $date;
	}#end


	/*
	*@name: addRemoveMonth()
	*@desc: add or remove a number of months from a date
	*@param: $x => number of months to add or remove
	*@param: $y => parse in a date or use current date
	*@usage Engine::addRemoveMonth('+2');
	*/
	public static function addRemoveMonth($x, $y=''){
    global $dt;
		$y = empty($y)?$dt:$y;
		$date = strtotime($x.' months' , strtotime($y));
		$date = date('Y-m-d', $date);
		return $date;
	}#end


	/*
	*@name: addRemoveYear()
	*@desc: add or remove a number of years from a date
	*@param: $x => number of years to add or remove
	*@param: $y => parse in a date or use current date
	*@usage Engine::addRemoveYear('+2');
	*/
	public static function addRemoveYear($x,$y=''){
    global $dt;
		$y = empty($y)?$dt:$y;
		$z = explode('-',$y);
		$year = $z[0] + $x;
		$date = $year.'-'.$z[1].'-'.$z[2];
		return $date;
	}#end


  /*
	*@name: daysOfSeven()
	*@desc: returns seven days from old from today
	*/
	public static function daysOfSeven(){
    global $dt;
    $seven = self::addRemoveDay('-6');
    return self::daysBetween($seven, $dt);
  }#end


	/*
	*@name: daysOfWeek()
	*@desc: returns passed days of week based on current day
	*/
	public static function daysOfWeek(){
    global $dt;
		$today = date('D');
		$today = strtolower($today);
		switch($today):
			case 'mon':
				return array( $dt );
			break;
			case 'tue':
				return array( self::addRemoveDay('-1'), $dt );
			break;
			case 'wed':
				return array( self::addRemoveDay('-2'),self::addRemoveDay('-1'), $dt );
			break;
			case 'thu':
				return array( self::addRemoveDay('-3'),self::addRemoveDay('-2'),self::addRemoveDay('-1'), $dt );
			break;
			case 'fri':
				return array( self::addRemoveDay('-4'),self::addRemoveDay('-3'),self::addRemoveDay('-2'),self::addRemoveDay('-1'), $dt );
			break;
			case 'sat':
				return array( self::addRemoveDay('-5'),self::addRemoveDay('-4'),self::addRemoveDay('-3'),self::addRemoveDay('-2'),self::addRemoveDay('-1'), $dt );
			break;
			case 'sun':
				return array( self::addRemoveDay('-6'),self::addRemoveDay('-5'),self::addRemoveDay('-4'),self::addRemoveDay('-3'),self::addRemoveDay('-2'),self::addRemoveDay('-1'), $dt );
			break;
			default:
				return array();
			break;
		endswitch;
	}#end


	/*
	*@name: monthsOfYear()
	*@desc: returns passed months of the current year
	*/
	public static function monthsOfYear(){
		$today = date('m');
		$today = strtolower($today);
		switch($today):
			case '1':
				return array( date('Y-m') );
			break;
			case '2':
				return array( self::addRemoveMonth('-1'), date('Y-m') );
			break;
			case '3':
				return array( self::addRemoveMonth('-2'),self::addRemoveMonth('-1'), date('Y-m') );
			break;
			case '4':
				return array( self::addRemoveMonth('-3'),self::addRemoveMonth('-2'),self::addRemoveMonth('-1'), date('Y-m') );
			break;
			case '5':
				return array( self::addRemoveMonth('-4'),self::addRemoveMonth('-3'),self::addRemoveMonth('-2'),self::addRemoveMonth('-1'), date('Y-m') );
			break;
			case '6':
				return array( self::addRemoveMonth('-5'),self::addRemoveMonth('-4'),self::addRemoveMonth('-3'),self::addRemoveMonth('-2'),self::addRemoveMonth('-1'), date('Y-m') );
			break;
			case '7':
				return array( self::addRemoveMonth('-6'),self::addRemoveMonth('-5'),self::addRemoveMonth('-4'),self::addRemoveMonth('-3'),self::addRemoveMonth('-2'),self::addRemoveMonth('-1'), date('Y-m') );
			break;
			case '8':
				return array( self::addRemoveMonth('-7'),self::addRemoveMonth('-6'),self::addRemoveMonth('-5'),self::addRemoveMonth('-4'),self::addRemoveMonth('-3'),self::addRemoveMonth('-2'),self::addRemoveMonth('-1'), date('Y-m') );
			break;
			case '9':
				return array( self::addRemoveMonth('-8'),self::addRemoveMonth('-7'),self::addRemoveMonth('-6'),self::addRemoveMonth('-5'),self::addRemoveMonth('-4'),self::addRemoveMonth('-3'),self::addRemoveMonth('-2'),self::addRemoveMonth('-1'), date('Y-m') );
			break;
			case '10':
				return array( self::addRemoveMonth('-9'),self::addRemoveMonth('-8'),self::addRemoveMonth('-7'),self::addRemoveMonth('-6'),self::addRemoveMonth('-5'),self::addRemoveMonth('-4'),self::addRemoveMonth('-3'),self::addRemoveMonth('-2'),self::addRemoveMonth('-1'), date('Y-m') );
			break;
			case '11':
				return array( self::addRemoveMonth('-10'),self::addRemoveMonth('-9'),self::addRemoveMonth('-8'),self::addRemoveMonth('-7'),self::addRemoveMonth('-6'),self::addRemoveMonth('-5'),self::addRemoveMonth('-4'),self::addRemoveMonth('-3'),self::addRemoveMonth('-2'),self::addRemoveMonth('-1'), date('Y-m') );
			break;
			case '12':
				return array( self::addRemoveMonth('-11'),self::addRemoveMonth('-10'),self::addRemoveMonth('-9'),self::addRemoveMonth('-8'),self::addRemoveMonth('-7'),self::addRemoveMonth('-6'),self::addRemoveMonth('-5'),self::addRemoveMonth('-4'),self::addRemoveMonth('-3'),self::addRemoveMonth('-2'),self::addRemoveMonth('-1'), date('Y-m') );
			break;
			default:
				return array();
			break;
		endswitch;
	}#end

}#endClass
