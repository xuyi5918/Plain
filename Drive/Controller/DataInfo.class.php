<?php 
	/**
	*	Controller控制器 抽象类扩展
	*	数据类型处理
	*
	**/
	abstract class DataInfo Extends Views
	 {
		/*将数据处理成Json 格式*/
		
		public function Json(){
			return 0;
		}

		/* 
			字段获取POST&GET内容 
			创建数据内容插入到数据库
			自动完成
		*/
		public function  input(){
			
		}

	 }
 ?>