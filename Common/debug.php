<?php 
	class debug{
		static function Run($file){
			$Html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:-(</h1>
		  <p>Error :<b> '."'".$file."'".' 该控制器不存在</b>！</p>
                 </div>';
				
	
	


			if(!$GLOBALS['Rotu']['Group']){
				
				file_exists(APP_URL."/Lib/Controller/{$file}.class.php") ||exit($Html);
			}else{
				$Path='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:-(</h1>
		  <p>Error :<b> '."'".$GLOBALS['G']."'".' 该目录不存在</b>！</p>
                 </div>';
				is_dir(APP_URL."/Lib/Controller/{$GLOBALS['G']}/") || exit($Path);
				file_exists(APP_URL."/Lib/Controller/{$GLOBALS['G']}/{$file}.class.php") || exit($Html);
			}
			
		}
		
		static function modify($obj,$fun){
		$Html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:-(</h1>
		  <p>Error :<b> '."'".$fun."'".' 该方法不存在</b>！</p>
                 </div>';
			method_exists($obj,$fun) || exit($Html);
		}
		
	}
	