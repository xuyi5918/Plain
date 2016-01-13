<?php
		/*
		*	获取Controller 的抽象类
		*/
	
		define("DIR",SYS_URL."\\Drive\\Controller\\");	//获取路径
		
		$res=scandir(DIR,0);
		
		$count= count($res);
		for($Munber=2 ;$Munber<3;$Munber++){
			include DIR.$res[$Munber];
		}
		
		/*
		*	获取Model 的抽象类
		*/
		define("ModelDir",SYS_URL."\\Drive\\Model\\");
		$res=scandir(ModelDir,0);
		$count=count($res);
		for ($Munber=2; $Munber < 3; $Munber++) {
			
			include_once ModelDir.$res[$Munber];
		}

		/* 继承用户Controller文件夹中用于继承的文件 */
		
 ?>