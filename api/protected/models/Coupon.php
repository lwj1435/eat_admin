<?php

/**
 *
 * @author jen
 * Coupon model
 */
class Coupon extends GoodsModel{
	private $goodsType;
	public function __construct(){
		$this->goodsType = 3;
		parent::__construct();
	}
	
	/**
	 * 添加优惠卷
	 * @param unknown $iAddUserId
	 * @param unknown $iMerchantId
	 * @param unknown $aParam
	 */
	public function addCoupon($iAddUserId,$iMerchantId,$aParam){
		$aP = array();
		$aP['goods_name'] = isset($aParam['goods_name'])?$aParam['goods_name']:'';
		$aP['goods_v_type'] = isset($aParam['goods_v_type'])?$aParam['goods_v_type']:'';
		$aP['pri_money'] = isset($aParam['pri_money'])?$aParam['pri_money']:'';
		$aP['pri_goods_per'] = isset($aParam['pri_goods_per'])?$aParam['pri_goods_per']:'';
		$aP['pri_goods_list'] = isset($aParam['pri_goods_list'])?$aParam['pri_goods_list']:'';
		$aP['good_num'] = isset($aParam['good_num'])?$aParam['good_num']:'';
		$aP['per_type'] = isset($aParam['per_type'])?$aParam['per_type']:'';
		$aP['varil_begin_time'] = isset($aParam['varil_begin_time'])?strtotime($aParam['varil_begin_time']):'';
		$aP['varil_end_time'] = isset($aParam['varil_end_time'])?strtotime($aParam['varil_end_time']):'';
		$aP['goods_desc']= isset($aParam['varil_end_time'])?$aParam['goods_desc']:'';
		$aP['merchant_id'] = $iMerchantId; 
		$aP['add_user'] = $iAddUserId;
		$aP['goods_type'] = $this->goodsType;
		$re = $this->add($aP,true); 
		$iAddId = $re['msg'];
		
		//添加菜品和菜单的优惠
		if ($aP['goods_v_type']==3) {
			$o = new CouponGoodsModel();
			foreach ($aParam['pri_goods_list_array_temp'] as $iGoodsId){
				if ($iGoodsId) {
					$o->addCouponGoods($iGoodsId, $iAddId);
				}
			}
		}
		
		//添加具体优惠卷
		$o = new GoodsDetailModel();
		if ($aP['good_num']>0) {
			for ($i=0;$i<$aP['good_num'];$i++){
				$o->addGoodsDetail(array(
					'parent_id' => $iAddId,
					'status' => 0,
					'goods_name' => $aP['goods_name'],
					'type' => $aP['goods_type'],
					'merchant_id' => $iMerchantId
				));
			}
		}
		/*
		 * 	$aParam['goods_at_num'] = $this->getGoodsNum();
		$aParam['parent_id'] = $aData['parent_id']?$aData['parent_id']:'';
		$aParam['user_id'] = $aData['user_id']?$aData['user_id']:'';
		$aParam['user_name'] = $aData['user_name']?$aData['user_name']:'';
		$aParam['customer_id'] = $aData['customer_id']?$aData['customer_id']:'';
		$aParam['get_time'] = $aData['get_time']?$aData['get_time']:'';
		$aParam['status'] = $aData['status']?$aData['status']:'';
		$aParam['user_time'] = $aData['user_time']?$aData['user_time']:'';
		$aParam['goods_name'] = $aData['goods_name']?$aData['goods_name']:'';
		$aParam['type'] = $aData['type']?$aData['type']:'';
		$aParam['merchant_id'] = $aData['merchant_id']?$aData['merchant_id']:'';
		 */
		$ap['pri_goods_list_array_temp']  = isset($aParam['pri_goods_list_array_temp'])?$aParam['pri_goods_list_array_temp']:array();
		//天价物品的关联                        
		$o = new GoodsModel();
		foreach ($ap['pri_goods_list_array_temp'] as $iGoodsKey){
			$o->addFavorable($iGoodsKey, $iAddId, $iAddId, $iMerchantId,1);
		}      
	}
	
