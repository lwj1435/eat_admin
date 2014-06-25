<?php
class OtherClass{
	// 鏄惁浣跨敤 M/S 鐨勮鍐欓泦缇ゆ柟妗�
	private $_isUseCluster = false;
	
	// Slave 鍙ユ焺鏍囪
	private $_sn = 0;
	
	// 鏈嶅姟鍣ㄨ繛鎺ュ彞鏌�
	private $_linkHandle = array(
			'master'=>null,// 鍙敮鎸佷竴鍙�Master
			'slave'=>array(),// 鍙互鏈夊鍙�Slave
	);
	
	/**
	 * 鏋勯�鍑芥暟
	 *
	 * @param boolean $isUseCluster 鏄惁閲囩敤 M/S 鏂规
	*/
	public function __construct($isUseCluster=false){
		$this->_isUseCluster = $isUseCluster;
	}
	
	/**
	 * 杩炴帴鏈嶅姟鍣�娉ㄦ剰锛氳繖閲屼娇鐢ㄩ暱杩炴帴锛屾彁楂樻晥鐜囷紝浣嗕笉浼氳嚜鍔ㄥ叧闂�
	 *
	 * @param array $config Redis鏈嶅姟鍣ㄩ厤缃�
	 * @param boolean $isMaster 褰撳墠娣诲姞鐨勬湇鍔″櫒鏄惁涓�Master 鏈嶅姟鍣�
	 * @return boolean
	 */
	public function connect($config=array('host'=>'127.0.0.1','port'=>6379), $isMaster=true){
		// default port
		if(!isset($config['port'])){
			$config['port'] = 6379;
		}
		// 璁剧疆 Master 杩炴帴
		if($isMaster){
			$this->_linkHandle['master'] = new Redis();
			$ret = $this->_linkHandle['master']->pconnect($config['host'],$config['port']);
		}else{
			// 澶氫釜 Slave 杩炴帴
			$this->_linkHandle['slave'][$this->_sn] = new Redis();
			$ret = $this->_linkHandle['slave'][$this->_sn]->pconnect($config['host'],$config['port']);
			++$this->_sn;
		}
		return $ret;
	}
	
	/**
	 * 鍏抽棴杩炴帴
	 *
	 * @param int $flag 鍏抽棴閫夋嫨 0:鍏抽棴 Master 1:鍏抽棴 Slave 2:鍏抽棴鎵�湁
	 * @return boolean
	 */
	public function close($flag=2){
		switch($flag){
			// 鍏抽棴 Master
			case 0:
				$this->getRedis()->close();
				break;
				// 鍏抽棴 Slave
			case 1:
				for($i=0; $i<$this->_sn; ++$i){
					$this->_linkHandle['slave'][$i]->close();
				}
				break;
				// 鍏抽棴鎵�湁
			case 1:
				$this->getRedis()->close();
				for($i=0; $i<$this->_sn; ++$i){
					$this->_linkHandle['slave'][$i]->close();
				}
				break;
		}
		return true;
	}
	
	/**
	 * 寰楀埌 Redis 鍘熷瀵硅薄鍙互鏈夋洿澶氱殑鎿嶄綔
	 *
	 * @param boolean $isMaster 杩斿洖鏈嶅姟鍣ㄧ殑绫诲瀷 true:杩斿洖Master false:杩斿洖Slave
	 * @param boolean $slaveOne 杩斿洖鐨凷lave閫夋嫨 true:璐熻浇鍧囪　闅忔満杩斿洖涓�釜Slave閫夋嫨 false:杩斿洖鎵�湁鐨凷lave閫夋嫨
	 * @return redis object
	 */
	public function getRedis($isMaster=true,$slaveOne=true){
		// 鍙繑鍥�Master
		if($isMaster){
			return $this->_linkHandle['master'];
		}else{
			return $slaveOne ? $this->_getSlaveRedis() : $this->_linkHandle['slave'];
		}
	}
	
	/**
	 * 鍐欑紦瀛�
	 *
	 * @param string $key 缁勫瓨KEY
	 * @param string $value 缂撳瓨鍊�
	 * @param int $expire 杩囨湡鏃堕棿锛�0:琛ㄧず鏃犺繃鏈熸椂闂�
	 */
	public function set($key, $value, $expire=0){
		// 姘镐笉瓒呮椂
		if($expire == 0){
			$ret = $this->getRedis()->set($key, $value);
		}else{
			$ret = $this->getRedis()->setex($key, $expire, $value);
		}
		return $ret;
	}
	
