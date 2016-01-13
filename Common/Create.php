<?php
	/**
	*	用于生成用户定义的项目目录
	*-------------------------------------------
	* 	@author:	零上一度<xuyi5918@live.cn>
	*	@date:		2014/1/31
	*/
class Create{

		static function Start($path,$Nume){
$str='<?php
	/**
	*   该类有程序自动生成
	*   欢迎使用 PlainPHP Framework！
	*/
	class Home extends Controller{
		public function Index(){
			$this->display("Index");
			}
	}';
	if(!is_dir(APP_URL)){
		mkdir(APP_URL,$Nume)||exit('项目创建失败,请检查你的服务器是否有写权限');
		
		$Dir_Array=array('/Cache','/Cache/DataBaseCache','/Cache/TemplateCache','/Config','/Common','/Lib','/Lib/Controller','/Lib/Model','/Lib/View','/Load','/Load/Library');
		foreach($Dir_Array as $key=>$val){
			mkdir(APP_URL.$val,$Nume);
		}
		
		if(!is_file(APP_URL.'/Lib/Controller/Home.class.php')){
			$Lin=fopen(APP_URL.'/Lib/Controller/Home.class.php', 'w+');
			fwrite($Lin, $str);
		}
		if(!is_file(APP_URL.'/Lib/View/Index.html')){
			$Lin=fopen(APP_URL.'/Lib/View/Index.html', 'w+');
			$str=file_get_contents(SYS_URL.'/Core/View/Index.tpl');
			fwrite($Lin, $str);
		}
	}
		}
	}