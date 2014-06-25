<?php
class MyRedisClass  implements SQLInterface{
	
	private $sPriKey = "&pri";
	
	public function init(){
		$this->sPriKey = "&pri";
	}
	
	public function getPriKey(){
		return $this->sPriKey;
	}
	
	/* (non-PHPdoc)
	 * @see SQLInterface::add()
	 */
	public function add($sTable, $aParam, $bShow) {
		//TODO �ж��Ƿ��Ѿ������ˣ�Ȼ������ظ�����
		//$sPriKey =  key_exists('&pri', $aParam)?$aParam['&pri']:"";
		$sPriKey = $this->getPriKeyName($aParam);
		if(!$sPriKey){
			return BaseFunctions::returnResult(false, "prikey is undefine!");
		}
		$iId = $sPriKey?$aParam[$sPriKey]['val']:"0";
		// TODO Auto-generated method stub
		foreach ($aParam as $sKey => $aVal){
			$sAddKey = $sKey.".{$iId}";
		 	if($sKey==$sPriKey){
				if(!$this->executeAdd($sTable,$sPriKey, array($aVal['val']), "set", $bShow)){
					return BaseFunctions::returnResult(false, "add prikey:{$sPriKey} error!");
				}
			}elseif ($sKey!="&pri") {
				if(!$this->executeAdd($sTable, $sAddKey, $aVal['val'], $aVal['type'], $bShow)){
					return BaseFunctions::returnResult(false, "add key:{$sAddKey} error!");
				}
			}else{
				
			}
		}
		return BaseFunctions::returnResult(true, "add key:{$sAddKey} error!");
	}

	/* (non-PHPdoc)
	 * @see SQLInterface::update()
	 */
	public function update($sTable, $sWhere, $aParam, $bShow) {
		// TODO Auto-generated method stub
		//id һ��Ҫ���table��id�ֶε�ֵ
		$sPriKey = $this->getPriKeyName($sWhere);
		if(!$sPriKey){
			return BaseFunctions::returnResult(false, "prikey is undefine!");
		}
		$iVal = key_exists($sPriKey, $sWhere)?$sWhere[$sPriKey]:"";
		if (!$iVal) {
			return BaseFunctions::returnResult(false, "prikey's value is undefine!");
		}
		//主键的保证
		$this->executeAdd($sTable,$sPriKey, array($sWhere[$sPriKey]), "set", $bShow);
		
		foreach ($aParam as $sFindKey => $aFindVal){
			$sUpKey = $sFindKey.".{$iVal}";
		 	if($sFindKey==$sPriKey){
		 		BaseFunctions::writeErr(" update function's priKey isn't allow  ");
		 		/*
				if(!$this->executeAdd($sTable,$sPriKey, array($aFindVal['val']), "list", $bShow)){
					return false;
				}*/
			}elseif ($sFindKey!="&pri") {
				if(!$this->executeAdd($sTable, $sUpKey, $aFindVal['val'], $aFindVal['type'], $bShow)){
					return BaseFunctions::returnResult(false, "update {$sTable} error!");
				}
			}else{
				
			}
		}
		return BaseFunctions::returnResult(true, "");
	}

	/* (non-PHPdoc)
	 * @see SQLInterface::find()
	 */
	public function find($sTable, $aParam, $bShow) {
		// TODO Auto-generated method stub
// 		$sPriKey =  key_exists('&pri', $aParam)?$aParam['&pri']:"";
// 		if (!$sPriKey||!key_exists($sPriKey, $aParam)||!key_exists('val', $aParam[$sPriKey])||!$aParam[$sPriKey]['val']) {
// 			BaseFunctions::writeErr("redis find error with not prikey's value!");
// 			return BaseFunctions::returnResult(false, "prikey is undefine!");
// 		}
		$sPriKey = $this->getPriKeyName($aParam);
		if(!$sPriKey){
			return BaseFunctions::returnResult(false, "prikey is undefine!");
		}
		$iId = $sPriKey?$aParam[$sPriKey]['val']:"0";
		$aResult = array();
		foreach($aParam as $sKey => $aVal){
			$sFindKey = $sKey.".{$iId}";
			if($sKey==$sPriKey){
				$aFindResult = $this->executeFind($sTable,$sPriKey, array($aVal['val']), "list", $bShow);
				$aResult[$sKey] = $aFindResult;
			}elseif ($sKey!="&pri") {
				$aFindResult = $this->executeFind($sTable, $sFindKey, $aVal['val'], $aVal['type'], $bShow);
				$aResult[$sKey] = $aFindResult;
			}else{
				
			}
		}
		return BaseFunctions::returnResult(true, $aResult);
// 		return $aResult;
	}

