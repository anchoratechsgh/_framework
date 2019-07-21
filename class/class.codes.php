<?php
/*
*@name : genCode
*@desc : generates a new incremental number code
*@param  $code  =>
*@param  $field => table field
*@param  `$table` => database table
*@param  $subs  => string length of $code (int)
*@e.g  : genCode::threeDigits('HSV_CUST','CUST_CODE','hvpos_customer',8);
*@author  Anchora Technologies
*/

final class genCode
{

	private $code;
	private $field;
	private $table;
	private $subs;


	public static function twoDigits($code, $field, $table){
		global $sql;
		$stmt = $sql->Execute($sql->Prepare("SELECT $field FROM `$table` WHERE $field LIKE '$code%' ORDER BY $field DESC LIMIT 1"));
		if($stmt->RecordCount() == 1){
			$row   = $stmt->FetchRow();
			$order = substr($row[$field], strlen($code), 100);
			$order = $order + 1;
			if(strlen($order) == 1){
				$orderno = $code.'0'.$order;
			}else{
				$orderno = $code.$order;
			}
		}else{
			$orderno = $code.'01';
		}
		return $orderno;
	}#end


	public static function threeDigits($code, $field, $table){
		global $sql;
		$stmt = $sql->Execute($sql->Prepare("SELECT $field FROM `$table` WHERE $field LIKE '$code%' ORDER BY $field DESC LIMIT 1"));
		if($stmt->RecordCount() == 1){
			$row   = $stmt->FetchRow();
			$order = substr($row[$field], strlen($code), 100);
			$order = $order + 1;
			if(strlen($order) == 1){
				$orderno = $code.'00'.$order;
			}else if(strlen($order) == 2){
				$orderno = $code.'0'.$order;
			}else{
				$orderno = $code.$order;
			}
		}else{
			$orderno = $code.'001';
		}
		return $orderno;
	}#end


	public static function fourDigits($code, $field, $table){
		global $sql;
		$stmt = $sql->Execute($sql->Prepare("SELECT $field FROM `$table` WHERE $field LIKE '$code%' ORDER BY $field DESC LIMIT 1"));
		if($stmt->RecordCount() == 1){
			$row   = $stmt->FetchRow();
			$order = substr($row[$field], strlen($code), 100);
			$order = $order + 1;
			if(strlen($order) == 1){
				$orderno = $code.'000'.$order;
			}else if(strlen($order) == 2){
				$orderno = $code.'00'.$order;
			}else if(strlen($order) == 3){
				$orderno = $code.'0'.$order;
			}else{
				$orderno = $code.$order;
			}
		}else{
			$orderno = $code.'0001';
		}
		return $orderno;
	}#end


	public static function fiveDigits($code, $field, $table){
		global $sql;
		$stmt = $sql->Execute($sql->Prepare("SELECT $field FROM `$table` WHERE $field LIKE '$code%' ORDER BY $field DESC LIMIT 1"));
		if($stmt->RecordCount() == 1){
			$row   = $stmt->FetchRow();
			$order = substr($row[$field], strlen($code), 100);
			$order = $order + 1;
			if(strlen($order) == 1){
				$orderno = $code.'0000'.$order;
			}else if(strlen($order) == 2){
				$orderno = $code.'000'.$order;
			}else if(strlen($order) == 3){
				$orderno = $code.'00'.$order;
			}else if(strlen($order) == 4){
				$orderno = $code.'0'.$order;
			}else{
				$orderno = $code.$order;
			}
		}else{
			$orderno = $code.'00001';
		}
		return $orderno;
	}#end


	public static function sixDigits($code, $field, $table){
		global $sql;
		$stmt = $sql->Execute($sql->Prepare("SELECT $field FROM `$table` WHERE $field LIKE '$code%' ORDER BY $field DESC LIMIT 1"));
		if($stmt->RecordCount() == 1){
			$row = $stmt->FetchRow();
			$order = substr($row[$field], strlen($code), 100);
			$order = $order + 1;
			if(strlen($order) == 1){
				$orderno = $code.'00000'.$order;
			}else if(strlen($order) == 2){
				$orderno = $code.'0000'.$order;
			}else if(strlen($order) == 3){
				$orderno = $code.'000'.$order;
			}else if(strlen($order) == 4){
				$orderno = $code.'00'.$order;
			}else if(strlen($order) == 5){
				$orderno = $code.'0'.$order;
			}else{
				$orderno = $code.$order;
			}
		}else{
			$orderno = $code.'000001';
		}
		return $orderno;
	}


	public static function nineDigits($code, $field, $table){
		global $sql;
		$stmt = $sql->Execute($sql->Prepare("SELECT $field FROM `$table` WHERE $field LIKE '$code%' ORDER BY $field DESC LIMIT 1"));
		if($stmt->RecordCount() == 1){
			$obj = $stmt->FetchRow();
			$order = substr($row[$field], strlen($code), 100);
			$order = $order + 1;
			if(strlen($order) == 1){
				$orderno = $code.'00000000'.$order;
			}else if(strlen($order) == 2){
				$orderno = $code.'0000000'.$order;
			}else if(strlen($order) == 3){
				$orderno = $code.'000000'.$order;
			}else if(strlen($order) == 4){
				$orderno = $code.'00000'.$order;
			}else if(strlen($order) == 5){
				$orderno = $code.'0000'.$order;
			}else if(strlen($order) == 6){
				$orderno = $code.'000'.$order;
			}else if(strlen($order) == 7){
				$orderno = $code.'00'.$order;
			}else if(strlen($order) == 8){
				$orderno = $code.'0'.$order;
			}else{
				$orderno = $code.$order;
			}
		}else{
			$orderno = $code.'000000001';
		}
		return $orderno;
	}#end


    public static function zeroDigits($code, $field, $table){
		global $sql;
		$stmt = $sql->Execute($sql->Prepare("SELECT $field FROM `$table` WHERE $field LIKE '$code%' ORDER BY $field DESC LIMIT 1"));
		if($stmt->RecordCount() == 1){
			$obj = $stmt->FetchRow();
			$order = substr($row[$field], strlen($code), 100);
			$order = $order + 1;
			$orderno = $code.$order;
		}else{
			$orderno = $code.'1';
		}
		return $orderno;
	}#end


	public static function timeDigits($code, $length=3){
		$rand = Engine::randNumb($length);
		return $code.$rand.time();
	}#end


}#endClass
