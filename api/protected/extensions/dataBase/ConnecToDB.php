<?php
class ConnecToDB{
	private static $instance=array();
	//防止外部创建新的数据库连接类
	private function _constuct(){}
	static public function Connect()
	{
		//连接类不够100，创建新类
		if(count(self::$instance)<100)
		{
			$newDb=new self();
			self::$instance[]=$newDb;
			return $newDb::ConDB();
		}
		else
		{
			//随机数保证数据库连接均衡
			$i=rand(0,99);
			$new_obj=self::$instance[$i];
			return $new_obj::ConDB();
		}
	}
	static private function ConDB()
	{
		try
		{
			$connec= Yii::app()->db;//new CDbConnection("127.0.0.1","root","123456");//mysql_connect("127.0.0.1","root","123456");
			//mysql_select_db("qiuxun");//选择数据库
			return $connec;
		}
		catch(Exception $e)
		{
			$errors[]=$e->getMessage();
		}
	}
}
?>