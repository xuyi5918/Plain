<?php 
/**
*	Modelģ�͵ĳ������ �����Զ���֤�Զ����
*---------------------------------------
*	@author: 	����һ��<xuyi5918@live.cn>
*	@Date:		2014/2/4
*/
	abstract class AbsDB{
		private $PDO_Link=null;
		function PdoLink($Type,$DB_HOST,$DB_NAME,$DB_PORT,$DB_ROOT,$DB_PASS)
		{
			$this->PDO_Link=new PDO("{$Type}:host={$DB_HOST}:{$DB_PORT};dbname={$DB_NAME}",$DB_ROOT,$DB_PASS);
			
		}
		
		public function PDO_Query($var=0)
		{
			
			return $this->PDO_Link->query($var);
		}
	}