<?php

class MerchantSeat extends BaseModel {
	
	private $sTableKey;
	public function __construct(){
		$sTableKey = "or_merchant_seat";
		parent::__construct($sTableKey);
	}
	
	public function getTableKey(){
		return $this->sTableKey;
	}
	
// 	/**
// 	 *
// 	 * @param unknown $sType array(0=>全部,A=>2人,B=>2到4人，C=>5-8人,D=>包厢)
// 	 */
// 	public function getBookReachNum($sType=''){
// 		if ($iType) {
// 			$sWhere = " `account_name` = '{$accountName}' and password = '{$password}' and `type` = '{$type}' ";
// 			$sFind = "";
// 			return Yii::app()->objMySql->findDetail($this->sMtable,$sWhere,$sFind,false);
// 		}else{
				
// 		}
// 	}
	
// 	private function getBookReachNumByType($sType){
// 		$sWhere = " `status` = '{$accountName}' and `seat_type` = '{$sType}' ";
// 		$sFind = "";
// 		return Yii::app()->objMySql->findDetail($this->sMtable,$sWhere,$sFind,false);
// 	}
	
	/**
	 * 获取座位统计
	 * @param unknown $iMerchantId
	 * @return unknown
	 */
	public function getTotal($iMerchantId){
		$sFind = " count(1) as num , `status` ";
		$sWhere = " `merchant_id` = '{$iMerchantId}'  group by `status` ";
		$aArr = $this->find($sFind, $sWhere);
		return $aArr;
	}
}

?>
