<?php
final class SQL
{

	public static function query($query, $params=array()){
		global $sql;
		return $sql->Execute($sql->Prepare($query), $params);
	}#end


	public static function select($query, $params=array(), $fetch='rows'){
		global $sql;
		$stmt = $sql->Execute($sql->Prepare($query), $params);
		if($stmt == false){
			return $sql->errorMsg();
		}else{
			if($stmt->RecordCount() > 0){
				switch($fetch){
					case 'rows':
						return $stmt->GetRows();
					break;
					case 'row':
						return $stmt->FetchRow();
					break;
				}
			}else{
				return array();
			}
		}
	}#end


	public static function insert($data=array(), $table){
		global $sql;
		$fields = array();
		$values = array();
		if(is_array($data) == true){
			foreach($data as $field => $value){
				$fields[] = $field;
				$values[] = $value;
				$params[] = $sql->Param('I');
			}
			$fields = implode(',', $fields);
			$params = implode(',', $params);
			$query  = 'INSERT INTO `'.$table.'` ('.$fields.') VALUES ('.$params.')';
			//echo($query).'<br/>'; die();
			return $sql->Execute($sql->Prepare($query), $values);
		}
	}#end


	public static function update($data=array(), $table, $where=array(), $ignore=FALSE){
		global $sql;
		$updates = array();
		$wheres  = array();
		if(is_array($data) == true && is_array($where) == true){
			foreach($data as $field => $value){
				$values[]  = $value;
				$updates[] = $ignore==FALSE ? $field.'=? ' : $field.'='.$value.' ';
			}
			foreach($where as $field => $value){
				$values[] = $value;
				$wheres[] = $ignore==FALSE ? $field.'=? ': $field.'='.$value.' ';
			}
			$updates = implode(',', $updates);
			$wheres  = implode('AND ', $wheres);
			$values  = $ignore==FALSE ? $values : array();
			$query	 = 'UPDATE `'.$table.'` SET '.$updates.' WHERE '.$wheres;
			//echo($query).'<br/>'; die();
			return $sql->Execute($sql->Prepare($query), $values);
		}
	}


	public static function delete($where=array(), $table, $dtype='WHERE'){
		global $sql;
		$wheres = array();
		if(is_array($where) == true){
			if($dtype == 'IN'){
				foreach($where as $field => $value){
					$values[] = $value;
					$wheres[] = $field.' IN (?)';
				}
			}else{
				foreach($where as $field => $value){
					$values[] = $value;
					$wheres[] = $field.'=? ';
				}
			}
			$wheres = implode('AND ', $wheres);
			$query  = 'DELETE FROM `'.$table.'` WHERE '.$wheres.'';
			//echo($query).'<br/>'; die();
			return $sql->Execute($sql->Prepare($query), $values);
		}
	}


  public static function lastId(){
		global $sql;
		return $sql->Insert_ID();
	}


	public static function errorMsg(){
		global $sql;
		return $sql->errorMsg();
	}


	public static function AUTO_INCREMENT($table){
		global $sql;
		$stmt = $sql->Execute($sql->Prepare('SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = "'.$table.'" AND table_schema = DATABASE();'));
		return $stmt->FetchNextObject()->AUTO_INCREMENT;
	}

}
