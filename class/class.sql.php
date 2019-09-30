<?php
final class SQL
{

	private static function rows($data=[], $fetch='rows'){
		global $sql; $rows = [];
		switch($fetch) {
			case 'row':
				foreach($data as $k => $r) {
					if(is_numeric($k) == false) {
						$rows[$k] = $r;
					}
				}
			break;
			default:
				foreach($data as $rw) {
					$row = [];
					foreach($rw as $k => $r) {
						if(is_numeric($k) == false) {
							$row[$k] = $r;
						}
					}
					$rows[] = $row;
				}
			break;
		}
		return $rows;
	}#end


	public static function query($query, $params=[]){
		global $sql;
		return $sql->Execute($sql->Prepare($query), $params);
	}#end


	public static function select($query, $params=[], $fetch='rows'){
		global $sql;
		$stmt = $sql->Execute($sql->Prepare($query), $params);
		if($stmt == false){
			return $sql->errorMsg();
		}else{
			if($stmt->RecordCount() > 0){
				switch($fetch){
					case 'rows':
						return self::rows($stmt->GetRows());
					break;
					case 'row':
						return self::rows($stmt->FetchRow(), 'row');
					break;
				}
			}else{
				return [];
			}
		}
	}#end


	public static function insert($data=[], $table){
		global $sql;
		$fields = [];
		$values = [];
		if(is_array($data) == true){
			foreach($data as $field => $value){
				$fields[] = '`'.$field.'`';
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


	public static function update($data=[], $table, $where=[], $ignore=FALSE){
		global $sql;
		$updates = [];
		$wheres  = [];
		if(is_array($data) == true && is_array($where) == true){
			foreach($data as $field => $value){
				$values[]  = $value;
				$updates[] = $ignore==FALSE ? '`'.$field.'` = ? ' : '`'.$field.'` = '.$value.' ';
			}
			foreach($where as $field => $value){
				$values[] = $value;
				$wheres[] = $ignore==FALSE ? '`'.$field.'` = ? ': '`'.$field.'` = '.$value.' ';
			}
			$updates = implode(',', $updates);
			$wheres  = implode('AND ', $wheres);
			$values  = $ignore == FALSE ? $values : [];
			$query	 = 'UPDATE `'.$table.'` SET '.$updates.' WHERE '.$wheres;
			//echo($query).'<br/>'; die();
			return $sql->Execute($sql->Prepare($query), $values);
		}
	}


	public static function delete($where=[], $table, $dtype='WHERE'){
		global $sql;
		$wheres = [];
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