	/* (non-PHPdoc)
	 * @see SQLInterface::del()
	 */
	public function del($sTable, $aParam, $bShow) {
		// TODO Auto-generated method stub
// 		$sPriKey =  key_exists('&pri', $aParam)?$aParam['&pri']:"";
// 		if (!$sPriKey||!key_exists('val', $aParam[$sPriKey])||!$aParam[$sPriKey]['val']) {
// 			BaseFunctions::writeErr("redis del error with not prikey's value!");
// 			return false;
// 		}
		$sPriKey = $this->getPriKeyName($aParam);
		if(!$sPriKey){
			return BaseFunctions::returnResult(false, "prikey is undefine!");
		}
		$iId = $sPriKey?$aParam[$sPriKey]['val']:"0";
		// TODO Auto-generated method stub
		foreach ($aParam as $sKey => $aVal){
			$sDelKey = $sKey.".{$iId}";
			
			if($sKey==$sPriKey){
				if(!$this->executeDel($sTable,$sPriKey, array($aVal['val']), "set", $bShow)){
					return BaseFunctions::returnResult(false, "del prikey error!");
				}
			}elseif ($sKey!="&pri") {
				if(!$this->executeDel($sTable, $sDelKey, $aVal['val'], $aVal['type'], $bShow)){
					return BaseFunctions::returnResult(false, "del key:{$sDelKey} error!");
				}
			}else{
				
			}
		}
		return BaseFunctions::returnResult(true, "del ok!");
	}
	
	/**
	 * (non-PHPdoc)
	 * @see SQLInterface::findDetail()
	 */
	public function findDetail($sTable,$aParam,$aFind,$bShow){
		
	}
	
	/**
	 * 
	 * @param unknown $sTable
	 * @param unknown $sKey
	 * @param unknown $val
	 * @param unknown $type
	 * @param unknown $bShow
	 * @return data
	 */
	public function executeFind($sTable,$sKey,$val,$type, $bShow){
		if (!$sKey) {
			return false;
		}
		$sKey = $sTable.".".$sKey;
		$sMsg = json_encode($val);
		switch ($type){
			case "string":
				if ($bShow) {
					BaseFunctions::writeLog("redis find function string -> table:{$sTable} key:{$sKey} val:{$sMsg}");
				}
				return Yii::app()->redis->getClient()->get($sKey);
				break;
			case "hash":
				if ($bShow) {
					BaseFunctions::writeLog("redis find function hash -> table:{$sTable} key:{$sKey} val:{$sMsg}");
				}
				$hash = new ARedisHash($sKey);
				$aAllData = $hash->getData();
				$returnData = array();
				if ($val) {
					if (is_array($val)) {
						foreach ($val as $iValKey => $sValHashKey){
							if (key_exists($sValHashKey, $aAllData)) {
								$returnData[$sValHashKey] = $aAllData[$sValHashKey];
							}else{
								$returnData[$sValHashKey] = "";
							}
						}
					}else{
						if (key_exists($val, $aAllData)){
							$returnData[$val] = $aAllData[$val];
						}else{
							$returnData[$val] = "";
						}
					}
				}else{
					$returnData = $aAllData;
				}
				return $returnData;
				break;
			case "set":
				if ($bShow) {
					BaseFunctions::writeLog("redis find function set -> table:{$sTable} key:{$sKey} val:{$sMsg}");
				}
				$oRedisSet = new ARedisSet($sKey);
				return $oRedisSet;
				break;
			case "storeset":
				if ($bShow) {
					BaseFunctions::writeLog("redis find function storeset -> table:{$sTable} key:{$sKey} val:{$sMsg}");
				}
				$aAllData = new ARedisSortedSet($sKey);
				$returnData = array();
				if ($val) {
					if (is_array($val)) {
						foreach ($val as $iValKey => $sValHashKey){
							if (key_exists($sValHashKey, $aAllData)) {
								$returnData[$sValHashKey] = $aAllData[$sValHashKey];
							}else{
								$returnData[$sValHashKey] = "";
							}
						}
					}else{
						if (key_exists($val, $aAllData)){
							$returnData[$val] = $aAllData[$val];
						}else{
							$returnData[$val] = "";
						}
					}
				}else{
					$returnData = $aAllData;
				}
				return $returnData;
				break;
			case "list":
				if ($bShow) {
					BaseFunctions::writeLog("redis find function list -> table:{$sTable} key:{$sKey} val:{$sMsg}");
				}
				
				$oRL = new ARedisList($sKey);
				//$oRL->range(0,-1);
				$aAllData =  $oRL->getData(true);
				$sFindVal = is_array($val)?$val[0]:$val;
				if ($sFindVal) {
					foreach ($aAllData as $iValKey => $sValKey){
						if ($sValKey == $sFindVal) {
							return $sValKey;
						}
					}
				}
				
				return "";
				break;
			default:
				return Yii::app()->redis->getClient()->get($sKey);
				break;
		}
		return "";
	}
	
