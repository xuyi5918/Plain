<?php 
/**
*	控制器基础文件类 
*-------------------------------------------
*	@author:	零上一度<xuyi5918@live.cn>
*	@Date:		2014/1/28
*	@Modify:	2014/3/30
*/	
class Controller extends DataInfo{
	/**
	*	自动跳转方法接收传入的连接地址并跳转
	*
	*/
	public function redirect($DirURL){
		header("Location: http://{$DirURL}");
	} 
	/**
	*	_Post方法与$_POST[]发放相同区别在于
	*	_Post方法会将传输来的数据做安全处理
	*	将信息实例化。 _Post();
	*/
	public function _Post($Post){
		return htmlspecialchars($_POST[$Post]);	
	}
	/**
	*	display()方法调用Smarty模板引擎
	*	输出模板
	*/
	public function display($var){
		if($GLOBALS['View']['TPL_F']){
			$this->view->display($var.$GLOBALS['View']['TPL_N']);
			
		}else{
			include APP_URL.$GLOBALS['View']['TPL_PATH'].$var.$GLOBALS['View']['TPL_N'];
		}
		
	}
	
	/**
	*	assign(name,value) 方法用与模板,
	*	的变量和内容的输出。传入两个参数。
	*
	*/
	public function assign($Name,$Value=null){
		$this->view->assign($Name,$Value);
	}
	/**
	*	_Get方法将传输来的数据做安全处理
	*	将信息实例化。_Get();
	*/
	public function _Get($var){
		return htmlspecialchars($_GET[$var]);
	}
	/* 
	*	Views 方法 在未开启Smarty模板引擎时
	*	使用,传入模板路径名称和需要在前台显示的
	*	数组变量 。
	*/
	public  function views($filename,$path=null,$var=null){

		if($GLOBALS['Rotu']['Group']){
			$G=$path==null?$GLOBALS['G'].'/':$path."/";
		}elseif($GLOBALS['Rotu']['Group']==false&&$path!=null){
			$G=$path;
		}else{exit('Error:You Off Group ro views() functon lack parameter');}

		if($filename!=""&&is_array($var)){

			extract($var);
			include APP_URL.$GLOBALS['View']['TPL_PATH'].$G.$filename.$GLOBALS['View']['TPL_N'];
		}else{
            include APP_URL.$GLOBALS['View']['TPL_PATH'].$G.$filename.$GLOBALS['View']['TPL_N'];
        }
	}
}
