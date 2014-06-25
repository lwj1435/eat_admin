<?php
/**
 *
* @author jen
* Seat model
*/
class Seat extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$sTableKey = "or_merchant_seat";
		parent::__construct($sTableKey);
	}
	
	public function getTableKey(){
		return $this->sTableKey;
	}
	
	public function changeSeatStatus($iMerchantId,$iSeatId,$iStatus,$iFromSta=0,$bShowSql=false){
		$aRe = $this->findById($iSeatId);
		if (!isset($aRe['msg'])||!$aRe['msg'][0]||$aRe['msg'][0]['merchant_id']!=$iMerchantId) {
			return BaseFunctions::returnResult(false, "没权限，或没改桌面");
		}else if($iFromSta>0&&$aRe['msg'][0]['status']!=$iFromSta){
			return BaseFunctions::returnResult(false, "没改桌面状态");
		}
		$aParam = array('status'=>$iStatus);
		$this->updateById($iSeatId, $aParam,$bShowSql);
		return BaseFunctions::returnResult(true, "更改完成");
	}
}
?>