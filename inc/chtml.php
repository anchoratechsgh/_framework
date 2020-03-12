<?php

final class CHtml
{

	private static function attr($htmlOptions=array()){
		$finish = '';
		foreach($htmlOptions as $attr => $inattr):
			$finish .= $attr.'="'.$inattr.'" ';
		endforeach;
		return $finish;
	}#end


	private static function check($what, $htmlOptions=array()){
		if(array_key_exists($what, $htmlOptions) == true):
			return $what = $htmlOptions[$what];
		endif;
	}#end


	public static function create($tag='input', $htmlOptions=array()){
		switch(strtolower($tag)):
			case 'input':
				return self::input(self::attr($htmlOptions));
			break;
			case 'checkbox':
				return self::checkbox(self::attr($htmlOptions), $htmlOptions);
			break;
			case 'radio':
				return self::radio(self::attr($htmlOptions), $htmlOptions);
			break;
			case 'textarea':
				return self::textarea(self::attr($htmlOptions), $htmlOptions);
			break;
			case 'select':
				return self::select(self::attr($htmlOptions), $htmlOptions);
			break;
			case 'button':
				return self::button(self::attr($htmlOptions), $htmlOptions);
			break;
		endswitch;
	}#end


	public static function input($attr){
		echo '<input '.$attr.' />'."\n";
	}#end


	public static function checkbox($attr, $htmlOptions=array()){
		global $a, $b;
		$options = explode(',', self::check('options', $htmlOptions));
		$name = self::check('name', $htmlOptions);
		$value = self::check('value', $htmlOptions);
		if(is_array($value) == false){
			$value = explode(',', $value);
		}
		foreach($options as $key => $opt):
			echo '<label class="pointer" style="font-weight:normal; margin-right:10px;" for="'.$name.'_'.$a++.'"><input id="'.$name.'_'.$b++.'" '.((in_array($opt, $value))?'checked':'').' type="checkbox" value="'.$opt.'" '.$attr.' /> '.$opt.'</label>'."\n";
		endforeach;
	}#end


	public static function radio($attr, $htmlOptions=array()){
		global $a, $b;
		$options = explode(',', self::check('options', $htmlOptions));
		$name = self::check('name', $htmlOptions);
		$value = self::check('value', $htmlOptions);
		if(is_array($value) == false){
			$value = explode(',', $value);
		}
		foreach($options as $key => $opt):
			echo '<label class="pointer" style="font-weight:normal; margin-right:10px;" for="'.$name.'_'.$a++.'"><input id="'.$name.'_'.$b++.'" '.((in_array($opt, $value))?'checked':'').' type="radio" value="'.$opt.'" '.$attr.' /> '.$opt.'</label>'."\n";
		endforeach;
	}#end


	public static function textarea($attr, $htmlOptions=array()){
		$value = self::check('value', $htmlOptions);
		echo '<textarea '.$attr.'">'.$value.'</textarea>'."\n";
	}#end


	public static function select($attr, $htmlOptions=array()){
		$options = explode(',', self::check('options', $htmlOptions));
		$value = self::check('value', $htmlOptions);
		echo '<select '.$attr.'>'."\n";
		foreach($options as $key => $opt):
			echo '<option '.(($value==$opt)?'selected':'').' value="'.$opt.'">'.ucwords($opt).'</option>'."\n";
		endforeach;
		echo '</select>'."\n";
	}#end


	public static function button($attr, $htmlOptions=array()){
		$title = self::check('title', $htmlOptions);
		echo '<button '.$attr.'>'.$title.'</button>'."\n";
	}#end


	public static function meta($metaOptions=array()){
		echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">'."\n";
		echo '<meta name="robots" content="noodp"/>'."\n";
		if(array_key_exists('locale', $metaOptions)){
			echo '<meta property="og:locale" content="'.$metaOptions['locale'].'" />'."\n";
		}
		if(array_key_exists('keywords', $metaOptions)){
			echo '<meta name="keywords" content="'.$metaOptions['keywords'].'" />'."\n";
			echo '<meta property="og:keywords" content="'.$metaOptions['keywords'].'" />'."\n";
		}
		if(array_key_exists('description', $metaOptions)){
        echo '<meta name="description" content="'.$metaOptions['description'].'" />'."\n";
        echo '<meta property="og:description" content="'.$metaOptions['description'].'" />'."\n";
		}
		if(array_key_exists('url', $metaOptions)){
			echo '<link rel="canonical" href="'.$metaOptions['url'].'" />'."\n";
		}
		if(array_key_exists('title', $metaOptions)){
			echo '<meta property="og:title" content="'.$metaOptions['title'].'" />'."\n";
		}
		if(array_key_exists('url', $metaOptions)){
			echo '<meta property="og:url" content="'.$metaOptions['url'].'" />'."\n";
		}
		if(array_key_exists('site_name', $metaOptions)){
			echo '<meta property="og:site_name" content="'.$metaOptions['site_name'].'" />'."\n";
		}
		if(array_key_exists('type', $metaOptions)){
			echo '<meta property="og:type" content="'.$metaOptions['type'].'" />'."\n";
		}
		if(array_key_exists('publisher', $metaOptions)){
			echo '<meta property="article:publisher" content="'.$metaOptions['publisher'].'" />'."\n";
		}
		if(array_key_exists('image', $metaOptions)){
			echo '<meta property="og:image" content="'.$metaOptions['image'].'" />'."\n";
		}
		if(array_key_exists('favicon', $metaOptions)){
			echo '<link href="'.$metaOptions['image'].'" rel="shortcut icon">';
		}
		//echo '<meta property="og:image:width" content="400" />';
		//echo '<meta property="og:image:height" content="400" />';
		echo '<link rel="author" href="http://anchoratechs.com" />'."\n";
	}


	public static function script($tag='open'){
		switch($tag):
			case 'open':
				echo '<script type="text/javascript" language="javascript">'."\n";
				echo '/*<![CDATA[*/'."\n";
			break;

			case 'close':
				echo '/*]]>*/'."\n";
				echo '</script>'."\n";
			break;
		endswitch;
	}


	public static function style($tag='open'){
		switch($tag):
			case 'open':
				echo '<style type="text/css">'."\n";
				echo '/*<![CDATA[*/'."\n";
			break;

			case 'close':
				echo '/*]]>*/'."\n";
				echo '</style>'."\n";
			break;
		endswitch;
	}


	public static function aempty($name='alwaysEmpty',$type='email'){
		return self::create('input', array(
			'name'=>$name,
			'id'=>$name,
			'type'=>$type,
			'style'=>'display:none;'
		));
	}

	public static function printFrame($path, $id='printframe', $height=700){
		return '<iframe allowtransparency="1" frameborder="0" src="'.$path.'" id="'.$id.'" name="'.$id.'" style="border-radius:4px;width:100%; height:'.$height.'px; border:1px #000000 solid; padding:20px 10px 30px 10px;"></iframe>';
	}

	public static function print_r($data=array(), $die='yes'){
		echo '<pre>'; print_r($data); echo '</pre>';
		if($die == 'yes'){ die(); }
	}

	public static function json_encode($data=array(), $die='yes') {
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data, true);
		if($die == 'yes'){ die(); }
	}

	public static function requiredList($list=[]) {
			$empty = [];
			foreach($list as $var => $val){
					if(empty($val) == true || $val == '%') {
							$empty[] = '`'.$var.'`';
					}
			}
			return count($empty) > 0?implode(', ', $empty):false;
	}


}#endClass
