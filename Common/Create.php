<?php
	/**
	*	���������û��������ĿĿ¼
	*-------------------------------------------
	* 	@author:	����һ��<xuyi5918@live.cn>
	*	@date:		2014/1/31
	*/
class Create{

		static function Start($path,$Nume){
$str='<?php
	/**
	*   �����г����Զ�����
	*   ��ӭʹ�� PlainPHP Framework��
	*/
	class Home extends Controller{
		public function Index(){
			$this->display("Index");
			}
	}';
	if(!is_dir(APP_URL)){
		mkdir(APP_URL,$Nume)||exit('��Ŀ����ʧ��,������ķ������Ƿ���дȨ��');
		
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