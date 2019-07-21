<?php

final class txt
{
	
	private $avatar;
	private $x, $y;
	private $var;
	
	public static function avatar($x){
		$y = strtolower($x[0]);
		
		$var = array(
			'a'=>'63d6d1', 'g'=>'3498db', 'm'=>'a5ce78', 's'=>'166d83', 'y'=>'a5ce78',
			'b'=>'edb542', 'h'=>'9b59b6', 'n'=>'eaa642', 't'=>'34495e', 'z'=>'1d92af',
			'c'=>'41c3ac', 'i'=>'34495e', 'o'=>'f76447', 'u'=>'b3d4fc',
			'd'=>'af4d32', 'j'=>'e67e22', 'p'=>'b3d4fc', 'v'=>'c0392b',
			'e'=>'daab85', 'k'=>'c0392b', 'q'=>'dc9814', 'w'=>'c09c28',
			'f'=>'1abc9c', 'l'=>'336E7B', 'r'=>'1d92af', 'x'=>'af4d32',
		);
		
		$avatar = '<span style="background:#'.$var[$y].';border-radius: 50%;font-size: 25px;height: 55px;line-height: 50px;width: 55px; color:#fff;" class="badge txt_avatar">'.strtoupper($y).'</span>';
		
		return $avatar;
		
	}#end

}#endClass
