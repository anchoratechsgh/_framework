<!-- / START:: Anchora Technologies' Custom Scripts / -->
<input name="maxLenght" class="maxLenght" type="hidden" value="<?php echo _md5('maxLenght') ?>" />
<?php CHtml::script('open'); ?>
$(document).ready(function(){
$('body').bind('cut copy paste', function (e) {
    //e.preventDefault();
});
$("body").on("contextmenu",function(e){
    //return false;
});
$(document).keydown(function (event) {
    if (event.keyCode == 123) {
        //return false;
    }
    else if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74)) {
        //return false;
    }
});
/*var isCtrl = !1;
document.onkeyup = function(a) {
   17 == a.which && (isCtrl = !1)
}, document.onkeydown = function(a) {
   if (17 == a.which && (isCtrl = !0), 85 == a.which || 67 == a.which && 1 == isCtrl) return !1
};*/
// BOOTSTRAP-DATEPICKER : DATEPICKER
if($.isFunction($.fn.datepicker)){
	$('.datepicker').addClass('pointer').attr('placeholder', 'YYYY-MM-DD');
	$('.monthpicker').addClass('pointer').attr('placeholder', 'YYYY-MM');
    $('.yearpicker').addClass('pointer').attr('placeholder', 'YYYY');
	// slideDown fadein blind bounce clip drop fold slide
	$('.datepicker').datepicker({
		showAnim: 'clip',
		autoclose: true,
		todayHighlight: true,
		format:'yyyy-mm-dd',
		dateFormat:'yy-mm-dd'
	});

	// MONTHPICKER
	$('.monthpicker').datepicker({
		viewMode: 'months',
		minViewMode: 'months',
		todayHighlight: true,
		autoclose: true,
		format: 'yyyy-mm',
		dateFormat:'yy-mm'
	});

    // YEARPICKER
	$('.yearpicker').datepicker({
		viewMode: 'years',
		minViewMode: 'years',
		todayHighlight: true,
		autoclose: true,
		format: 'yyyy',
		dateFormat:'yy'
	});
}

// DATETIMEPICKER
if($.isFunction($.fn.datetimepicker)){
    $('.timepicker').addClass('pointer').attr('placeholder', 'HH-MM');;
	$('.timepicker').datetimepicker({
		format: 'HH:mm:00',
	});
	$('.datetimepicker').datetimepicker({
		showAnim: 'bounce',
		autoclose: true,
		todayHighlight: true,
		format:'yyyy-mm-dd HH:mm:ss'
	});
}

// TIMEPICKER
if($.isFunction($.fn.timepicker)){
	$('.timepicker').addClass('pointer').attr('placeholder', 'HH-MM');;
	$('.timepicker').timepicker({
		showMeridian: false
	});
}

// DATATABLE
if($.isFunction($.fn.dataTable)){
	$('.datatable').dataTable( {
		'aoColumnDefs': [{
			'bSortable': true,
			'aTargets': [-1]
		}],
		'language': {
			'paginate': {
				'previous': '<?php echo Sprache::__('Previous') ?>',
				'next': '<?php echo Sprache::__('Next') ?>'
			},
			'lengthMenu': '<?php //echo Sprache::__('Display') ?> _MENU_ <?php //echo Sprache::__('records') ?>',
			'emptyTable': '<?php echo Sprache::__('No records found') ?>',
			'info': '<?php echo Sprache::__('Showing page') ?> _PAGE_ <?php echo Sprache::__('of') ?> _PAGES_',
			'infoEmpty': '<?php echo Sprache::__('No entries to show') ?>',
			'search': '<?php //echo Sprache::__('Search') ?>'
		},
		'iDisplayLength': 25,
			'aLengthMenu': [
				[25, 50, 100, 250, -1],
				[25, 50, 100, 250, '<?php echo Sprache::__('All') ?>']
			],
	});

}

// SELECT 2
if($.isFunction($.fn.select2)){
    $('.select2').select2({
		width: '100%'
	});
}