	/**
	 * 
	 * @param unknown $sTable
	 * @param unknown $sKey
	 * @param unknown $val
	 * @param unknown $type
	 * @param unknown $bShow
	 */
	public function executeDel($sTable,$sKey,$val,$type, $bShow){
		if (!$sKey) {
			return false;
		}
		$sKey = $sTable.".".$sKey;
		$sMsg = json_encode($val);
		switch ($type){
			case "string":
				if (is_array($val)) {
					BaseFunctions::writeLog("executeDel ���������! key:{$sKey} val:{$val} type:{$type} ");
					return false;
				}
				if (Yii::app()->redis->getClient()->exists($sKey))
					Yii::app()->redis->getClient()->del($sKey);
				else 
					BaseFunctions::writeLog("executeDel �����ڵ�key! key:{$sKey} val:{$val} type:{$type} ");
				
				if ($bShow) {
					BaseFunctions::writeLog("redis del string -> table:{$sTable} key:{$sKey} val:{$sMsg}");
				}
				return true;
				break;
		case "hash":
				$hash = new ARedisHash($sKey);
				if (is_array($val)){
					foreach ($val as $sAddKey => $sAddVal){
						//ֱ�Ӵ�key����ɾ��
						$hash->remove($sAddKey);
					}
				}else{
					BaseFunctions::writeErr("redis hash del val type  error!  table:{$sTable} key:{$sKey} val: {$sMsg}");
					return false;
				}
				if ($bShow) {
					BaseFunctions::writeLog("redis del hash -> table:{$sTable} key:{$sKey} val:{$sMsg}");
				}
				return true;
				break;
			case "set":
				$set = new ARedisSet($sKey);
				if (is_array($val)){
					foreach ($val as $iValKey => $sAddVal){
						$set->remove($iValKey);
					}
				}else{
					BaseFunctions::writeErr("redis set add del type  error!  table:{$sTable} key:{$sKey} val: {$sMsg}");
					return false;
				}
				if ($bShow) {
					BaseFunctions::writeLog("redis del set -> table:{$sTable} key:{$sKey} val:{$sMsg}");
				}
				return true;
				break;
			case "storeset":
				$sortedSet = new ARedisSortedSet($sKey);
				if (is_array($val)){
					foreach ($val as $sAddKey => $sAddVal){
						$sortedSet->remove($sAddKey);
					}
				}else{
					BaseFunctions::writeErr("redis storeset del val type  error!  table:{$sTable} key:{$sKey} val: {$sMsg}");
					return false;
				}
				if ($bShow) {
					BaseFunctions::writeLog("redis del storeset -> table:{$sTable} key:{$sKey} val:{$sMsg}");
				}
				return true;
				break;
			case "list":
				$list = new ARedisList($sKey);
				if (is_array($val)){
					foreach ($val as $iValKey => $sAddVal){
						//list remove list
						$list->remove($sAddVal);
					}
				}else{
					BaseFunctions::writeErr("redis list del val type  error!  table:{$sTable} key:{$sKey} val: {$sMsg}");
					return false;
				}
				if ($bShow) {
					BaseFunctions::writeLog("redis add list -> table:{$sTable} key:{$sKey} val:{$sMsg}");
				}
				return true;
				break;
			default:
				if (is_array($val)) {
					BaseFunctions::writeLog("���������! key:{$sKey} val:{$val} type:{$type} ");
					return false;
				}
				if (Yii::app()->redis->getClient()->exists($sKey))
					Yii::app()->redis->getClient()->del($sKey);
				else 
					BaseFunctions::writeLog("executeDel �����ڵ�key! key:{$sKey} val:{$sMsg} type:{$type} ");
				return true;
				break;
		}
		return false;
	}
	
