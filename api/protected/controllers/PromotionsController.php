<?php
/**
 * 促销优惠管理
 * @author Administrator
 *
 */				
class PromotionsController extends BaseController
{
	public function actionAddCoupon(){
		$oCoupon = new Coupon();
		BaseFunctions::writeLog(json_encode($_REQUEST));
		$aData = json_decode($_REQUEST['d'],true);
		BaseFunctions::writeLog(json_encode($aData));
		$iAddUserId = isset($aData['user_id'])?$aData['user_id']:'';
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$aData['pri_goods_list_array_temp'] = isset($aData['pri_goods_list'])?$aData['pri_goods_list']:array();
		$aData['pri_goods_list'] = $this->stringAndArray($aData['pri_goods_list'],false);
		//BaseFunctions::writeLog("begin");
		$oCoupon->addCoupon($iAddUserId, $iMerchantId, $aData);
	}
	
	public function actionAddPromotion(){
		$aData = json_decode($_REQUEST['d'],true);
		//添加人id
		$iAddId = isset($aData['user_id'])?$aData['user_id']:''  ;
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:''  ;
		$aPriGoodsList = isset($aData['pri_goods_list'])?$aData['pri_goods_list']:array();
		$aData['pri_goods_list'] = $this->stringAndArray($aData['pri_goods_list'],false);
		$sGoodsName = isset($aData['goods_name'])?$aData['goods_name']:''  ;//促销名称
		$goods_v_type = isset($aData['goods_v_type'])?$aData['goods_v_type']:''  ;//促销类型
		$sTBeginTime = isset($aData['t_begin_time'])?$aData['t_begin_time']:''  ;//开始日期
		$sTEndTime = isset($aData['t_end_time'])?$aData['t_end_time']:''  ;//结束日期
		$iPriTimePer = isset($aData['pri_time_per'])?$aData['pri_time_per']:'0'  ;//优惠率
// 		$aPriGoodsList = isset($aData['pri_goods_list'])?$aData['pri_goods_list']:array()  ;//菜品列表
		$iPriGoodsPer = isset($aData['pri_goods_per'])?$aData['pri_goods_per']:'0'  ;//优惠绿
		$iVipPer = isset($aData['vip_per'])?$aData['vip_per']:''  ;//会员优惠
		$iPerType = isset($aData['per_type'])?$aData['per_type']:''  ;//促销类型
		$iVarilBeginTime = isset($aData['varil_begin_time'])?strtotime($aData['varil_begin_time']):'0'  ;//开始日期
		$iVarilEndTime = isset($aData['varil_end_time'])?strtotime($aData['varil_end_time']):'0'  ;//结束日期
		$sGoodsDesc = isset($aData['goods_desc'])?$aData['goods_desc']:''  ;//促销优惠介绍
// 		//TODO 商家Id 要添加
// 		$aParam['goods_name'] = $goods_name;
// 		$aParam['goods_v_type'] = $goods_v_type;
// 		$aParam['t_begin_time'] = $t_begin_time;
// 		$aParam['t_end_time'] = $t_end_time;
// 		$aParam['pri_time_per'] = $pri_time_per;
// 		$aParam['pri_goods_list'] = $pri_goods_list;
// 		$aParam['pri_goods_per'] = $pri_goods_per;
// 		$aParam['vip_per'] = $vip_per;
// 		$aParam['per_type'] = $per_type;
// 		$aParam['varil_begin_time'] = $varil_begin_time;
// 		$aParam['varil_end_time'] = $varil_end_time;
// 		$aParam['goods_desc'] = $good_desc;

		$oPromo = new Promotions();
			
		if ($goods_v_type == 1) {
			$re = $oPromo->addTimePro($iAddId,$iMerchantId,$sGoodsName,$iPerType,
			$iVarilBeginTime,$iVarilEndTime,$sGoodsDesc,$sTBeginTime,$sTEndTime,$iPriTimePer);
			
			BaseFunctions::ouputToString($re);
			return;
		}else if ($goods_v_type == 2) {
			$re = $oPromo->addGreensPro($iAddId,$iMerchantId,$sGoodsName,$iPerType,
			$iVarilBeginTime,$iVarilEndTime,$sGoodsDesc,$aPriGoodsList,$iPriGoodsPer);
			BaseFunctions::ouputToString($re);
			return;
		}else if ($goods_v_type == 3) {
			$re = $oPromo->addVipPro($iAddId,$iMerchantId,$sGoodsName,$iPerType,
			$iVarilBeginTime,$iVarilEndTime,$sGoodsDesc,$iVipPer);
			BaseFunctions::ouputToString($re);
			return;
		}else{
			BaseFunctions::outputResult(false,  array('ER0014','不存在的促销类型!'));
			return;
		}
// 		$re = $oPromo->addPromotions($iAddId,$iMerchantId, $aData);
// 		BaseFunctions::ouputToString($re);
	}
	
