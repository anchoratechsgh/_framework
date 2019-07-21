<?php $alert = new Alert();

class Alert
{
	
	public static function alertMsg($msg,$status,$style='alert alert'){
		
		if(!empty($status) && !empty($msg)){
			
			if($style == 'callout'){ $style = 'callout callout'; }
			switch($status){
				
				case 'success':
					echo'
						<div class="text-center '.$style.'-success fill alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<i class="fa fa-check-circle"></i> '.$msg.'
						</div>
						';
				break;
				
				case 'error':
					echo'
						<div class="text-center '.$style.'-danger fill">
							<button class="close" data-dismiss="alert"><span>×</span></button>
							<i class="fa fa-times-circle"></i> '.$msg.'
						</div>
						';
				break;
				
				case 'warning':
					echo '
						<div class="text-center '.$style.'-warning fill">
							<button data-dismiss="alert" class="close"><span>×</span></button>
							<i class="fa fa-exclamation-circle"></i> '.$msg.'
						</div>';
				break;
				
				case 'info':
					echo '
						<div class="text-center '.$style.'-info fill">
							<button data-dismiss="alert" class="close"><span>×</span></button>
							<i class="fa fa-check-circle"></i> '.$msg.'
						</div>';
				break;
				
			}#endSwitch
			
		}#endIf
		
   }#end
   
}#endClass