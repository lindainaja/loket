<?php

function parse_setting_template($text,$i=1)
{
	$parsed = "";
	$captured = [];
	preg_match_all('/\{([a-zA-Z0-9|_]+)\}/', $text, $captured);
	$ci =& get_instance();
	foreach ($captured[1] as $index => $key) {
		$real_value = $ci->m_setting->get_value($key);
		if(!empty($real_value)){
			$text = str_replace($captured[0], $real_value, $text);
			if($i == 1){
				$text = parse_setting_template($text,2);
			}
		}
		else{
			// $parsed = $text;
		}
		
	}
	return $text;
}


 