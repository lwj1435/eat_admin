<?php
class Activity extends BaseModel{
	private $sTableKey;
	public function __construct(){
		$sTableKey = "activity_list";
		parent::__construct($sTableKey);
	}
	
	public function getTableKey(){
		return $this->sTableKey;
	}
	
	public function getReferrals($select, $where=" 1 ", $pro='',$area='',$city='' ,$startPage=1, $pageNum=10, $count=1,$group='', $order=''){
		return $this->yiiPageWithJoin("ActivityList",array('actiMerMsg'),$select, $where, $startPage, $pageNum, $count,$group, $order);
// 		return $this->yiiPage("ActivityListModel",$select, $where, $startPage, $pageNum, $count,$group, $order);
	}
	
	public function getUserJoinAc($select, $where=" 1 ", $pro='',$area='',$city='' ,$startPage=1, $pageNum=10, $count=1,$group='', $order=''){
		return $where;
		$where .= " and t.type= 2 s ";
		return $where;
		return $this->yiiPageWithJoin("ActivityList",array('joinList'),$select, $where, $startPage, $pageNum, $count,$group, $order);
	}
	
	/**
	 * 添加活动
	 * @param unknown $iAddUserId
	 * @param unknown $sName
	 * @param unknown $sContent
	 * @param unknown $iMerchantId
	 * @param unknown $iType 1为免费试吃
	 * @param unknown $sActivityName
	 * @param string $desc
	 * @param string $logo
	 * @return Ambigous <boolean, unknown>
	 */
	public function addActivity($iAddUserId,$sName,$sContent,$iMerchantId,$iType,$sActivityName,$desc='',$logo=''){
		$aParam = array(
				'user_id' => $iAddUserId,
				'user_name' => $sName,
				'activity_type' => $iType,
				'activity_name' => $sActivityName,
				'activity_content' => $sContent,
				'real_join' => '',
				'desc' => $desc,
				'logo' => $logo,
				'merchant_id' => $iMerchantId,
		);
		return $this->add($aParam);
	}
	
	public function delActivity($iFFId){
		$aParam = array(
				'status'=>-1
		);
		return $this->updateById($iFFId, $aParam);
	}
	
	public function upActivity($iFFId,$iAddUserId,$sName,$iNum,$sContent,$iStartTime,$iEndTime,$iMerchantId,$iMageList){
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