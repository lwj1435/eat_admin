<?php
class DataModelClass  {
	
	public $skey = '';
	public $version = 0;
	
	protected $mysql;
	protected $redis;
	
	public function __construct(){
		$this->mysql = new MySqlClass();
		$this->redis = new MRedisClass();
	}
	
	
	public function setSKey($skey){
		$this->skey = $skey;
	}
	
	public function add($sTable, $aParam,$sKey='',$bShow=0)
	{
		
		if($sKey)
		{
			$this->skey = $sKey;
		}
		
		$id = $this->mysql->add($sTable,$aParam,$bShow);
		$this->redis->add($this->skey.'_id',$id,'list',$bShow);
		$param = $this->MysqlArrayToRedis($aParam,$id);
		$this->redis->add($this->skey.'_'.$id,$param,'hash',$bShow);
		
		$this->DelOldVersion();
		
		return $id;
	}
	
	public function update($id,$sTable,$sWhere,$aParam,$sKey='',$bShow=0)
	{
		if($sKey)
		{
			$this->skey = $sKey;
		}
		
		$this->mysql->update($sTable,$sWhere,$aParam,$bShow);
		$param = $this->MysqlArrayToRedis($aParam,$id);
		$this->redis->update($this->skey.'_'.$id,$param,'hash',$bShow);
		$this->redis->incr($this->skey.'_v',0,'string');

		$this->DelOldVersion();
		return true;
	}
	
	
	public function getInfo($id,$sTable,$sWhere,$sKey='',$bShow=0)
	{
		if($sKey)
		{
			$this->skey = $sKey;
		}
		
		$info = $this->redis->find($this->skey."_".$id,'hash',$bShow);

		if(empty($info)||$info == false){
			$infos = $this->mysql->find($sTable,$sWhere,$bShow);
			if(isset( $infos['msg'][0])){
				$info = $infos['msg'][0];
				
				$this->redis->add($this->skey."_".$id, $info, 'hash');
			}
			return $info;
		}else{
			return $info;
		}
		
	}
	
	public function find($sTable, $sWhere,$sKey='', $bShow = 0)
	{
		if($sKey)
		{
			$this->skey = $sKey;
		}
		$sKeyVersion = 't:'.$this->skey.'_all_v:'.$this->getVersion();
		$result = $this->redis->find($sKeyVersion,'string',$bShow);
	
		if(false == $result){
			$mResult = $this->mysql->find($sTable, $sWhere,$bShow);
			if(!empty($mResult['msg'])&&$mResult['msg']!=false){
				$this->redis->add($sKeyVersion, json_encode($mResult['msg']), 'string',$bShow); 
				
				return $mResult['msg'];
			}else{
				return false;
			}
		}else{

			return json_decode($result,true);
		}
		return false;
	}
	
	public function del($ids,$sTable,$sWhere,$sKey='',$bShow=0)
	{
		if($sKey)
		{
			$this->skey = $sKey;
		}
		$this->mysql->del($sTable,$sWhere,$bShow);
		
		if(is_array($ids)){
			foreach($ids as $mid){
				$this->redis->del($this->skey.'_'.$mid,1);
				$this->redis->delVal($this->skey.'_id',$mid,'list',$bShow);
			}
		}
		$this->DelOldVersion();
		
	}
	
	public function PageList($sTable,$orders,$sWhere,$startPage=0,$pageNum=20,$overtime=0,$bShow=0)
	{
		
		$sKeyVersion = $this->skey.'_count_v:'.$this->getVersion();
		
		$temp = array();
		$sKey = 't:'.$this->skey;
		$order = '';
		if(is_array($orders)){
			foreach($orders as $key=>$order)
			{
				$sKey .= "_".$sKey.':'.$order;
				$temp[] = " $key $order ";
			}
			$order = implode(',', $temp);
		}
		
		$sKey .= "_p:".$startPage."_f:".$pageNum.'_v:'.$this->getVersion();
		
		$result = $this->redis->find($sKey,'string',$bShow);
		
		if(false == $result){
			$mResult = $this->mysql->pageGet("*",$sTable,$sWhere,$startPage,$pageNum,'',$order);
			if($mResult != false){
				$jResult = json_encode($mResult['records']);
				
				$this->redis->add($sKey,$jResult,'string',$bShow);
				$this->redis->add($sKeyVersion,$mResult['totalNum'],'string',$bShow);
				
				return array('count'=>$mResult['totalNum'],'result'=>$mResult['records']);
				
			}else{
				return false;
			}
		}else{
			$count = $this->redis->find($sKeyVersion,'string',$bShow);
			return array('count'=>$count,'result'=>json_decode($result,true));
		}
	}
	
	public function getVersion(){
		$this->version = $this->redis->find($this->skey.'_v','string');
		if($this->version == false){
			$this->version = 0;
		}
		return $this->version;
	}
	
	public function DelOldVersion()
	{
		$this->version = $this->getVersion();
		
		$mKeys = $this->redis->conn->keys('t:'.$this->skey.'_*_v:'.$this->getVersion());

		if(!empty($mKeys))
		{
			foreach($mKeys as $key){
				$this->redis->del($key);
			}	
		}
		$this->redis->incr($this->skey.'_v',1,'string');
		
		$this->version++;
	}
	
	public function MysqlArrayToRedis($aParam,$id){
		$return = array();
		if(is_array($aParam)&&!empty($aParam)){
			foreach($aParam as $key=>$param){
				if(is_array($param)){
					$return[$key] = $param['val'];
				}else{
					$return[$key] = $id;
				}
			}
		}
		return $return;
	}
	
	public function __destruct()
	{
		$this->redis->close();
	}
}