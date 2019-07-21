<?php

class BackRest
{

	public static function backup($server,$dbuser,$dbpass,$dtbase,$backup_file,$tables = '*'){
		$return  = '';
		$return .= '/*'."\n";
		$return .= 'Navicat MySQL Data Transfer'."\n\n";
		$return .= 'Source Server         : '.$_SERVER['HTTP_HOST']."\n";
		$return .= 'Source Host           : '.$_SERVER['HTTP_HOST'].':'.ini_get('mysqli.default_port')."\n";
		$return .= 'Source Database       : '.$dtbase.''."\n\n";
		$return .= 'Date: '.date('D-M-Y H:m:s',time()).''."\n";	
		$return .= '*/'."\n\n";
		$return .= 'SET FOREIGN_KEY_CHECKS=0;'."\n\n\n";
		$link = mysql_connect($server,$dbuser,$dbpass);
		@mysql_select_db($dtbase,$link);
		mysql_query("SET NAMES 'utf8'");
		if($tables == '*'){
			$tables = array();
			$result = mysql_query('SHOW TABLES');
			while($row = mysql_fetch_row($result)){
				$tables[] = $row[0];
			}
		}else{
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
		foreach($tables as $table){
			$result     = mysql_query('SELECT * FROM '.$table);
			$num_fields = mysql_num_fields($result);
			$return    .= 'DROP TABLE IF EXISTS `'.$table.'`;';
			$row2       = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
			$return    .= "\n".$row2[1].";\n\n";
			for ($i = 0; $i < $num_fields; $i++){
				while($row = mysql_fetch_row($result)){
					$return .= 'INSERT INTO `'.$table.'` VALUES (';
					for($j=0; $j<$num_fields; $j++){
						$row[$j] = addslashes($row[$j]);
						$row[$j] = str_replace('\n','\\n',$row[$j]);
						if(isset($row[$j])) { $return.= "'".$row[$j]."'" ; } else { $return.= "''"; }
						if($j<($num_fields-1)) { $return.= ','; }
					}
					$return .= ");\n";
				}
			}
			$return .="\n\n\n";
		}
		
		# backup file is been writting into
		$handle = fopen($backup_file,'w+');
		$write  = fwrite($handle,$return);
		if($write == true){
			fclose($handle);
			return true;
		}
	}#end
	
	
	public static function restore($server,$dbuser,$dbpass,$dtbase,$sql){
		$link = mysql_connect($server,$dbuser,$dbpass);
		@mysql_select_db($dtbase,$link);
		$sql = file_get_contents($sql);
		foreach(explode(";\n", $sql) as $sql) {
			$sql = trim($sql);
			if($sql){
				$cmd = mysql_query($sql);
			}
		}
		if($cmd == true){
			return true;
		}
	}

}