// CHOSEN-SELECT
if($.isFunction($.fn.chosen)){
	$('.chosen-select').chosen();
}

// INPUT MASKS
if($.isFunction($.fn.mask)){
	$('.accountno').mask('999-999-999');
	$('.masktime').mask('99:99:**', {
		//placeholder: 'HH:II:SS'
	});
	$('.maskmonth').mask('9999-99', {
		//placeholder: 'YYYY-MM'
	});
}

// TAGS INPUT
if($.isFunction($.fn.tagsinput)){
	$('.tagsinput').tagsinput({width:'100%'})
}

// SLIMSCROLL EFFECT
if($.isFunction($.fn.slimscroll)){
	$('.slimscroll').slimscroll({
		height: '200px'
	});
    $('.slimscroll450').slimscroll({
		height: '450px'
	});
}

// MULTI SELECT
if($.isFunction($.fn.multiSelect)){
	$('.multiSelect').multiSelect();
}

// FILE INPUT
if($.isFunction($.fn.fileinput)){
	$('.fileinput').fileinput({
		'showUpload': false,
		'showCaption':false,
		'showPreview':true,
		'showRemove':false,
		'showCancel':false,
		'showClose':false,
		'initialPreviewShowDelete':false,

	});
}

// COLOR PICKER
if($.isFunction($.fn.colorpicker)){
    $('.colorpicker').colorpicker();
	$('.colorpicker-rgba').colorpicker({
        format: 'rgba',
        horizontal: true
    });
}

// CODE MIRROR / SOURCE CODE VIEWER
if(  $('#codemirror') ){
	/**var textarea = document.getElementById('codemirror');
	setTimeout(function(){
		CodeMirror.fromTextArea(textarea, {
			lineNumbers: true,
			matchBrackets: true,
			styleActiveLine: true
		});
	}, 500);**/
}

