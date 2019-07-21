<?php //$maths = new Maths();

class Maths
{
    public static function captcha(){
        $cap_form  = '';
        $cap_form .= '<div class="anchora-captcha-equation">';
        $maths_question_output = self::generate_maths_question();
        $cap_form .= $maths_question_output.'</div></p>';
        return $cap_form;
    }
    
    private static function generate_maths_question(){
        //For now we will only do plus, minus, multiplication
        $equation_string = '';
        $operator_type = array('&#43;', '&#8722;', '&#215;');
        
        $operand_display = array('word', 'number');
        
        //let's now generate an equation
        $operator = $operator_type[rand(0,2)];

        if($operator === '&#215;'){
            //Don't make the question too hard if multiplication
            $first_digit = rand(1,5);    
            $second_digit = rand(1,5); 
        }else{
            $first_digit = rand(1,20);
            $second_digit = rand(1,20); 
        }
        
        if($operand_display[rand(0,1)] == 'word'){
            $first_operand = self::number_word_mapping($first_digit);
        }else{
            $first_operand = $first_digit;
        }
        
        if($operand_display[rand(0,1)] == 'word'){
            $second_operand = self::number_word_mapping($second_digit);
        }else{
            $second_operand = $second_digit;
        }

        //Let's caluclate the result and construct the equation string
        if($operator === '&#43;')
        {
            //Addition
            $result = $first_digit+$second_digit;
            $equation_string .= '<b>'.$first_operand . ' ' . $operator . ' ' . $second_operand . ' = ? </b>';
        }
        else if($operator === '&#8722;')
        {
            //Subtraction
            //If we are going to be negative let's swap operands around
            if($first_digit < $second_digit){
                $equation_string .= '<b>'.$second_operand . ' ' . $operator . ' ' . $first_operand . ' = ? </b>';
                $result = $second_digit-$first_digit;
            }else{
                $equation_string .= '<b>'.$first_operand . ' ' . $operator . ' ' . $second_operand . ' = ? </b>';
                $result = $first_digit-$second_digit;
            }
        }
        elseif($operator === '&#215;') {
            //Multiplication
            $equation_string .= '<b>'.$first_operand.' '.$operator.' '.$second_operand.' = ? </b>';
            $result = $first_digit*$second_digit;
        }
        
        //Let's encode correct answer and store it in session
        $current_time = time();
        $enc_result = base64_encode($result);
		Session::set('match_captcha',$enc_result);
        $equation_string .= '<input style="width:100%;" class="form-control" type="text" required="required" name="match_captcha" class="onlynums" placeholder="'.Sprache::__('Please enter an answer in digits').'" />';
        return $equation_string;
    }
    
    private static function number_word_mapping($num){
        $number_map = array(
            1 => Sprache::__('one'),
            2 => Sprache::__('two'),
            3 => Sprache::__('three'),
            4 => Sprache::__('four'),
            5 => Sprache::__('five'),
            6 => Sprache::__('six'),
            7 => Sprache::__('seven'),
            8 => Sprache::__('eight'),
            9 => Sprache::__('nine'),
            10 => Sprache::__('ten'),
			11 => Sprache::__('eleven'),
            12 => Sprache::__('twelve'),
            13 => Sprache::__('thirteen'),
            14 => Sprache::__('fourteen'),
            15 => Sprache::__('fifteen'),
            16 => Sprache::__('sixteen'),
            17 => Sprache::__('seventeen'),
            18 => Sprache::__('eighteen'),
            19 => Sprache::__('nineteen'),
            20 => Sprache::__('twenty'),
        ); 
        return $number_map[$num];
    }

}