<?php
class MRedisClass
{
	private $hostname;
	private $port;
	private $conn;
	
	
	public function __construct()
	{
		$this->hostname = Yii::app()->params['rserver1']['hostname'];
		$this->port = Yii::app()->params['rserver1']['port'];
		$this->conn = new Redis();
	}
	
	public function getConnect()
	{
		$this->conn->pconnect($this->hostname,$this->port);
		return $this->conn;
	}
	
	public function close()
	{
		$this->conn->close();
	}
}