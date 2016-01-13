<?php 
	/**
	*	FTP操作类
	*/

	class Ftp{

		private static $Ftp_id;
		private static $Host;
		private static $User;
		private static $Pass;
		private static $Prot;

		private function __construct(){
			$this->$Ftp_id=ftp_connect($Host);
		}
		/* 连接 Ftp服务器 */
		public static function &connect($Host){
			$res= new Ftp();
			return $res;
		}
		/* 登陆 Ftp服务器 */
		public function  login(){
			ftp_login($this->$Ftp_id,);
		}

	}

	Ftp::connect()->login();

?>