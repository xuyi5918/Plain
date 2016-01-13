<?php
/*
*	Host 在模板中当前主机的地址
*	
*/
function smarty_modifier_Host()
{
   
	$Str_Url=$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];		//获取网站的URL包括入口文件在内
	$arr_result=explode("/",$_SERVER['SCRIPT_NAME']);		//
	return "Http://".rtrim($Str_Url,array_pop($arr_result));
} 

?>