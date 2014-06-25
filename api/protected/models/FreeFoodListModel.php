<?php
class FreeFoodListModel extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$sTableKey = "free_food_list";
		parent::__construct($sTableKey);
	}
	
	public function getTableKey(){
		return $this->sTableKey;
	}
	
	public function addFFL($iAddUserId,$sName,$iNum,$sContent,$iStartTime,$iEndTime,$iMerchantId,$iMageList){
		$aParam = array();
		$aParam['ff_name'] = $sName;
		$aParam['ff_content'] = $sContent;
		$aParam['join_num'] = $iNum;
		$aParam['add_user_id'] = $iAddUserId;
		$aParam['add_time'] = time();
		$aParam['start_time'] = $iStartTime;
		$aParam['end_time'] = $iEndTime;
		$aParam['merchant_id'] = $iMerchantId;
		$aParam['status'] = '0';
		$aParam['image_list'] = $iMageList;
		return $this->add($aParam);
	}
	
	public function delFFL($iFFId){
		$aParam = array(
				'status'=>-1
		);
		return $this->updateById($iFFId, $aParam);
	} 
	
	public function upFFL($iFFId,$iAddUserId,$sName,$iNum,$sContent,$iStartTime,$iEndTime,$iMerchantId,$iMageList){
		$aParam = array();
		$aParam['ff_name'] = $sName;
		$aParam['ff_content'] = $sContent;
		$aParam['join_num'] = $iNum;
		$aParam['add_user_id'] = $iAddUserId;
		$aParam['start_time'] = $iStartTime;
		$aParam['end_time'] = $iEndTime;
		$aParam['merchant_id'] = $iMerchantId;
		$aParam['image_list'] = $iMageList;
		return $this->updateById($iFFId, $aParam);
	}
	
	public function fflList($select="*", $where=" 1 ", $startPage=1, $pageNum=10, $count=1,$group='', $order=''){
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