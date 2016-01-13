<?php
/**
*	版权所有(C) 2013 零上一度
*	这一程序是自由软件，你可以遵照自由软件基金会出版的
*	GNU通用公共许可证条款来修改和重新发布这一程序。或者
*	用许可证的第二版，或者（根据你的选择）用任何更新的版本。
*----------------------------------------------
*	轻量级PHP开发框架	PlainPHP
*	框架的入口文件,所有文件都collocate有此处开始执行。
*----------------------------------------------
*  @author:			零上一度<xuyi5918@live.cn>
*  @Date:			2014/1/28
*  @Modify Time :	2014/1/31
*  PHP Version:		5.4.0
*/

	define('SYS_URL',dirname(__FILE__));									//获取框架路径，也就是框架所在的目录
	/**
	*	判断用户是否定义了项目的路径和名称
	*
	*/
	$APP_URL=APP_URL;
	defined('APP_URL') || exit("Error:请先定义项目的目录 define('APP_URL','./Path')");
	defined('APP_NAME') || exit("Error:请先定义项目的名称 define('APP_NAME','AppName')");
	
	/**
	*	获取用户目录中的结构
	*	
	*/
	define('USE_CONF',APP_URL."/Config/");	
	define('USE_COMM',APP_URL."/Common/");
	define('USE_MODEL',APP_URL."/Lib/Model/");
	/**
	*	获取系统目录中的加载文件路径
	*	
	*/
	define('SYS_CONFIG',SYS_URL."/Config/Public.conf.php");					//公共配置项文件
	
	define('SYS_ACTION',SYS_URL."/Core/Controller/Controller.class.php");	//控制器入口文件
	define('SYS_MODEL',SYS_URL."/Core/Model/Model.class.php");				//模型类入口文件
	define('SYS_COMM',SYS_URL."/Common/common.php");						//加载公共函数库
	define('SYS_Drive',SYS_URL."/Drive/Extend.php");
	
	include_once(SYS_CONFIG);		//加载配置项文件
	
	include_once(SYS_Drive);		//加载驱动

	include_once(SYS_ACTION);		//加载控制器文件
	include_once(SYS_MODEL);		//加载模型文件
	include_once(SYS_COMM);			//加载函数库文件
	/**
	*	检查目录如果不存在则自动创建
	*/
	Create::Start(APP_URL,0777);
	
	include SYS_URL."/Common/debug.php";	//加载DeBug模块	
	
	function run($G,$K,$F)														//加载控制器文件并创建控制器对象
	{
		debug::Run($K);						//运行DeBug模块,判断指定的模块文件是否存在。	
		
		if($GLOBALS['Rotu']['Group']==true){
			
			include APP_URL."/Lib/Controller/{$G}/{$K}.class.php";
		}else{
			include APP_URL."/Lib/Controller/{$K}.class.php";
		}
		$obj=new $K();
		debug::modify($obj,$F);				//运行DeBug模块,判断指定的方法是否存在。
		$obj->$F();
		
	}
	
	if($Rotu['Group']==true){
		
		$G=is_null(@$_GET['g'])? $GLOBALS['Rotu']['GrpName']:$_GET['g'];
		$M=is_null(@$_GET['m'])? $GLOBALS['Rotu']['default']:$_GET['m'];
		$A=is_null(@$_GET['a'])? $GLOBALS['Rotu']['methods']:$_GET['a'];
		
		run($G,$M,$A);
		exit();
		
	}
	
	if(isset($_SERVER['PATH_INFO'])){										//实现PathInfo模式
		$arr=@explode('/',$_SERVER['PATH_INFO']."/index.php/");
	}

	if(isset($arr[1])&&isset($arr[2])){										//调用run()方法运行创建控制器对象
		if($arr[1]!=''&&$arr[2]!='')
		{run('',$arr[1],$arr[2]);}
		else
		{ run('',$Rotu['default'],$Rotu['methods']);}
	}else{
		run('',$Rotu['default'],$Rotu['methods']);
	}