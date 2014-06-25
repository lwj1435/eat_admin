<?php
class MRedisClass
{
	private $hostname;
	private $port;
	private $conn;
	
	
	public function __construct()
	{
		$this->hostname = Yii::app()->params['redismaster']['hostname'];
		$this->port = Yii::app()->params['redismaster']['port'];
		$this->conn = new Redis();
	}
	
	public function getConnect()
	{
		$this->conn->pconnect($this->hostname,$this->port);
		$this->conn->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);
		$this->conn->select(0); 
		return $this->conn;
	}
	
	public function getVersion($key)
	{
		return $this->conn->get($key);
	}
	
	public function incrVersion($vkey,$delpre)
	{
		$num = $this->find($vkey,'string');
		$delkeys = $this->conn->keys($vkey."*".$num);
		foreach($delkeys as $del)
		{
			$this->del($del);
		}
		$this->conn->incr($vkey);
	}
	
	public function add($skey,$val,$type,$bShow=0)
	{
		if (!$skey) {
			return false;
		}
		$sMsg = json_encode($val);
		switch ($type){
			case "string":
				if (is_array($val)) {
					if (key_exists("val", $val)) {
						$this->conn->set($skey, $val['val']);
					}else{
						BaseFunctions::writeLog("executeAdd string error! key:{$skey} val:{$sMsg} type:{$type} ");
						return false;
					}
				}
				if ($bShow) {
					BaseFunctions::writeLog("redis add string ->  key:{$skey} val:{$sMsg}");
				}
				return $this->conn->set($skey, $val);
				break;
			case "hash":
				
				if (is_array($val)){
					$this->conn->hMset($skey,$val);
				}else{
					BaseFunctions::writeErr("redis hash add val type  error!  key:{$skey} val: {$sMsg}");
					return false;
				}
				if ($bShow) {
					BaseFunctions::writeLog("redis add hash ->  key:{$skey} val:{$sMsg}");
				}
				return true;
				break;
			case "set":
				if (is_array($val)){
					foreach ($val as $iValKey => $sAddVal){
						$this->conn->sAdd($skey,$sAddVal);
					}
				}else{
					BaseFunctions::writeErr("redis set add val type error! key:{$skey} val: {$sMsg}");
					return false;
				}
				if ($bShow) {
					BaseFunctions::writeLog("redis add set -> key:{$skey} val:{$sMsg}");
				}
				return true;
				break;
			case "storeset":
				if(is_array($val)){
					foreach ($val as $sAddKey => $sAddVal){
						$this->conn->zAdd($skey,$sAddVal['sort'],$sAddVal['val']);
					}
				}else{
					BaseFunctions::writeErr("redis storeset add val type error!   key:{$skey} val: {$sMsg}");
					return false;
				}
				if ($bShow) {
					BaseFunctions::writeLog("redis add storeset ->  key:{$skey} val:{$sMsg}");
				}
				return true;
				break;
			case "list":
				if(is_array($val)){
					foreach ($val as $iValKey => $sAddVal){
						$this->conn->rpush($skey,$sAddVal);
					}
				}else{
					BaseFunctions::writeErr("redis list add val type error! key:{$skey} val: {$sMsg}");
					return false;
				}
				if ($bShow) {
					BaseFunctions::writeLog("redis add list ->  key:{$skey} val:{$sMsg}");
				}
				return true;
				break;
			default:
				if (is_array($val)) {
					BaseFunctions::writeLog(" key:{$skey} val:{$val} type:{$type} ");
					return false;
				}
				$this->conn->set($skey, $val);
				if ($bShow) {
					BaseFunctions::writeLog("redis add list -> key:{$skey} val:{$sMsg}");
				}
				return true;
				break;
		}
		return false;
	}
	
	public function find($sKey,$type,$bShow=0)
	{
		if (!$sKey) {
			return false;
		}
		$sMsg = json_encode($val);
		switch ($type){
			case "string":
				if ($bShow) {
					BaseFunctions::writeLog("redis find function string ->  key:{$sKey} val:{$sMsg}");
				}
				return $this->conn->get($sKey);
				break;
			case "hash":
				if ($bShow) {
					BaseFunctions::writeLog("redis find function hash ->  key:{$sKey} val:{$sMsg}");
				}
				$aAllData = $this->conn->hgetall($sKey);
				
				return $aAllData;
				break;
			case "set":
				if ($bShow) {
					BaseFunctions::writeLog("redis find function set -> key:{$sKey} val:{$sMsg}");
				}
				$oRedisSet = $this->conn->getSet($sKey);;
				return $oRedisSet;
				break;
			case "storeset":
				if ($bShow) {
					BaseFunctions::writeLog("redis find function storeset -> key:{$sKey} val:{$sMsg}");
				}
				
				$returnData = $this->conn->zRange($sKey, 0, -1);;
				
				return $returnData;
				break;
			case "list":
				if ($bShow) {
					BaseFunctions::writeLog("redis find function list ->  key:{$sKey} val:{$sMsg}");
				}
				return $this->conn->lRange($sKey,0,-1);
				break;
			default:
				return $this->conn->get($sKey);
				break;
		}
		return false;
	}
	
	public function update($sKey,$val,$type,$bShow=0)
	{
		if (exists($sKey) == false) {
			if ($bShow) {
				BaseFunctions::writeLog(" key not exists");
			}
			return false;
		}
		
		$this->add($sKey, $val, $type);
		return true;
	}
	
	public function del($sKey,$bShow=0){
		if ($bShow) {
			BaseFunctions::writeLog("del key: ->  key:{$sKey}");
		}
		return $this->conn->delete($sKey);
	}
	
	public function mSetList($sKey,$value,$vkey,$type)
	{
		$result = $this->conn->set($sKey,json_encode($value));
		$this->conn->incrVersion($vkey,$type);
		return $result;
	}
	
	public function mGetList($sKey)
	{
		$values = $this->conn->get($sKey);
		return json_decode($values);
	}
	
	public function close()
	{
		$this->conn->close();
	}
}