<?php 
/**
*  MySQL操作的基础类。
* -----------------------------------------
*  @author:	   零上一度<xuyi5919@live.cn>
*  @Date:	   2014/1/28
* 
*/
class Mysql{
	private static $Link=null;	//用于存储、释放打开的数据库连接
	public  $last_query=null;	//存储最后一次的SQL操作语句
	private $Type=null;
	private $PDO=null;
	private $Sql_result=null;
    public  $insert_id=null;    //获取insert_id

	function __construct($DB)
	{	
		/**
		*list();
		*中的变量以次是$DB_NAME数据库名、$TAB_PREFIX表前缀、
		*$DB_HOST数据库地址、$DB_ROOT数据库主机帐号、$DB_PASS数据库密码		
		*/	
		list($DB_TYPE,$DB_NAME,$TAB_PREFIX,$DB_HOST,$DB_PORT,$DB_ROOT,$DB_PASS)=$DB;
		$this->Type=$DB_TYPE;
		if(self::$Link==null){
			self::$Link=mysql_connect($DB_HOST.':'.$DB_PORT,$DB_ROOT,$DB_PASS) or die("error".mysql_error());
		}
		
		mysql_select_db($DB_NAME)or die ('errror'.mysql_error());
        mysql_query('SET NAMES UTF8');
	}
		
		/**
		*query 执行最后的数据库操作
		*并将结果以数组的方式返回
		*/
		
		public function query($var=0)
		{
			$this->last_query=$var;			//将最后一次执行的SQL语句赋值给last_query;
			if($this->Sql_result!=null){	//释放前一次查询的资源
				$this->free();
			}

			$this->Sql_result=mysql_query($var);
            $this->insert_id=mysql_insert_id();     //获取
			$result=null;	//返回的结果
				if(is_bool($this->Sql_result)!=true)
				{
					while($row=mysql_fetch_assoc($this->Sql_result))
					{
						
						$result[]=$row;
					}
					$this->free();
					 return $result;
				}
				return $this->Sql_result;
		}
		
		/**
		*	关闭数据库资源
		*/
		public function close()
		{
			if(self::$Link){
				mysql_close(self::$Link);
			}
			$this->Link=null;
		}

		/**
		*
		*	释放打开的数据库资源
		**/
		public function  free(){
			if($this->Sql_result&&!is_bool($this->Sql_result)){
				mysql_free_result($this->Sql_result);
			}
			$this->Sql_result=null;
		}

        /**
		*	db链接数据库操作
		*	切换数据库
		*/
		public function db($var){
			if(!is_null($var)){
				$Arr=explode(":", $var);
				mysql_connect($Arr[0].":".$Arr[1],$Arr[2],$Arr[3])or die("error".mysql_error());
				mysql_select_db($Arr[4])or die("error".mysql_error());
			}
			return $this;
		}

	}
	
	
	
	
	