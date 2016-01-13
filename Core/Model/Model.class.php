<?php 	
/**
* 模型文件基础类,用来完成数据库的操作读取
* ---------------------------------------
* @author:	零上一度 <xuyi5918@live.cn>
* @Date:	2014/1/28		
*/



class Model extends ModelDrive
{
	private $from=null;			//数据库表名
	private $where=null;		//设置查询的Where条件
	private $TAB_PREFIX=null;	//存放表前缀
	private $Field="*";			//设置需要查询的字段
	private $Limit=null;		//设置查询的数据条数
	private $Order=null;		//设置排序规则
	
	function __construct($DB_TAB)
	{ 
		//读取全局配置文件中的数据库配置信息
		foreach($GLOBALS['DataSet'] as $key=>$val)
		{	
			$DB[]=$val;
		}
		parent::__construct($DB);
		$this->from=$DB_TAB;	//将接受到的表名传递给$from
		
		
		/**
		*list();
		*中的变量以次是$DB_NAME数据库名、$TAB_PREFIX表前缀、
		*$DB_HOST数据库地址、$DB_ROOT数据库主机帐号、$DB_PASS数据库密码		
		*/	
		list($DB_TYPE,$DB_NAME,$TAB_PREFIX,$DB_HOST,$DB_PORT,$DB_ROOT,$DB_PASS)=$DB;
		$this->TAB_PREFIX=$TAB_PREFIX;	//	表前缀
	}
	
	/*
	*	get();
	*	从数据库中执行读取操作 
	*	该函数要放到连贯操作的最后
	*	返回一条数组 数据
	*/
	public function get($F=null,$W=null){
		if($F!=null||$W!=null)
		{
			$this->field($F);
			$this->where($W);
		}
	$SQL="SELECT {$this->Field} FROM `{$this->TAB_PREFIX}{$this->from}`{$this->where}{$this->Order}{$this->Limit}";
		return $this->query($SQL);
		
	}
	/**
	*	order();
	*	设置数据的排序规则 ORDER BY
	*	可以传入数组 array('id','asc');
	*/
	public function order($var=null)
	{
		if(is_array($var))
		{
			$this->Order=' ORDER BY '.'`'.$var[0].'`'.$var[1];
		}else{
			$this->Order=' ORDER BY '.$var;
		}
		return $this;
	}
	/**
	*	limit();
	*	从数据库中读取几条数据从哪一行数据项后读取
	*
	*/
	public function limit($var=null)
	{
		$this->Limit=' LIMIT '.$var;
		return $this;
	}
	
	/**
	*	insert(); Date :2014/1/29
	*	向字段名数据库中插入一条数据
	*	可以用数组的方式传入数据
	*	返回值为 true  或者  false
	*/
	public function insert($var=null)
	{
		$Field_Name=null;
		$Field_Value=null;
		$keys=array_keys($var);$i=0;
		
		foreach($var as $key=>$val)
		{
		  if(is_array($val)){
			$keys=array_keys($val);$i=0;
				foreach($val as $key=>$val_eof)
				{
					$Field_Name='`'.$keys[$i].'`,'.$Field_Name;
					$Field_Value="'".$val_eof."',".$Field_Value;
					$i++;
				}
				$Field_Value=rtrim($Field_Value,',');$Field_Name=rtrim($Field_Name,',');	
				$SQL="INSERT INTO `{$this->TAB_PREFIX}{$this->from}`({$Field_Name})VALUES({$Field_Value});";
				$result=$this->query($SQL);
				$Field_Name=null;$Field_Value=null;
			 }else{
					$Field_Name='`'.$keys[$i].'`,'.$Field_Name;
					$Field_Value="'".$val."',".$Field_Value;
					$i++;
			 }
		}
		if(isset($val_eof)==false)
		{
			$Field_Value=rtrim($Field_Value,',');$Field_Name=rtrim($Field_Name,',');	
			$SQL="INSERT INTO `{$this->TAB_PREFIX}{$this->from}`({$Field_Name})VALUES({$Field_Value});";
			$result=$this->query($SQL);
			$Field_Name=null;$Field_Value=null;
		}
        unset($SQL);
		return $result;
	}


	
	/**
	* 	where();
	*	设置查询条件
	*	可以传入关联数组array('id >'=>'1');
	*/
	public function where($var=null){

	if($var!=null)
	if(is_array($var))
	{
		$where=null;
        if(isset($var['_term'])){
		$_trem=$var['_term'];
        }else{
            $_trem='AND';
        }
		unset($var['_term']);
		$exp=array_keys($var);
		$i=0;

		foreach($var as $key=>$val)
		{
			$where=$exp[$i]." '{$val}' {$_trem} ".$where;//解析多个条件的Array数据

			$i++;
		}
		$this->where=' WHERE '.substr($where,0,strlen($where)-(strlen($_trem)+2));		//删除SQL语句中多余的字符
	}else{
		$this->where=' WHERE '.$var;
		
	}
		return  $this;
	}
	/**
	*	field() 用来设置需要查询的数据库字段
	*	可以接受数组参数
	*/
	public function field($var){
		if($var!=null)
		if(is_array($var)){
			$field=implode(',',$var);
			$this->Field=$field;
		}else{
			$this->Field=$var;
		}
	return $this;
	}

	/*
	*	Delete() 方法 如果没有指定字段则按照id字段
	*	根据id 值删除
	*	也可以传递数组设置删除条件
	*/
	public function Delete($Val="%WHERE%"){
		$Field='id';
		if($Val!="%WHERE%"&&!is_array($Val)){
			$SQL="DELETE  FROM `{$this->TAB_PREFIX}{$this->from}` WHERE `{$Field}`={$Val}";
			return $this->query($SQL);
		}elseif(is_array($Val)){
			$this->where($Val);
			$SQL="DELETE FROM `{$this->TAB_PREFIX}{$this->from}` {$this->where}";
			return $this->query($SQL);
		}elseif($this->where!=null){
			$SQL="DELETE FROM `{$this->TAB_PREFIX}{$this->from}` {$this->where}";
			return $this->query($SQL);
		}
	}
	
}