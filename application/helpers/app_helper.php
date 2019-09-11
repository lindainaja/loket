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
			$parsed = str_replace($captured[0], $real_value, $text);
		}
		else{

			
		}
		if($i == 1){
			$parsed = parse_setting_template($parsed,2);
		}
	}
	return $parsed;
}