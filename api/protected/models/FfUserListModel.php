<?php
class FfUserListModel extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$sTableKey = "ff_user_list";
		parent::__construct($sTableKey);
	}
	
	public function getTableKey(){
		return $this->sTableKey;
	}
	
	/**
	 * 报名试食活动
	 * @param unknown $iAddUserId
	 * @param unknown $sName
	 * @param unknown $iPhone
	 * @param unknown $sEmail
	 * @param unknown $iActivityId 1 为试食团得报名
	 * @param unknown $sQq
	 * @param number $iActivityType
	 * @return Ambigous <boolean, unknown>
	 */
	public function addFFUL($iAddUserId,$sName,$iPhone,$sEmail,$iActivityId,$sQq,$iActivityType=1){
		//TODO 判断是否在仔黑名单
		//TODO 判断是否已经报了名字
		$aParam = array(
				'user_id' => $iAddUserId,
				'user_name' => $sName,
				'join_activity_id' => $iActivityId,
				'join_activity_type' => $iActivityType,
				'add_time' => time(),
				'status' => '0',
				'phone' => $iPhone,
				'email' => $sEmail,
				'qq' => $sQq,
		);
		return $this->add($aParam);
	}
	
	public function delFFUL($iFFId){
		$aParam = array(
				'status'=>-1
		);
		return $this->updateById($iFFId, $aParam);
	}
	
	public function upFFUL($iFFId,$iAddUserId,$sName,$iPhone,$sEmail,$iActivityId,$sQq){
		
		// 判断是否在仔黑名单
		$aParam = array(
				'user_id' => $iAddUserId,
				'user_name' => $sName,
				'join_activity_id' => $iActivityId,
				'status' => '0',
				'phone' => $iPhone,
				'email' => $sEmail,
				'qq' => $sQq,
		);
		return $this->updateById($iFFId,$aParam);
	}
	
	public function FFULList($select="*", $where=" 1 ", $startPage=1, $pageNum=10, $count=1,$group='', $order=''){
		$select = $select?$select:"*";
		$where=$where?$where:" 1 ";
		$startPage=$startPage?$startPage:1;
		$pageNum=$pageNum?$pageNum:10;
		$count=$count?$count:1;
		$group=$group?$group:'';
		$order=$order?$order:'';
		$this->yiiPage("FreeFoodList", $select, $where, $startPage, $pageNum, $count,$group, $order);
	}
}

?>