<?php
class CoupController extends BaseController{
	public function actionCoupList(){
		
	}
	
	/**
	 * 获取用户的优惠卷
	 */
	public function actionUserCoupList(){
		$aData = json_decode($_REQUEST['d'],true);
		//添加人id
		$iAddId = isset($aData['user_id'])?$aData['user_id']:'64'  ;
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';'1';
		$aDishesList = isset($aData['dishes_list'])?$aData['dishes_list']:array();//array(1,2,3,10,11,13);
		$o = new Coupon();
		$aRe = $o->findAllCounpWithUserId($iAddId,$iMerchantId,$aDishesList);
		$aResult = array();
		BaseFunctions::outputResult(true, $aRe);
	}
}
?>