	/**
	 * 
	 * add string
	 * @param unknown $sTable
	 * @param unknown $sKey
	 * @param unknown $val
	 * @param unknown $type
	 * @param unknown $bShow
	 * @return boolean
	 */
	public function executeAdd($sTable,$sKey,$val,$type, $bShow){
		if (!$sKey) {
			return false;
		}
		$sKey = $sTable.".".$sKey;
		$sMsg = json_encode($val);
		switch ($type){
			case "string":
				if (is_array($val)) {
					if (key_exists("val", $val)) {
						Yii::app()->redis->getClient()->set($sKey, $val['val']);
					}else{
						BaseFunctions::writeLog("executeAdd string error! key:{$sKey} val:{$sMsg} type:{$type} ");
						return false;
					}
				}
				if ($bShow) {
					BaseFunctions::writeLog("redis add string -> table:{$sTable} key:{$sKey} val:{$sMsg}");
				}
				return Yii::app()->redis->getClient()->set($sKey, $val);
				break;
			case "hash":
				
				$hash = new ARedisHash($sKey);
				if (is_array($val)){
					foreach ($val as $sAddKey => $sAddVal){
						$hash->add($sAddKey,$sAddVal);
					}
				}else{
					BaseFunctions::writeErr("redis hash add val type  error!  table:{$sTable} key:{$sKey} val: {$sMsg}");
					return false;
				}
				if ($bShow) {
					BaseFunctions::writeLog("redis add hash -> table:{$sTable} key:{$sKey} val:{$sMsg}");
				}
				return true;
				break;
			case "set":
				$set = new ARedisSet($sKey);
				if (is_array($val)){
					foreach ($val as $iValKey => $sAddVal){
						$set->add($sAddVal);
					}
				}else{
					BaseFunctions::writeErr("redis set add val type error!  table:{$sTable} key:{$sKey} val: {$sMsg}");
					return false;
				}
				if ($bShow) {
					BaseFunctions::writeLog("redis add set -> table:{$sTable} key:{$sKey} val:{$sMsg}");
				}
				return true;
				break;
			case "storeset":
				$sortedSet = new ARedisSortedSet($sKey);
				if(is_array($val)){
					foreach ($val as $sAddKey => $sAddVal){
						$sortedSet->add($sAddKey,$sAddVal);
					}
				}else{
					BaseFunctions::writeErr("redis storeset add val type error!  table:{$sTable} key:{$sKey} val: {$sMsg}");
					return false;
				}
				if ($bShow) {
					BaseFunctions::writeLog("redis add storeset -> table:{$sTable} key:{$sKey} val:{$sMsg}");
				}
				return true;
				break;
			case "list":
				$list = new ARedisList($sKey);
				if(is_array($val)){
					foreach ($val as $iValKey => $sAddVal){
						$list->add($sAddVal);
					}
				}else{
					BaseFunctions::writeErr("redis list add val type error!  table:{$sTable} key:{$sKey} val: {$sMsg}");
					return false;
				}
				if ($bShow) {
					BaseFunctions::writeLog("redis add list -> table:{$sTable} key:{$sKey} val:{$sMsg}");
				}
				return true;
				break;
			default:
				if (is_array($val)) {
					BaseFunctions::writeLog("���������! key:{$sKey} val:{$val} type:{$type} ");
					return false;
				}
				Yii::app()->redis->getClient()->set($sKey, $val);
				if ($bShow) {
					BaseFunctions::writeLog("redis add list -> table:{$sTable} key:{$sKey} val:{$sMsg}");
				}
				return true;
				break;
		}
		return false;
	}
	
	/**
	 * 
	 * @param unknown $aArr
	 * @param string $sMsg
	 * @return Ambigous <boolean, string>
	 */
	private function getPriKeyName($aArr,$sMsg = "undefined"){
		$sPrikeyName = key_exists($this->getPriKey(), $aArr)?$aArr[$this->getPriKey()]?$aArr[$this->getPriKey()]:false:false;
		if(!$sPrikeyName){
			BaseFunctions::writeLog("redis {$sMsg} function prikey is undefined !");
			return false;
		}else{
			return $sPrikeyName;
		}
	}
	
}

?>