<?php
class ViewLogModel extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$this->sTableKey = "view_log";
		parent::__construct($this->sTableKey);
	}

	public function getTableKey(){
		return $this->sTableKey;
	}
	/**
	 * 添加浏览记录
	 * @param unknown $user_id
	 * @param unknown $type
	 * @param unknown $be_id
	 * @return Ambigous <boolean, unknown>
	 */
	public function addViewLog($user_id,$type,$be_id){
		$aParam = array();
		$aParam["time"]=time();
		$aParam["user_id"]=$user_id;
		$aParam["type"]=$type;
		$aParam["be_id"]=$be_id;
		return $this->add($aParam,true);
	}
	/**
	 * 统计数量
	 * @param unknown $type 1 菜品 2优惠 3促销 4 商家 5.......
	 * @param unknown $id
	 */
	public function coutViewNum($type,$id){
		$sFind = " sum(1) as num ";
		$sWhere = " type = {$type} and be_id = {$id} ";
		$re = $this->find($sFind, $sWhere);
		return isset($re['msg'][0]['num'])?($re['msg'][0]['num']?$re['msg'][0]['num']:0):0;
	}
	
}
?>
