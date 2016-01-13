<?php 
/**
* Common 公共函数库 框架中的所有对模型的简便操作缓存等
*------------------------------------------------------
* @author: 	  零上一度<xuyi5918@live.cn>
* @Date:	  2014/1/28
*/

	/**
	*实例化用户自定义的Model类,如果不存在则自动返回Model类
	*/
	function D($var)
	{
        if($GLOBALS['Rotu']['Group']){
            $Dir=USE_MODEL.$GLOBALS['G'].'/'.$var.'Model.class.php';
        }else{
            $Dir=USE_MODEL.$var.'Model.class.php';
        }

		if(file_exists($Dir)){
			$Obj= $var."Model";
			if(!class_exists($Obj)){
				include $Dir;
				return new $Obj($var);
			}else{
				return new $Obj($var);
			}
		}else{
			return new Model($var);
		}
	}

    /**
	*Model函数用于实例化Model类常在Controller中调用
	*/
	function Model($var){
		return new Model($var);
	}
	/**
	 * Action 方法实例化Controller class
	 */
	function Action($var){

		$DirName=APP_URL."/Lib/Controller/".str_replace(".", "/", $var).'.class.php';
		$res=explode('.', $var);

		if(is_file($DirName)!=true){
			exit($DirName."该文件不存在!");
		}elseif(class_exists($res[1])==false){
			include_once($DirName);
			return new $res[1]();
		}else{
			return new $res[1]();
		}
		
		//return new 
	}

	// function (){

	// }
	/** 
	*	SetCache函数用于设置缓存文件减少读取数据库的次数
	*	默认为file文件缓存 (file、xcache)
	*/
	function SetCache($name,$val,$Type='file',$Prefix='Plain_'){
		switch($Type){
			case 'file':
                $md5=md5('PlainCms');
				$file=fopen(APP_URL."/Cache/DataBaseCache/{$Prefix}{$name}{$md5}.php","w+");
				fwrite($file,'<?php $result='.var_export($val,true)." ?>");
                unset($Prefix,$md5,$val,$name);//销毁变量
			break;
			
			case 'xcache':
				xcache_set($name,$val);
			break;
		}
	}
	//用于读取缓存文件
	function Cache($name,$Prefix='Plain_')
	{
        $md5=md5('PlainCms');

		if(file_exists(APP_URL."/Cache/DataBaseCache/{$Prefix}{$name}{$md5}.php")){
            include APP_URL."/Cache/DataBaseCache/{$Prefix}{$name}{$md5}.php";
            unset($md5,$Prefix,$name);
			return $result;
		}elseif(xcache_get($name)!=''){
			return xcache_get($name);
		}else{
            return null;
        }
	}
	/**
	*	Cookie();
	*	用于快速的设置Cookie值
	*	获取Cookie()
	*/
	function Cookie($name,$val=null,$time=3600){
		if($val!=null){
			setcookie($name,$val,$time);//设置Cookie()
			$_COOKIE[$name]=$val;
		}else{
			return @$_COOKIE[$name];	
		}	
	}
	/**
	*	load()加载扩展类并返回实例化对象 
	*	接受字符串值	
	*/
	
	function load($var=null){
		!($var==null) || exit('error:Class file path is null');
		$DirName=str_replace('.','/',$var);
		$SYSDirUrl=SYS_URL."/Extend/Library/{$DirName}.php";
		$APPDirUrl=APP_URL."/Load/Library/{$DirName}.php";

		if(is_file($SYSDirUrl)){
			include SYS_URL."/Extend/Library/{$DirName}.php";	//装载扩展类库文件
		}elseif(is_file($APPDirUrl)){
			include $APPDirUrl;
		}else{
			exit('错误:在框架的系统目录和应用目录都未找到改类');
		}
		$res=explode('.',$var);
		$FileName=array_pop($res);							//获取文件名即为类名
		return new $FileName();
	}
	/**
	*	links()加载扩展函数库文件,扩展文件位于框架
	*	系统的Extend目录下Functiond目录下可以自定义
	*	文件名。
	*	使用@符合可以加载用户设置的函数库文件。
	* 	links('@Use.Fun');加载项目目录下的Use\Fun.php
	*	函数文件。
	*	如不加@符合则是加载系统默认目录下的函数库文件。
	*/
	function links($var=null){
		!($var==null)||exit('error:Function file path is null');
		/**
		*	判断载入的函数文件类型,
		*	如果参数为@符开头则为自定义扩展函数路径
		*/
		if(preg_match("/(@)/",$var)>=1){
		  $DirName=str_replace('.','/',$var);		//拆分字符串转换为路径
		  $DirName=str_replace('@', "", $DirName);
		  is_file(APP_URL."/".$DirName.".php")||exit("{$DirName}.php文件不存在");
		  include APP_URL."/{$DirName}.php";		//加载用自定义的函数库路径
		}else{
		  $DirName=str_replace('.','/',$var);
		  is_file(SYS_URL."/Extend/Functiond/".$DirName.".php")||exit("{$DirName}.php文件不存在");
		  include SYS_URL."/Extend/Functiond/{$DirName}.php";	//加载系统扩展函数库
		}
	}
	/**
	*	生成用户传入的操作的完整URL地址
	*	PS: site_url("Index\Main")
	*/
	function site_url($StrURL)
	{
		return $_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."/{$StrURL}";
	}
	
	/**
	*	搜索用户项目文件夹下是否存在自定义
	*	的函数库文件 如果有则包含进公共函数库
	*/
	if(file_exists(USE_COMM.'Common.php')){
		include USE_COMM.'Common.php';
	}
	include "Create.php";