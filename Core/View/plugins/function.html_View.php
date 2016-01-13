<?php 

function smarty_function_html_View($params, $template)
{
    //require_once(SMARTY_PLUGINS_DIR . 'shared.escape_special_chars.php');
    $Str_Url=$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];		
	$arr_result=explode("/",$_SERVER['SCRIPT_NAME']);		
	$SRC="Http://".rtrim($Str_Url,array_pop($arr_result));

	return $SRC.str_replace("./", '',$GLOBALS['APP_URL'])."/Lib/View/{$GLOBALS['G']}/";
} 