	public function actionUpdatePro(){
// 		BaseFunctions::writeLog(json_encode($_REQUEST));
		$aData = json_decode($_REQUEST['d'],true);

		$iUserId = isset($aData['user_id'])?$aData['user_id']:''  ;
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		if (!$iMerchantId) {
			BaseFunctions::outputResult(false, array('ER0013','缺少商家id!'));
			return;
		}
		//修改的优惠卷
		$iPro = isset($aData['iProId'])?$aData['iProId']:''  ;
		if (!$iPro) {
			BaseFunctions::outputResult(false, array('ER0013','缺少菜品id!'));
			return;
		}
		$sGoodsName = isset($aData['goods_name'])?$aData['goods_name']:''  ;//促销名称
		$goods_v_type = isset($aData['goods_v_type'])?$aData['goods_v_type']:''  ;//促销类型
		$sTBeginTime = isset($aData['t_begin_time'])?$aData['t_begin_time']:''  ;//开始日期
		$sTEndTime = isset($aData['t_end_time'])?$aData['t_end_time']:''  ;//结束日期
		$iPriTimePer = isset($aData['pri_time_per'])?$aData['pri_time_per']:'0'  ;//优惠率
		$aPriGoodsList = isset($aData['pri_goods_list'])?$aData['pri_goods_list']:array()  ;//菜品列表
		$iPriGoodsPer = isset($aData['pri_goods_per'])?$aData['pri_goods_per']:''  ;//优惠绿
		$iVipPer = isset($aData['vip_per'])?$aData['vip_per']:''  ;//会员优惠
		$iPerType = isset($aData['per_type'])?$aData['per_type']:''  ;//促销类型
		$iVarilBeginTime = isset($aData['varil_begin_time'])?strtotime($aData['varil_begin_time']):'0'  ;//开始日期
		$iVarilEndTime = isset($aData['varil_end_time'])?strtotime($aData['varil_end_time']):'0'  ;//结束日期
		$sGoodsDesc = isset($aData['goods_desc'])?$aData['goods_desc']:''  ;//促销优惠介绍

		$oPromo = new Promotions();
		if ($goods_v_type==1) {
			$re = $oPromo->updateTimePro($iPro,$iUserId,$iMerchantId,$sGoodsName,$iPerType,
			$iVarilBeginTime,$iVarilEndTime,$sGoodsDesc,$sTBeginTime,$sTEndTime,$iPriTimePer);
			BaseFunctions::ouputToString($re);
			return;
		}else if ($goods_v_type==2) {
			$re = $oPromo->updateGreensPro($iPro,$iUserId,$iMerchantId,$sGoodsName,$iPerType,
			$iVarilBeginTime,$iVarilEndTime,$sGoodsDesc,$aPriGoodsList,$iPriGoodsPer);
			BaseFunctions::ouputToString($re);
			return;
		}else if ($goods_v_type == 3) {
			$re = $oPromo->updateVipPro($iPro,$iUserId,$iMerchantId,$sGoodsName,$iPerType,
			$iVarilBeginTime,$iVarilEndTime,$sGoodsDesc,$iVipPer);
			BaseFunctions::ouputToString($re);
			return;
		}else{
			BaseFunctions::outputResult(false,  array('ER0014','不存在的促销类型!'));
			return;
		}
	}
	
	public function actionGetPromotions(){
		$aData = json_decode($_REQUEST['d'],true);
		$iGoodsId = isset($aData['id'])?$aData['id']:'';
		$o = new Promotions();
		$re = $o->findById($iGoodsId);
		BaseFunctions::ouputToString($re['type'],$re['msg']);
	}
	
	public function actionGetCoupon(){
		$aData = json_decode($_REQUEST['d'],true);
		$iGoodsId = isset($aData['id'])?$aData['id']:'';
		$iAddId = isset($aData['user_id'])?$aData['user_id']:''  ;
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:''  ;
		
		$o = new Coupon();
		$re = $o->getCoupDetail($iMerchantId,$iGoodsId);
		//BaseFunctions::outputResult($re['type'],$re['msg'][0]);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionUpdateCoupon(){
		$oCoupon = new Coupon();
		BaseFunctions::writeLog(json_encode($_REQUEST));
		$aData = json_decode($_REQUEST['d'],true);
		BaseFunctions::writeLog(json_encode($aData));
		$iAddUserId = isset($aData['user_id'])?$aData['user_id']:'';
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$iCouponId =  isset($aData['couponId'])?$aData['couponId']:'';
		BaseFunctions::writeLog("begin");
		//$oCoupon->addCoupon($iAddUserId, $iMerchantId, $aData);
		$oCoupon->updateCoupon($iCouponId,$iAddUserId, $iMerchantId, $aData);
	}
	
	public function actionGetPro(){
		$aData = json_decode($_REQUEST['d'],true);
		$iGoodsId = isset($aData['id'])?$aData['id']:'';
		$iAddId = isset($aData['user_id'])?$aData['user_id']:''  ;
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:''  ;
		
		$o = new Promotions();
		$re = $o->getPromotions($iGoodsId,$iMerchantId);
		BaseFunctions::ouputToString($re);
	}
}

?>