	/**
	 * 
	 * @param unknown $iCouponId
	 * @param unknown $iAddUserId
	 * @param unknown $iMerchantId
	 * @param unknown $aData
	 */
	public function updateCoupon($iCouponId,$iAddUserId, $iMerchantId, $aParam){
		//TODO 判断是否有权限
		$aP = array();
		$aP['goods_name'] = isset($aParam['goods_name'])?$aParam['goods_name']:'';
		$aP['goods_v_type'] = isset($aParam['goods_v_type'])?$aParam['goods_v_type']:'';
		$aP['pri_money'] = isset($aParam['pri_money'])?$aParam['pri_money']:'';
		$aP['pri_goods_per'] = isset($aParam['pri_goods_per'])?$aParam['pri_goods_per']:'';
		$aP['pri_goods_per'] = isset($aParam['pri_goods_per'])?$aParam['pri_goods_per']:'';
		$aP['good_num'] = isset($aParam['good_num'])?$aParam['good_num']:'';
		$aP['per_type'] = isset($aParam['per_type'])?$aParam['per_type']:'';
		$aP['varil_begin_time'] = isset($aParam['varil_begin_time'])?strtotime($aParam['varil_begin_time']):'';
		$aP['varil_end_time'] = isset($aParam['varil_end_time'])?strtotime($aParam['varil_end_time']):'';
		$aP['goods_desc']= isset($aParam['varil_end_time'])?$aParam['goods_desc']:'';
		$aP['add_user'] = $iAddUserId;
		$aP['goods_type'] = $this->goodsType;
		
		return $this->updateById($iCouponId, $aP,true);
	}
	
	/**
	 * 
	 * 获取优惠卷,
	 * @param unknown $iUserId
	 * @param number $iType 
	 * 				'-1'=>"已删除",
	 * 				'0'=>'待发放',
	 *				'1'=>'发放中',
	 *				'2'=>'已领取',
	 *				'3'=>'已使用',
	 *				'4'=>'使用中',
	 * @param array $aDishesList
	 * @param number $iReturnType 1 array(id=>,name=>,no=>)
	 */
	public function findAllCounpWithUserId($iUserId,$iMerchantId,$aDishesList,$iType=2,$iReturnType=1){
		//TODO 修改状态为 1 
		$where = " t.user_id = {$iUserId} and t.status = {$iType} and coupon.status = 2  ";
		$where .= $iMerchantId?" and coupon.merchant_id =  {$iMerchantId} ":"";
		$sStr = "";
		foreach ($aDishesList as $iDishes){
			$sStr .= $iDishes>0?($sStr?" or coupon.pri_goods_list like '%,{$iDishes},%' ":" ( coupon.pri_goods_list like '%,{$iDishes},%' "):"";
		}
		$sStr .= ")";
		$where .= $sStr==")"?"":" and ".$sStr;
		$aJoinTable = array("coupon");
		$select  = " * ";
		$oRe = $this->yiiPageWithJoin("GoodsDetailList",$aJoinTable,$select, $where, 1, 1000);
		if($iReturnType==1){
			
		}
		return $oRe;
	}
	
	/**
	 * 获取商家对应的优惠卷
	 * @param unknown $iMerId
	 */
	public function getCoupList($iMerId){
		$iGoodsType = $this->getType();
		return $this->getList($iGoodsType,$iMerId);
	}
	
	/**
	 * 
	 * @param unknown $aGood
	 * @param unknown $aCoupList
	 * @param string $date
	 * @param string $time
	 */
	public function computerPice($aGood,$aCoupList,$date="",$time=""){
		$iOGold = $aGood['gold']?$aGood['gold']:0;
		$addRe = array('o_gold'=>$iOGold);
		$iTime = strtotime($date." ".$time);
		if ($aProList['varil_begin_time']>$iTime||$aProList['varil_end_time']<$time) {
			return $aGood;
		}
		if ($aCoupList['goods_v_type']==1) {
			$iPerMoney = $aCoupList['pri_money']?$aCoupList['pri_money']:0;
			$iNewGold = $iOGold - $iPerMoney;
			$iNewGold = $iNewGold<0?0:$iNewGold;
			$addRe['gold'] = $iNewGold;
			return $aGood+$addRe;
		}
		if ($aCoupList['goods_v_type']==2) {
			$iPer = $aCoupList['pri_goods_per']?$aCoupList['pri_goods_per']:0;
			$iNewGold = $iOGold*$iPer/100;
			$addRe['gold'] = $iNewGold;
			return $aGood+$addRe;
		}
		if ($aCoupList['goods_v_type']==3) {
			$pos = strpos($aCoupList['pri_goods_list'], $aGood['id']);
			if ($pos === false) {
				return $aGood;
			} else {
				$addRe['gold'] = 0;
				return $aGood+$addRe;
			}
		}
		return $aGood;
	}
	
	/**
	 * 
	 */
	public function getNewCoup($iMerId){
		$re = $this->foundNew(2,$iMerId,1);
		return BaseFunctions::returnResult(true, $re);
	}
	
	public function getCoupDetail($iMerId,$iGoodsId){
		$re = $this->findById($iGoodsId,true);
		if($re['type']){
			$aData = $re['msg'][0];
			$o = new CouponGoodsModel();
			if ($aData['goods_v_type']==3) {
				$aData['pri_goods_list'] = $o->getCoupRelationGoods($aData['id']); 
			}
			return BaseFunctions::returnResult(true, $aData);
		}else{
			return BaseFunctions::returnResult(false, array());
		}
		
	}
}
?>