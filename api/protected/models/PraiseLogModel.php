<?php
class PraiseLogModel extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$this->sTableKey = "praise_log";
		parent::__construct($this->sTableKey);
	}

	public function getTableKey(){
		return $this->sTableKey;
	}
	public function addPraiseLog($be_id,$type,$user_id){
		$aParam = array();
		$aParam["time"]=time();
		$aParam["be_id"]=$be_id;
		$aParam["type"]=$type;
		$aParam["user_id"]=$user_id;
		return $this->add($aParam,true);
	}

	/**
	 * 统计数量
	 * @param unknown $type 1 菜品 2优惠 3促销 4 商家 5.......
	 * @param unknown $id
	 */
	public function coutPraiseNum($type,$id){
		$sFind = " sum(1) as num ";
		$sWhere = " type = {$type} and be_id = {$id} ";
		$re = $this->find($sFind, $sWhere);
		return isset($re['msg'][0]['num'])?($re['msg'][0]['num']?$re['msg'][0]['num']:0):0;
	}
	
}
?>

