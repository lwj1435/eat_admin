<?php
//yii::import("application.data.SQLConfig.php");
/**
 * BaseModel class.
 * BaseModel is the data structure for keeping
 * BaseModel is base model for model control sql. 
 */
class BaseModel{
	//private $sRtable;
	protected $sMtable;
	protected $sAbre;
	protected $aElement;
	protected $sPriKey;
	protected $bWriteSql;
	protected $sClassDesc;
	
	/**
	 * struct function
	 * @param unknown $sKey
	 */
	function __construct($sKey){
		if ($this->getConfig($sKey)) {
			
		}else{
			BaseFunctions::writeErr("create base model fault !");
		}
	}
	
	/**
	 * 
	 * @param unknown $sDesc
	 * @return boolean
	 */
	public function setDesc($sDesc){
		$this->sClassDesc = $sDesc;
		return true;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getDesc(){
		return $this->sClassDesc;
	}
	
	public function addElement($arr,$key,$value){
		if (key_exists($key, $this->aElement)) {
			return $arr[$key] = $value;
		}else{
			BaseFunctions::writeErr($this->getDesc()." is not exit element {$key} !");
			return $arr;
		}
		
	}
	
	/**
	 * get model base config
	 * @param string $sKey
	 * @return boolean
	 */
	protected function getConfig($sKey){
		//TODO the config file from 
		include  Yii::app()->basePath."/data/sqlCon/{$sKey}.php";
		if (key_exists($sKey, $aSQLCon)) {
			$this->sMtable = key_exists("tableName", $aSQLCon[$sKey])?'`'.$aSQLCon[$sKey]["tableName"].'`':false;
			$this->aElement = key_exists("element", $aSQLCon[$sKey])?$aSQLCon[$sKey]["element"]:false;
			$this->sPriKey = key_exists("priKey", $aSQLCon[$sKey])?$aSQLCon[$sKey]["priKey"]:false;
			$this->sAbre = key_exists("abre", $aSQLCon[$sKey])?$aSQLCon[$sKey]["abre"]:false;
			$this->bWriteSql= key_exists("showSql", $aSQLCon[$sKey])?$aSQLCon[$sKey]["showSql"]:false;
			return (!$this->sMtable&&!$this->aElement&&!$this->sPriKey&&!$this->sAbre)?false:true;
		}else{
			BaseFunctions::writeErr("{$sKey} model' config is not exists ! ");
			return false;	
		}
	}
	
	/**
	 * add msg into database
	 * @param unknown $aParam
	 * @param unknown $bShowSql
	 */
	function add($aParam,$bShowSql=false){
// 		if (!$this->sMtable&&$sTable!=$this->sMtable) {
// 			BaseFunctions::writeErr(" add function in basemodel table is error!");
// 			return false;
// 		}
		$bShowSql = $bShowSql?$bShowSql:$this->bWriteSql;
		$sErr = "";
		$aInserParam = array();
		$aInserRedisParam = array();
		foreach ($aParam as $sKey => $sSelVal){
			if (!key_exists($sKey, $this->aElement)) {
				BaseFunctions::writeErr(" add function in basemodel key is not exists");
				continue;
			}else if (key_exists('rule', $this->aElement[$sKey])&&$this->aElement[$sKey]['rule']) {
				$sErrMsg = Yii::app()->objRuleTest->testRule($this->aElement[$sKey]['rule'],$sSelVal);
				//RuleTest::getRuleTest()->testRule($this->aElement[$sKey]['rule'],$sSelVal);
				if (!$sErrMsg['type']) {
					$sErr .= $sKey." ".$sErrMsg['msg'];
					BaseFunctions::writeErr(" add function in basemodel ".$sErr);
				}else{
					$aInserParam[$sKey] = array("type"=>$this->aElement[$sKey]['type'],"val"=>$sSelVal);
					$aInserRedisParam[$sKey] = array("type"=>$this->aElement[$sKey]['rType'],"val"=>$sSelVal);
					//echo "ok";
				}
			}else{
					$aInserParam[$sKey] = array("type"=>$this->aElement[$sKey]['type'],"val"=>$sSelVal);
					$aInserRedisParam[$sKey] = array("type"=>$this->aElement[$sKey]['rType'],"val"=>$sSelVal);
			}
		}
		//m
		$result = Yii::app()->objMySql->add($this->sMtable,$aInserParam,$bShowSql);
		if ($result['type']) {
			//r objRedis
			$aInserRedisParam["&pri"] = $this->sPriKey;
			$aInserRedisParam[$this->sPriKey] = array("type"=>"string","val"=>$result['msg']);
			return Yii::app()->objRedis->add($this->sAbre,$aInserRedisParam,$bShowSql)?$result:false;
		}
		return $result;
	}
	
	/**
	 * 
	 * @param unknown $iId
	 * @param string $bShowSql
	 * @return boolean
	 */
	function delById($iId,$bShowSql=false){
		$bShowSql = $bShowSql?$bShowSql:$this->bWriteSql;
		if (!$iId) {
			BaseFunctions::writeErr(" delById function in basemodel id is null!");
			return BaseFunctions::returnResult(false, " id is null! ");
		}
		$bShowSql = $bShowSql?$bShowSql:$this->bWriteSql;
		$sWhere = " `{$this->sPriKey}` = {$iId} ";
		$aDelMySqlResult = Yii::app()->objMySql->del($this->sMtable,$sWhere,$bShowSql);
		if ($aDelMySqlResult['type']){
			$aParam = array("&pri"=>$this->sPriKey);
			foreach ($this->aElement as $sEleKey => $aEleMsg){
				if ($sEleKey!=$this->sPriKey) {
					$aParam[$sEleKey] = array("type"=> $aEleMsg['rType'],"val"=>"");
				}else{
					$aParam[$sEleKey] = array("type"=> "list","val"=>"{$iId}");
				}
				
			}
			//$this->test($aParam);
			return Yii::app()->objRedis->del($this->sAbre,$aParam,$bShowSql);
		}
		return $aDelMySqlResult;
	}
	
	/**
	 * 
	 * update data by table's id
	 * @param unknown $id
	 * @param unknown $aParam
	 * @param string $bShowSql
	 */
	function updateById($id,$aParam,$bShowSql = false){
		$bShowSql = $bShowSql?$bShowSql:$this->bWriteSql;
		$aUpdateMySqlArr = array();
		$aUpdateRedisArr = array();
		//先更新mysql 然后更新redis
		$aWhereRedisArr = array(Yii::app()->objRedis->getPriKey()=>$this->sPriKey,$this->sPriKey=>$id);
		foreach ($this->aElement as $sEleKey => $aEleArr){
			if (key_exists($sEleKey, $aParam)) {
				$aUpdateMySqlArr[$sEleKey] = array("val"=>$aParam[$sEleKey],"type"=>$aEleArr['type']);
				$aUpdateRedisArr[$sEleKey] = array("val"=>$aParam[$sEleKey],"type"=>$aEleArr['type']);
			}
		}
		//先更新mysql
		$aUpdateMySqlResult = Yii::app()->objMySql->update($this->sMtable," `{$this->sPriKey}` = {$id} ", $aUpdateMySqlArr, $bShowSql);
		if ($aUpdateMySqlResult['type']){ 
			//更新成功就更新redis
			return Yii::app()->objRedis->update($this->sAbre,$aWhereRedisArr,$aUpdateRedisArr,$bShowSql);
		}else {
			return $aUpdateMySqlResult;
		}
		
		//Yii::app()->objRedis->update($this->sAbre,)
	}
	
	/**
	 * 
	 * find msg by table's id
	 * @param unknown $iId
	 * @param string $bShowSql
	 * @return unknown
	 */
	function findById($iId,$bShowSql=false){
		//only from mysqls
		$bShowSql = $bShowSql?$bShowSql:$this->bWriteSql;
		$sRedisPrefix = Yii::app()->redis->prefix;
		$aFindParam = array("&pri"=>$this->sPriKey);
		foreach ($this->aElement as $sEleKey => $aEleVal){
				if ($sEleKey!=$this->sPriKey) {
					$aFindParam[$sEleKey] = array("type"=> $aEleVal['rType'],"val"=>"");
				}else{
					$aFindParam[$sEleKey] = array("type"=> "list","val"=>"{$iId}");
				}
		}
		$aRedisResult = Yii::app()->objRedis->find($this->sAbre, $aFindParam, $bShowSql);
		$aRedisArr = $aRedisResult['msg'];
		
		if ($aRedisResult['type']&&key_exists($this->sPriKey, $aRedisArr)&&$aRedisArr[$this->sPriKey]) {
			return $aRedisResult;
		}
		$sWhere = " `{$this->sPriKey}` = '{$iId}' ";
		$aMySqlResult = Yii::app()->objMySql->find($this->sMtable, $sWhere, $bShowSql);
		if ($aMySqlResult['type']) {
			foreach ($aMySqlResult['msg'][0] as $sAddKey => $sAddVal){
				if (key_exists($sAddKey, $aFindParam)) {
					$aFindParam[$sAddKey]['val'] = $sAddVal;
				}
			}
			Yii::app()->objRedis->add($this->sAbre, $aFindParam, $bShowSql);
		}
		return $aMySqlResult;
	}
	
	function find($sFind,$sWhere,$bShowSql=false){
		$aMySqlResult = Yii::app()->objMySql->findDetail($this->sMtable,$sWhere,$sFind,$bShowSql);
		return $aMySqlResult;
	}
	
	function test($a){
		echo "<xmp>";
		print_r($a);
		echo "</xmp>";
	}
	
	function pageGet($select, $where, $startPage=1, $pageNum=10, $group='', $order='', $isEcho = false,$isGetLast=true){
		$aMySqlResult = Yii::app()->objMySql->pageGet($select, $this->sMtable,$where, $startPage, $pageNum, $group, $order, true,$isGetLast);
		return $aMySqlResult;
	}
	
	function yiiPage($className,$select, $where=" 1 ", $startPage=1, $pageNum=10, $count=1,$group='', $order=''){
		$iPageNum = $pageNum?$pageNum:10;
		$iCount = $count<1?1:$count;
		$pageVar= $startPage<1?1:$startPage;
		$pageVar = $iCount>1?1:$pageVar;
		$ilimit = $iPageNum * $iCount;
		$where = $where?$where:' 1 ';
		$criteria = new CDbCriteria();
		
		if ($order) {
			$criteria->order = 'id DESC';
		}
	
		$criteria->condition = $where;
	
		$list = $className::model()->findAll($criteria);
	
		return $list;
	}
	
	/**
	 * 
	 * @param string $className
	 * @param array $aJoinTable
	 * @param string $select
	 * @param string $where
	 * @param number $startPage
	 * @param number $pageNum
	 * @param number $count
	 * @param string $group
	 * @param string $order
	 * @return unknown
	 */
	function yiiPageWithJoin($className,$aJoinTable,$select, $where=" 1 ", $startPage=1, $pageNum=10, $count=1,$group='', $order=''){
		$iPageNum = $pageNum?$pageNum:10;
		$iCount = $count<1?1:$count;
		$pageVar= $startPage<1?1:$startPage;
		$pageVar = $iCount>1?1:$pageVar;
		$ilimit = $iPageNum * $iCount;
		$where = $where?$where:' 1 ';
		$criteria = new CDbCriteria();
		
		if ($order) {
			$criteria->order = 'id DESC';
		}
		
		$criteria->condition = $where;
		$criteria->with = $aJoinTable;
		$list = $className::model()->findAll($criteria);
		
		return $list;
	}
	
	function count($className, $where=" 1 "){
		$criteria = new CDbCriteria();
		
		$criteria->condition = $where;
		
		$count = $className::model()->count($criteria);
	
		return $count;
	}
	
}
?>