<?php
/**
*	全局配置文件配置数据库连接\默认路由
* --------------------------------------------
*	@author:	零上一度<xuyi5918@live.cn>
*	@Date:		2014/1/29
*/
	
	//视图配置项
	
	$View=array(
		
		'TPL_L'					=>'{[',					//设置模板变量输出的左定界符
		'TPL_R'					=>']}',					//设置模板变量输出的右定界符
		'TPL_PATH'				=>"/Lib/View/",
		'TPL_N'		            =>'.html',	            //设置模板的后缀名
		'TPL_F'					=>false,				//是否开启Smarty模板引擎(默认开启)


        'TPL_PHP_TAG'           =>true,                 //是否开启PHP标签支持
        'TPL_CACHE_TIME'        =>'600',                //Cache 缓存时间
        'TPL_CACHE'             =>true,                 //是否开启缓存
		'CACHE_PATH'            =>'/CACHE/',            //缓存目录
	);
	
	/*Rotu 设置默认的访问地址*/
	
	$Rotu=array(
		'default'				=>'Home',				//默认的操作模块
		'methods'				=>'Index',				//默认的操作方法
		'GrpName'				=>'',					//分组名称默认为空 开启
		'Group'					=>false,					//是否开启分组模式true or false
	);

	/*DataSet 设置数据库配置项*/
	
	$DataSet=array(
		'DB_TYPE'				=>'mysql',				//数据库类型默认为mysql 			
		'DB_NAME'				=>'a0215102832',				//设置数据库名称 
		'TAB_PREFIX	'			=>'wp_',				//设置表前缀
		'DB_HOST'				=>'113.10.190.45',			//设置数据库地址 
		'DB_PORT'               => '3306',        		// 端口
		'DB_ROOT'				=>'a0215102832',				//数据库名称
		'DB_PASS'				=>'83627160',					//设置数据库密码
	);
		
	/**
	*	判断是否存在用户定义的配置文件
	*	存在则包含进来使用用户定义的配置项
	*/
	if(file_exists(USE_CONF."Conf.php")){
		include USE_CONF."Conf.php";
	}
	
		
	//加载视图配置项
	$config=dirname(__FILE__).'/View.conf.php';
	if(file_exists($config)){
		include ($config);
	}
	//加载DB操作类
	$DB=SYS_URL."/Drive/DB/Mysql.class.php";
	if(is_file($DB)==true){
		include ($DB);
	}

    $DB=SYS_URL."/Drive/DB/PDO.class.php";
    if(is_file($DB)){
        include ($DB);
    }
	
?>