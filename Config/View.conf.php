<?php
/**
*  View视图配置项,用来配置Smarty模板返回实例化模板对象。
*-------------------------------------------------------
*  @author:		零上一度<xuyi5918@live.cn>
*  @Date:	 	2014/1/29
*/

	include(SYS_URL."/Core/View/Smarty.class.php");
	class Views{
	private $view=null;
	public function view(){
	foreach($GLOBALS['View'] as $key=>$val)
		{	
			$DB[]=$val;
		}
		if($this->view==null)
		{
			list($TPL_L,$TPL_R)=$DB;
			if($GLOBALS['Rotu']['Group']==true){
				$GroupUrl=is_null($GLOBALS['G'])? "/".$GLOBALS['Rotu']['GrpName']."/":"/".$GLOBALS['G']."/";
			}
			$this->view=new Smarty();
			$this->view->right_delimiter=$TPL_R;
			$this->view->left_delimiter=$TPL_L;
			$this->view->template_dir=APP_URL.$GLOBALS['View']['TPL_PATH'].$GroupUrl;
			$this->view->compile_dir=APP_URL."/Cache/TemplateCache";

            $this->view->caching=$GLOBALS['View']['TPL_CACHE'];
            $this->view->cache_lifetime=$GLOBALS['View']['TPL_CACHE_TIME'];
            $this->view->allow_php_templates=$GLOBALS['View']['TPL_PHP_TAG'];
            $this->view->setCacheDir(APP_URL.'/Cache/'.$GLOBALS['View']['CACHE_PATH']);

			//$View->config_dir=Project."/Skin/tempConf";
			return $this->view;
		}else{
			return $this->view;
		}
	}
	public function __get($name){
		$this->view();
		return $this->$name;
	}
	
}