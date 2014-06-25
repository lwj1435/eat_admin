<?php
class TranslationLogModel extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$this->sTableKey = "translation_log";
		parent::__construct($this->sTableKey);
	}

	public function getTableKey(){
		return $this->sTableKey;
	}
	
	public function addTranslationLog($be_id,$type,$user_id,$translation_type){
		$aParam = array();
		$aParam["time"]=time();
		$aParam["be_id"]=$be_id;
		$aParam["type"]=$type;
		$aParam["user_id"]=$user_id;
		$aParam["translation_type"]=$translation_type;
		return $this->add($aParam,true);
	}
	
	/**
	 * 统计数量
	 * @param unknown $type 1 菜品 2优惠 3促销 4 商家 5.......
	 * @param unknown $id
	 */
	public function coutTranslateNum($type,$id){
		$sFind = " sum(1) as num ";
		$sWhere = " type = {$type} and be_id = {$id} ";
		$re = $this->find($sFind, $sWhere);
		return isset($re['msg'][0]['num'])?($re['msg'][0]['num']?$re['msg'][0]['num']:0):0;
	}
	

}
?>

