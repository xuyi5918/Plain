<?php
	/*
	*	Model类驱动扩展
	**/
	 abstract class ModelDrive Extends Mysql{

	 	public $Group	=null;	//设置分组条件
	 	public function table($Table){
	 		var_dump($Table);
			
	 		return $this;
	 	}

	 	/*设置查询分组条件 */
	 	public function Group(){

	 	}
	
	}