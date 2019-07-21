<?php
class BackRest
{

	public static function backup($tables='*', $file=BACKUP_FILE, $encrypt=true){
		global $sql, $td;
		$output  = '';
		$output .= '/*'."\n";
		$output .= 'Anchora Technologies Backup File'."\n\n";
		$output .= 'Source Server         : '.$_SERVER['HTTP_HOST']."\n";
		$output .= 'Source Host           : '.SERVER.':'.ini_get('mysqli.default_port')."\n";
		$output .= 'Source Database       : '.DTBASE.''."\n\n";
		$output .= 'Date: '.date('D-M-Y H:i:s', strtotime($td)).''."\n";
		$output .= '*/'."\n\n";
		$output .= 'SET FOREIGN_KEY_CHECKS=0;'."\n\n\n";
		$stmt = $sql->Execute($sql->Prepare("SET NAMES 'utf8'"));
		if($tables == '*'){
			$tables = array();
			$result = $sql->Execute($sql->Prepare("SHOW TABLES"));
			while($row = $result->FetchRow()){
				$tables[] = $row[0];
			}
		}else{
			$tables = is_array($tables) ? $tables : explode(',', $tables);
		}
		foreach($tables as $table){
            $result = $sql->Execute($sql->Prepare("SELECT * FROM ".$table));
			$num_fields = $result->FieldCount();
			$output .= '-- ----------------------------'."\n";
            $output .= '-- Table structure for '.$table."\n";
            $output .= '-- ----------------------------'."\n";
			$output .= 'DROP TABLE IF EXISTS `'.$table.'`;'."\n";
			$stmt = $sql->Execute($sql->Prepare("SHOW CREATE TABLE ".$table));
			$row2 = $stmt->FetchRow();
			$output .= $row2[1].";\n\n";
			$output .= '-- ----------------------------'."\n";
            $output .= '-- Records of '.$table."\n";
            $output .= '-- ----------------------------'."\n";
			while($row = $result->FetchRow()){
				$output .= 'INSERT INTO `'.$table.'` VALUES (';
				for($j=0; $j < $num_fields; $j++){
					$row[$j] = str_replace("\n", "\\n", $row[$j]);
                    $row[$j] = str_replace("\r", "\\r", $row[$j]);
					if(isset($row[$j])) { $output .= "'".str_replace("'", "\'", $row[$j])."'" ; } else { $output .= "''"; }
					if($j < ($num_fields -1)) { $output .= ','; }
				}
				$output .= ");\n";
			}
			$output .= "\n\n\n";
		}
        $output .= 'SET FOREIGN_KEY_CHECKS = 1;'."\n\n";
		$output .= '--- END OF FILE : '.date('D-M-Y H:i:s', strtotime($td));
		$output = $encrypt == true?_md5($output):$output;
        
		# backup file is been writting into
		$handle = fopen($file, 'w+');
		$write  = fwrite($handle, $output);
		if($write == true){
			fclose($handle);
			return true;
		}
	}#end


	public static function restore($x, $y=";\n", $encrypted=true){
		global $sql;
		$x = file_get_contents($x);
		$x = $encrypted == true?md5_($x):$x;
		foreach(explode($y, $x) as $x) {
			$x = trim($x);echo'<pre>'; echo $x; die();
			$cmd = $sql->Execute($sql->Prepare($x));
		}
		return $cmd;
	}

}