	/**
	 * 璇荤紦瀛�
	 *
	 * @param string $key 缂撳瓨KEY,鏀寔涓�鍙栧涓�$key = array('key1','key2')
	 * @return string || boolean  澶辫触杩斿洖 false, 鎴愬姛杩斿洖瀛楃涓�
	 */
	public function get($key){
		// 鏄惁涓�鍙栧涓�
		$func = is_array($key) ? 'mGet' : 'get';
		// 娌℃湁浣跨敤M/S
		if(! $this->_isUseCluster){
			return $this->getRedis()->{$func}($key);
		}
		// 浣跨敤浜�M/S
		return $this->_getSlaveRedis()->{$func}($key);
	}
	
	/**
	 * 鏉′欢褰㈠紡璁剧疆缂撳瓨锛屽鏋�key 涓嶅瓨鏃跺氨璁剧疆锛屽瓨鍦ㄦ椂璁剧疆澶辫触
	 *
	 * @param string $key 缂撳瓨KEY
	 * @param string $value 缂撳瓨鍊�
	 * @return boolean
	 */
	public function setnx($key, $value){
		return $this->getRedis()->setnx($key, $value);
	}
	
	/**
	 * 鍒犻櫎缂撳瓨
	 *
	 * @param string || array $key 缂撳瓨KEY锛屾敮鎸佸崟涓仴:"key1" 鎴栧涓仴:array('key1','key2')
	 * @return int 鍒犻櫎鐨勫仴鐨勬暟閲�
	 */
	public function remove($key){
		// $key => "key1" || array('key1','key2')
		return $this->getRedis()->delete($key);
	}
	
	/**
	 * 鍊煎姞鍔犳搷浣�绫讳技 ++$i ,濡傛灉 key 涓嶅瓨鍦ㄦ椂鑷姩璁剧疆涓�0 鍚庤繘琛屽姞鍔犳搷浣�
	 *
	 * @param string $key 缂撳瓨KEY
	 * @param int $default 鎿嶄綔鏃剁殑榛樿鍊�
	 * @return int銆�搷浣滃悗鐨勫�
	 */
	public function incr($key,$default=1){
		if($default == 1){
			return $this->getRedis()->incr($key);
		}else{
			return $this->getRedis()->incrBy($key, $default);
		}
	}
	
	/**
	 * 鍊煎噺鍑忔搷浣�绫讳技 --$i ,濡傛灉 key 涓嶅瓨鍦ㄦ椂鑷姩璁剧疆涓�0 鍚庤繘琛屽噺鍑忔搷浣�
	 *
	 * @param string $key 缂撳瓨KEY
	 * @param int $default 鎿嶄綔鏃剁殑榛樿鍊�
	 * @return int銆�搷浣滃悗鐨勫�
	 */
	public function decr($key,$default=1){
		if($default == 1){
			return $this->getRedis()->decr($key);
		}else{
			return $this->getRedis()->decrBy($key, $default);
		}
	}
	
	/**
	 * 娣荤┖褰撳墠鏁版嵁搴�
	 *
	 * @return boolean
	 */
	public function clear(){
		return $this->getRedis()->flushDB();
	}
	
	/* =================== 浠ヤ笅绉佹湁鏂规硶 =================== */
	
	/**
	 * 闅忔満 HASH 寰楀埌 Redis Slave 鏈嶅姟鍣ㄥ彞鏌�
	 *
	 * @return redis object
	 */
	private function _getSlaveRedis(){
		// 灏变竴鍙�Slave 鏈虹洿鎺ヨ繑鍥�
		if($this->_sn <= 1){
			return $this->_linkHandle['slave'][0];
		}
		// 闅忔満 Hash 寰楀埌 Slave 鐨勫彞鏌�
		$hash = $this->_hashId(mt_rand(), $this->_sn);
		return $this->_linkHandle['slave'][$hash];
	}
	
	/**
	 * 鏍规嵁ID寰楀埌 hash 鍚�0锝瀖-1 涔嬮棿鐨勫�
	 *
	 * @param string $id
	 * @param int $m
	 * @return int
	 */
	private function _hashId($id,$m=10)
	{
		//鎶婂瓧绗︿覆K杞崲涓�0锝瀖-1 涔嬮棿鐨勪竴涓�浣滀负瀵瑰簲璁板綍鐨勬暎鍒楀湴鍧�
		$k = md5($id);
		$l = strlen($k);
		$b = bin2hex($k);
		$h = 0;
		for($i=0;$i<$l;$i++)
		{
		//鐩稿姞妯″紡HASH
		$h += substr($b,$i*2,2);
		}
		$hash = ($h*1)%$m;
		return $hash;
	}
}