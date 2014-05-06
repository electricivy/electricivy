<?php 

function get_darker_color($hex_color){
	$hsv = hex_to_hsv($hex_color);
	
	if($hsv['V'] > 0.2){
	
		$dark_v = $hsv['V'] - 0.2;
	
	}else{
		$dark_v = $hsv['V'] + 0.2;
	}
	
	$color['darker'] = hsv_to_hex($hsv['H'],$hsv['S'],$dark_v);
	
	return $color['darker'];
}

function get_colors($hex_color){

	$hsv = hex_to_hsv($hex_color);

	
	$color['normal'] = $hex_color;
	
	if($hsv['V'] > 0.3){
	
		if($hsv['V'] > 0.3){
			$dark_v = $hsv['V'] - 0.3;
		}else{
			$dark_v = 0;
		}
		$color['darker'] = hsv_to_hex($hsv['H'],$hsv['S'],$dark_v);
		
	}else{
		
		if($hsv['V'] > 0.7){
			if($hsv['S'] < 0.3){
				$light_S = 0;
			}else{
				$light_S = $hsv['S'] - 0.3;
			}
			$light_v = $hsv['V'];
		}else{
			$light_v = $hsv['V'] + 0.3;
			$light_S = $hsv['S'];
		}
		$color['darker'] = hsv_to_hex($hsv['H'],$light_S,$light_v);
	}
	
	if($hsv['V'] >= 0.75){
		$color['font'] ='000000';
	}else{
		$color['font'] ='ffffff';
	}
	
	return $color;
}


function rgb_to_hsv ($R, $G, $B)  // RGB Values:Number 0-255 
{                                 // HSV Results:Number 0-1 
   $HSL = array(); 

   $var_R = ($R / 255); 
   $var_G = ($G / 255); 
   $var_B = ($B / 255); 

   $var_Min = min($var_R, $var_G, $var_B); 
   $var_Max = max($var_R, $var_G, $var_B); 
   $del_Max = $var_Max - $var_Min; 

   $V = $var_Max; 

   if ($del_Max == 0) 
   { 
      $H = 0; 
      $S = 0; 
   } 
   else 
   { 
      $S = $del_Max / $var_Max; 

      $del_R = ( ( ( $max - $var_R ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max; 
      $del_G = ( ( ( $max - $var_G ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max; 
      $del_B = ( ( ( $max - $var_B ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max; 

      if      ($var_R == $var_Max) $H = $del_B - $del_G; 
      else if ($var_G == $var_Max) $H = ( 1 / 3 ) + $del_R - $del_B; 
      else if ($var_B == $var_Max) $H = ( 2 / 3 ) + $del_G - $del_R; 

      if (H<0) $H++; 
      if (H>1) $H--; 
   } 

   $HSL['H'] = $H; 
   $HSL['S'] = $S; 
   $HSL['V'] = $V; 

   return $HSL; 
} 

function hsv_to_rgb ($H, $S, $V)  // HSV Values:Number 0-1 
{                                 // RGB Results:Number 0-255 
    $RGB = array(); 

    if($S == 0) 
    { 
        $R = $G = $B = $V * 255; 
    } 
    else 
    { 
        $var_H = $H * 6; 
        $var_i = floor( $var_H ); 
        $var_1 = $V * ( 1 - $S ); 
        $var_2 = $V * ( 1 - $S * ( $var_H - $var_i ) ); 
        $var_3 = $V * ( 1 - $S * (1 - ( $var_H - $var_i ) ) ); 

        if       ($var_i == 0) { $var_R = $V     ; $var_G = $var_3  ; $var_B = $var_1 ; } 
        else if  ($var_i == 1) { $var_R = $var_2 ; $var_G = $V      ; $var_B = $var_1 ; } 
        else if  ($var_i == 2) { $var_R = $var_1 ; $var_G = $V      ; $var_B = $var_3 ; } 
        else if  ($var_i == 3) { $var_R = $var_1 ; $var_G = $var_2  ; $var_B = $V     ; } 
        else if  ($var_i == 4) { $var_R = $var_3 ; $var_G = $var_1  ; $var_B = $V     ; } 
        else                   { $var_R = $V     ; $var_G = $var_1  ; $var_B = $var_2 ; } 

        $R = $var_R * 255; 
        $G = $var_G * 255; 
        $B = $var_B * 255; 
    } 

    $RGB['R'] = $R; 
    $RGB['G'] = $G; 
    $RGB['B'] = $B; 

    return $RGB; 
} 

function hex_to_rgb($hex) {
	
	$color = array();

	if(strlen($hex) == 3) {
		$color['r'] = hexdec(substr($hex, 0, 1) . $r);
		$color['g'] = hexdec(substr($hex, 1, 1) . $g);
		$color['b'] = hexdec(substr($hex, 2, 1) . $b);
	}
	else if(strlen($hex) == 6) {
		$color['r'] = hexdec(substr($hex, 0, 2));
		$color['g'] = hexdec(substr($hex, 2, 2));
		$color['b'] = hexdec(substr($hex, 4, 2));
	}

	return $color;
}

function rgb_to_hex($r, $g, $b) {
	//String padding bug found and the solution put forth by Pete Williams (http://snipplr.com/users/PeteW)
	$hex= str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
	$hex.= str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
	$hex.= str_pad(dechex($b), 2, "0", STR_PAD_LEFT);

	return $hex;
}

function hex_to_hsv($hex){
	$rgb = hex_to_rgb($hex);
	return rgb_to_hsv($rgb['r'],$rgb['g'],$rgb['b']);
}

function hsv_to_hex($H, $S, $V){
	$rgb = hsv_to_rgb($H, $S, $V);
	return rgb_to_hex($rgb['R'],$rgb['G'],$rgb['B']);
}


?>