// SUMMERNOTE
if($.isFunction($.fn.summernote)){
	$('.summernote').summernote({
		height: 250
	});

	$('.summernoteToolbar').summernote({
		height: 250,
		toolbar: [
                ['headline', ['style']],
                ['style', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
                ['textsize', ['fontsize']],
                ['alignment', ['ul', 'ol', 'paragraph', 'lineheight']],
            ]
        });

	$('.summernoteAirmode').summernote({
		height: 250,
		airMode: true,
	});

}

// AUTO CAPS KEYS
$('.autocaps').keyup(function(e) {
	'use strict';
    $(this).val( $(this).val().toUpperCase() );
});

// AUTO LOWER KEYS
$('.autolower').keyup(function(e) {
	'use strict';
    $(this).val( $(this).val().toLowerCase() );
});

// TOGGLE CHECK/UNCHECK ALL CHECK BOXES
$('.autoCheck').click(function() {
    if( $(this).is(':checked') ){
		checkAll();
	}else{
		unCheckAll();
	}
});

// ALLOW ONLY NUMBERS
if($('.onlynums')){
	$('.onlynums').keyup(function(event){
        this.value = this.value.replace(/[^0-9\./*+-]/g,'');
	});
    $('.onlynums').keydown(function(event){
        this.value = this.value.replace(/[^0-9\./*+-]/g,'');
	});
    $('.onlynums').keypress(function(event){
        this.value = this.value.replace(/[^0-9\./*+-]/g,'');
	});
}

// PREVENT COPY/PASTE
$('.nopaste').bind('copy paste', function (e) {
	e.preventDefault();
});

// SPINNERS
$('.fspinner').html('<?php echo fspinner(); ?>');
$('.fspinner-sm').html('<?php echo fspinner_sm(); ?>');

// PREVENT SPACING
$('.nospace').keydown(function(e){
	'use strict';
	$('.nospace').keyup(function(event){
        this.value = this.value.replace(/ /g,'');
	});
    $('.nospace').keydown(function(event){
        this.value = this.value.replace(/ /g,'');
	});
    $('.nospace').keypress(function(event){
        this.value = this.value.replace(/ /g,'');
	});
});

});

// CHECK ALL CHECK BOXES
function checkAll(){
	'use strict';
	$('input[type=checkbox]').each(function() {
		$(this).prop('checked', true);
    });
}

// UNCHECK ALL CHECK BOXES
function unCheckAll(){
	'use strict';
	$('input[type=checkbox]').each(function() {
		$(this).prop('checked', false);
    });
}

// ACTIVATE/DEACTIVATE ELEMENT WITH CHECKBOXES
function hsCheck(hsCheck,hsElemt){
	if( $(hsCheck).is(':checked') ){
		$(hsElemt).show();
	}else{
		$(hsElemt).hide();
	}
};

// CHECK IF THE BROWSER IS INTERNET EXPLORER
function CheckIsIE(){
	'use strict';
	if(navigator.appName.toUpperCase() === 'MICROSOFT INTERNET EXPLORER'){
		return true;
	}else{
		return false;
	}
}

// PRINT IFRAME CONTENT
function clicktoPrint(){
	'use strict';
	var iframe = true;
	try{
		if (CheckIsIE() === true){
			iframe = document.getElementById('printframe');
			iframe.contentWindow.document.execCommand('print', false, null);
		}else{
			window.printframe.focus();
			window.printframe.print();
		}

	}catch(e){
		window.printframe.focus();
		window.printframe.print();
	}
}

function clicktoPrintEach(frame){
	'use strict';
	var iframe = true;
	try{
		if (CheckIsIE() === true){
			iframe = document.getElementById(frame);
			iframe.contentWindow.document.execCommand('print', false, null);
		}else{
			window.printframe.focus();
			window.printframe.print();
		}

	}catch(e){
		window.printframe.focus();
		window.printframe.print();
	}
}

function printFrame(id) {
	var frm = document.getElementById(id).contentWindow;
	frm.focus();
	frm.print();
	return false;
}

// LOCAL TIME
var localClock = $('#localClock');
var time = localClock.text();
if (localClock.length > 0) {
	var parts   = time.split(':'),
        newTime = new Date(),
        timeDifference  = new Date().getTime() - newTime.getTime();
    newTime.setHours(parseInt(parts[0], 10));
    newTime.setMinutes(parseInt(parts[1], 10));
    newTime.setSeconds(parseInt(parts[2], 10));
    var methods = {
        displayTime: function () {
			'use strict';
            var now = new Date(new Date().getTime() - timeDifference);
            localClock.text([
                methods.leadZeros(now.getHours(), 2),
                methods.leadZeros(now.getMinutes(), 2),
                methods.leadZeros(now.getSeconds(), 2)
            ].join(':'));
            setTimeout(methods.displayTime, 1000);
        },
        leadZeros: function (time, width) {
			'use strict';
            while (String(time).length < width) {
                time = '0' + time;
            }
            return time;
        }
    };
    methods.displayTime();
}

// SERVER TIME
setInterval(function(){
	$('#serverCloc').load('<?php echo '?action='.md5('serverClock') ?>');
},1000);

// OPEN NEW WINDOW
function openWindow(url,pagename,width,height) {
	if(width == ''){
		var width = 950;
	}
	if(height==''){
		var height = 630;
	}
	var centerWidth = (window.screen.width - width) / 2;
    var centerHeight = (window.screen.height - height) / 2;
	newWindow = window.open(url, pagename, 'toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=0,width=' + width +
        ',height=' + height +
        ',left=' + centerWidth +
        ',top=' + centerHeight);
    newWindow.focus();
    return newWindow.name;
}

// VALIDATE FORM INPUTS
function validateForm(){
	var valid_state = true;
    var stage = arguments[0];
	var arg  = new Array();
    for (var i=1; i < arguments.length; i++) {
		if(i == stage){
			for(var j=0; j < arguments[i].length; j++){
            	//var $input = $('[name='+arguments[i][j]+']');
                var $input = $('#'+arguments[i][j]);
				$input.closest('.form-group').removeClass('has-error');
				var sval = $input;
				var type = ($input.is('select'))?'select':$input.attr('type');
				switch(type){
					case 'text':
  						if($input.attr('placeholder') == 'dd/mm/yyyy'){
  							if(!isValidDate(sval.val())){
  								$input.closest('.form-group').removeClass('has-success').addClass('has-error');
  								valid_state = false;
  							}
  						}else{
							if(sval.val() == ''){
                                 $input.closest('.form-group').removeClass('has-success').addClass('has-error');
                                 valid_state = false;
                            }
                        }
					break;

					case 'checkbox':
					   if(sval.checked !=1){
					       $input.closest('.form-group').removeClass('has-success').addClass('has-error');
					       valid_state = false;
					   }
					break;

					case 'select':
					   if(sval.val() == '-1' || sval.val() == '0' || sval.val() == ''){
					       $input.closest('.form-group').removeClass('has-success').addClass('has-error');
					       valid_state = false;
					   }
					break;

                    case 'file':
                    var re = /(\.jpg|\.jpeg|\.bmp|\.gif|\.png)$/i;
                    if(!re.exec(sval.val())){
                    	if($('p')){
							$('p').html(function(){
								$('p').html($('p').html().replace('Attachment is required.', ''));
								$('p').html($('p').html().replace('msg', ''));
							});
						}
							$input.closest('.form-group').removeClass('has-success').addClass('has-error');
							//$('[name='+arguments[i][j]+']').after('<p>Attachment is required.</p>');
							valid_state = false;
                        }
                    break;

					}
				}
			}
    }
 return valid_state;
}

function validateEmpty(x){
	var c = 0;
    $(x).each(function(){
    	if( $.trim($(this).val()).length === 0 ){
        	c++;
        }
    });
    return c;
}

// MAX-LENGHT COUNTDOWN
function maxlength() {
	'use strict';
	var typed = $('.maxlength').val().length;
    var maxlength = $(this).attr('maxlength');
	var remaining = maxlength - typed;
	$('.countDown').text(typed +'/'+ maxlength + ' <?php echo Sprache::__('characters remaining'); ?>');
}
$(document).ready(function($) {
	'use strict';
	$('.maxlength').change( maxlength );
	$('.maxlength').keyup( maxlength );
});

/*
*@name  taxrate()
*@desc  calculate tax rate
*@param $x => percentage tax
*@param $y => selling price
*/
function taxrate($x,$y){
	$a = ($x / 100) + 1;
	$b = $y / $a;
	$c = $y - $b;
	return $c;
}

/*
*@name  profitaftertax()
*@desc  to calculate profit after tax
*@param $x => percentage tax
*@param $y => selling price
*@param $z => cost price
*/
function profitaftertax($x,$y,$z){
	'use strict';
	$a = $y - taxrate($x,$y);
	$b = $a - $z;
	return $b;
}

/*
*@name taxFraction()
*@desc returns tax fraction
*@param $x => tax rate
*/
function taxFraction($x){
	'use strict';
	$a = $x / 100;
  	$b = 1 + $a;
	$c = $a / $b;
	return $c;
}

/*
*@name calcPercent()
*@desc calculated the percentage off a number
*@param $x => number to be calculated
*@param $y => percentage value
*/
function calcPercent($x, $y){
	$a = $x * $y;
	$a = $a / 100;
	$a = $x - $a;
	return $a;
}

function fileinput(x, y){
	$(y).show('slow');
	if(x.files && x.files[0]){
		var reader = new FileReader();
		reader.onload = function(e){
			$(y).attr('src', e.target.result);
		}
		reader.readAsDataURL(x.files[0]);
	}
}

function filename(x,y){
	$(y).show('slow').html( x.files[0]['name'] );
}

function fileupload(btn, url, append, form){
	$('#fileuploadProgress').show();
    var btnval = $(btn).html();
    var form = $('form')[form];
	var formData = new FormData( form );
	$(btn).attr('disabled', true).html('<?php echo fspinner_xs().' '.Sprache::__('uploading'); ?>...');
	$.ajax({
		cache: false,
		contentType: false,
		processData: false,
		method: 'POST',
		url: url,
		data: formData,
		success: function(e){
			$(btn).attr('disabled', false).html(btnval);
			$(append).html(e);
            $('#fileuploadProgress').hide();
		},
		error: function(){
			$('.network').show('slow');
		}
	});
}


function fileremove(btn, url, append){
	if( confirm('<?php echo Sprache::__('Are you sure'); ?>?') ){
        $('#fileuploadProgress').removeClass('hide');
        $(btn).html('<?php echo fspinner_xs().' '.Sprache::__('removing'); ?>...');
        $.ajax({
            cache: false,
            method: 'POST',
            url: url,
            success: function(e){
                $(append).html(e);
                $('#fileuploadProgress').addClass('hide');
            },
            error: function(){
                $('.network').show('slow');
            }
        });
    }
}

/*
*@name jSearch()
*@desc
*@param $x => find
*@param $y => closest
*@param $z => box/closest
*/
function jSearch(e,x,y,z){
	var filter = $(e).val();
	var count = 0;
	$(y).each(function(){
		if ($(this).find(x).text().search(new RegExp(filter, 'i')) < 0) {
			$(this).hide(350);
			if($(this).closest(z).find(y + ':visible').length == 0){
				$(this).closest(z).hide(350);
			}
		}else{
			$(this).show(350); count++;
			if(!$(this).closest(z).is(':visible')){
				$(this).closest(z).show(350);
			}
		}
	});
}


function minMax(input, mini, maxi){
	var self = parseInt(input.value);
    if(self < mini || self > maxi){
		input.value = mini;
        if($.isFunction($.fn.swal)){
			swal('<?php echo Sprache::__('Value must be between') ?> '+ mini +' <?php echo Sprache::__('and') ?> '+ maxi);
        }else{
        	alert('<?php echo Sprache::__('Value must be between') ?> '+ mini +' <?php echo Sprache::__('and') ?> '+ maxi);
        }
	}
}

function loadmore(btn, url, append){
	$(btn).html('<div style="text-align:center; color:#999; width:100%;"><?php echo fspinner_xs(); ?> <?php echo Sprache::__('Fetching more') ?> ...</div>');
    $.ajax({
    	url: url,
        success: function(response){
        	$(btn).html('<?php echo Sprache::__('Load more'); ?>');
        	$(append).append(response);
        }
    });
}

function ucWords(x){
	a = x.toLowerCase().replace(/\b[a-z]/g, function(y){
    	return y.toUpperCase();
    });
    return a;
}

function BMI(w,h){
	var a = w * w;
    var b = a / h
	return b.toFixed(2);
}

function detectCardType(number){
    var re = new RegExp('^4');
    if (number.match(re) != null)
        return 'visa';

    re = new RegExp('^5[1-5]');
    if (number.match(re) != null)
        return 'mastercard';

    re = new RegExp('^3[47]');
    if (number.match(re) != null)
        return 'amex';

    re = new RegExp('^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)');
    if (number.match(re) != null)
        return 'discover';

    re = new RegExp('^36');
    if (number.match(re) != null)
        return 'diners';

    re = new RegExp('^30[0-5]');
    if (number.match(re) != null)
        return 'diners'; // diners_blanche

    re = new RegExp('^35(2[89]|[3-8][0-9])');
    if (number.match(re) != null)
        return 'jcb';

    re = new RegExp('^(4026|417500|4508|4844|491(3|7))');
    if (number.match(re) != null)
        return 'visa_electron';

    return '';
}

function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
  }
<?php CHtml::script('close'); ?>
<!-- / END:: Anchora Technologies' Custom Scripts / -->
