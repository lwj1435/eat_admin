<?php
class Promotions extends GoodsModel{
	private $goodsType;
	public function __construct(){
		$this->goodsType = 2;
		parent::__construct();
	}
	
	public function getType(){
		return $this->goodsType;
	}
	
	/**
	 * 添加限时优惠
	 * @param unknown $sGoodsName
	 * @param unknown $iGoodsVType
	 * @param unknown $iTBeginTime
	 * @param unknown $iTEndTime
	 * @param unknown $iPriTimePer
	 * @param unknown $aPriGoodsList
	 */
	public function addTimePro($iAddId,$iMerchantId,$sGoodsName,$iPerType,
			$iVarilBeginTime,$iVarilEndTime,$sGoodsDesc,$sTBeginTime,$sTEndTime,$iPriTimePer){
		$iGoodsVType = 1;
		$iPriGoodsPer='0';
		$iVipPer='0';
		$iGoodsType = $this->getType();
		//判断是否存在相同的
		$sFind = "*";
		// t_begin_time t_end_time varil_begin_time varil_end_time 
		$sWhere = " ((t_begin_time <= '$sTBeginTime' and t_end_time >='$sTBeginTime' ) 
		or (t_begin_time <= '$sTEndTime' and t_end_time>='$sTEndTime' )) and 
		((varil_begin_time <= $iVarilBeginTime and varil_end_time >= $iVarilBeginTime) 
		or (varil_begin_time <= $iVarilEndTime and varil_end_time >= $iVarilEndTime) ) 
		and status <> -1 and goods_v_type = {$iGoodsVType} and goods_type = {$iGoodsType} and merchant_id = {$iMerchantId} ";
		$aExitArr = $this->find($sFind, $sWhere);
		if (isset($aExitArr['msg'][0]['id'])&&$aExitArr['msg'][0]['id']) {
			return BaseFunctions::returnResult(false, array('ER0012','已存在有冲突 的促销活动!'));
		}
		$re = $this->addPro($iAddId,$iMerchantId,$sGoodsName,$iGoodsVType,$iPerType,
			$iVarilBeginTime,$iVarilEndTime,$sGoodsDesc,$sTBeginTime,
			$sTEndTime,$iPriTimePer,$iPriGoodsPer,$iVipPer);
		if ($re['type']) {
			return BaseFunctions::returnResult(true, array());
		}else{
			return BaseFunctions::returnResult(false, array('ER0011','数据添加失败!'));
		}
	}
	
	/**
	 * 更新定时优惠
	 * @param unknown $id
	 * @param unknown $iAddId
	 * @param unknown $iMerchantId
	 * @param unknown $sGoodsName
	 * @param unknown $iPerType
	 * @param unknown $iVarilBeginTime
	 * @param unknown $iVarilEndTime
	 * @param unknown $sGoodsDesc
	 * @param unknown $sTBeginTime
	 * @param unknown $sTEndTime
	 * @param unknown $iPriTimePer
	 * @return Ambigous <multitype:array, multitype:boolean unknown >
	 */
	public function updateTimePro($id,$iAddId,$iMerchantId,$sGoodsName,$iPerType,
			$iVarilBeginTime,$iVarilEndTime,$sGoodsDesc,$sTBeginTime,$sTEndTime,$iPriTimePer){
		$iGoodsVType = 1;
		$iGoodsType = $this->getType();
		
		$sFind = "*";
		$sWhere = " ((t_begin_time <= '$sTBeginTime' and t_end_time >='$sTBeginTime' )
		or (t_begin_time <= '$sTEndTime' and t_end_time>='$sTEndTime' )) and
		((varil_begin_time <= $iVarilBeginTime and varil_end_time >= $iVarilBeginTime)
		or (varil_begin_time <= $iVarilEndTime and varil_end_time >= $iVarilEndTime) )
		and status <> -1 and goods_v_type = {$iGoodsVType} and goods_type = {$iGoodsType} 
		and merchant_id = {$iMerchantId} and id <> $id ";
		$aExitArr = $this->find($sFind, $sWhere);
		if (isset($aExitArr['msg'][0]['id'])&&$aExitArr['msg'][0]['id']) {
			return BaseFunctions::returnResult(false, array('ER0012','已存在有冲突 的促销活动!'));
		}
		
		//修改时间促销
		$aParam = array(
				'goods_name'=>$sGoodsName,
				't_begin_time'=>$sTBeginTime,
				't_end_time'=>$sTEndTime,
				'pri_time_per'=>$iPriTimePer,
				'per_type'=>$iPerType,
				'varil_begin_time'=>$iVarilBeginTime,
				'varil_end_time'=>$iVarilEndTime,
				'goods_desc'=>$sGoodsDesc,
				'status'=>0
		);
		return $this->updateById($id, $aParam);
	}
	
	/**
	 * 
	 * 添加菜品促销
	 * @param unknown $iAddId
	 * @param unknown $iMerchantId
	 * @param unknown $sGoodsName
	 * @param unknown $iPerType
	 * @param unknown $iVarilBeginTime
	 * @param unknown $iVarilEndTime
	 * @param unknown $sGoodsDesc
	 * @param unknown $aPriGoodsList
	 * @param unknown $iPriGoodsPer
	 * @return Ambigous <multitype:array, multitype:boolean unknown >|Ambigous <boolean, unknown>
	 */
	public function addGreensPro($iAddId,$iMerchantId,$sGoodsName,$iPerType,
			$iVarilBeginTime,$iVarilEndTime,$sGoodsDesc,$aPriGoodsList,$iPriGoodsPer){
		$iGoodsVType = 2;
		$sTBeginTime='';
		$sTEndTime='';
		$iPriTimePer = '0';
		$iVipPer='0';
		$iGoodsType = $this->getType();
		//判断是否有重复的菜品优惠
		$sFind = "*";
		$sWhere = " ((varil_begin_time <= $iVarilBeginTime and varil_end_time >= $iVarilBeginTime)
		or (varil_begin_time <= $iVarilEndTime and varil_end_time >= $iVarilEndTime) )
		and status <> -1 and goods_v_type = {$iGoodsVType} and goods_type = {$iGoodsType}
		and merchant_id = {$iMerchantId}  ";
		$aExitArr = $this->find($sFind, $sWhere);
		if (isset($aExitArr['msg'][0]['id'])) {
			$o = new ProGoodsModel();
			foreach ($aExitArr['msg'] as $aExitPro){
// 				return BaseFunctions::returnResult(false, array('ER0012',$aExitPro['id']));
				if ($aExitPro['id']) {
					foreach ($aPriGoodsList as $iGoodsId){
						if ($iGoodsId) {
							if($o->isExit($iGoodsId, $aExitPro['id'])){
								return BaseFunctions::returnResult(false, array('ER0012','存在有冲突的菜品促销活动!'));
							}
						}
					}
				}
			}
		}
		
		$re = $this->addPro($iAddId,$iMerchantId,$sGoodsName,$iGoodsVType,$iPerType,
				$iVarilBeginTime,$iVarilEndTime,$sGoodsDesc,$sTBeginTime,
				$sTEndTime,$iPriTimePer,$iPriGoodsPer,$iVipPer
		);
		if ($re['type']) {
			//添加相关菜品
			$o = new ProGoodsModel();
			foreach ($aPriGoodsList as $iGoodsId){
				if ($iGoodsId) {
					$o->addProGoods($iGoodsId, $re['msg']);
				}
			}
			return $re;
		}else{
			return BaseFunctions::returnResult(false, array('ER0011','数据添加失败!'));
		}
	}
	
	/**
	 * 更新菜品优惠
	 * @param unknown $id
	 * @param unknown $iAddId
	 * @param unknown $iMerchantId
	 * @param unknown $sGoodsName
	 * @param unknown $iPerType
	 * @param unknown $iVarilBeginTime
	 * @param unknown $iVarilEndTime
	 * @param unknown $sGoodsDesc
	 * @param unknown $aPriGoodsList
	 * @param unknown $iPriGoodsPer
	 */
	public function updateGreensPro($id,$iAddId,$iMerchantId,$sGoodsName,$iPerType,
			$iVarilBeginTime,$iVarilEndTime,$sGoodsDesc,$aPriGoodsList,$iPriGoodsPer){
		$iGoodsVType = 2;
		$sTBeginTime='';
		$sTEndTime='';
		$iPriTimePer = '0';
		$iVipPer='0';
		$iGoodsType = $this->getType();
		//判断是否有重复的菜品优惠
		$sFind = "*";
		$sWhere = " ((varil_begin_time <= $iVarilBeginTime and varil_end_time >= $iVarilBeginTime)
		or (varil_begin_time <= $iVarilEndTime and varil_end_time >= $iVarilEndTime) )
		and status <> -1 and goods_v_type = {$iGoodsVType} and goods_type = {$iGoodsType}
		and merchant_id = {$iMerchantId}  and id <> $id  ";
		$aExitArr = $this->find($sFind, $sWhere);
		if (isset($aExitArr['msg'][0]['id'])) {
			$o = new ProGoodsModel();
			foreach ($aExitArr['msg'] as $aExitPro){
			// 				return BaseFunctions::returnResult(false, array('ER0012',$aExitPro['id']));
				if ($aExitPro['id']) {
					foreach ($aPriGoodsList as $iGoodsId){
						if ($iGoodsId) {
							if($o->isExit($iGoodsId, $aExitPro['id'])){
								return BaseFunctions::returnResult(false, array('ER0012','存在有冲突的菜品促销活动!'));
							}
						}
					}
				}
			}
		}

		//修改时间促销
		$aParam = array(
				'goods_name'=>$sGoodsName,
				'pri_goods_per'=>$iPriGoodsPer,
				'per_type'=>$iPerType,
				'varil_begin_time'=>$iVarilBeginTime,
				'varil_end_time'=>$iVarilEndTime,
				'goods_desc'=>$sGoodsDesc,
				'status'=>0
		);
		$re = $this->updateById($id, $aParam);
		//修改关系
		if ($re['type']) {
			$o = new ProGoodsModel();
			$aOldGoodsRel = $o->getProRelationGoods($id);
			$aOldDetextArr = array();
			foreach ($aOldGoodsRel as $iK => $iV){
				$aOldDetextArr[$iV] = $iV;
			}
			//添加相关菜品
			foreach ($aPriGoodsList as $iGoodsId){
				if ($iGoodsId) {
					if($o->isExit($iGoodsId,$id)){
						//return BaseFunctions::returnResult(false, array('ER0012','存在有冲突的菜品促销活动!'));
					}else{
						$o->addProGoods($iGoodsId, $id);
					}
					if (isset($aOldDetextArr[$iGoodsId])){
						unset($aOldDetextArr[$iGoodsId]);
					}
				}
			}
			foreach ($aOldDetextArr as $iVal){
				if ($iVal) {
					$o->delProGoodsRelation($iVal, $id);
				}
			}
			return $re;
		}else{
			return BaseFunctions::returnResult(false, array('ER0011','数据修改失败!'));
		}
	}
	/**
	 * 
	 * 添加菜品促销
	 * @param unknown $iAddId
	 * @param unknown $iMerchantId
	 * @param unknown $sGoodsName
	 * @param unknown $iPerType
	 * @param unknown $iVarilBeginTime
	 * @param unknown $iVarilEndTime
	 * @param unknown $sGoodsDesc
	 * @param unknown $iVipPer
	 * @return Ambigous <multitype:array, multitype:boolean unknown >|Ambigous <boolean, unknown>
	 */
	public function addVipPro($iAddId,$iMerchantId,$sGoodsName,$iPerType,
			$iVarilBeginTime,$iVarilEndTime,$sGoodsDesc,$iVipPer){
		$iGoodsVType = 3;
		$iTBeginTime = '';
		$iTEndTime = '';
		$iPriTimePer = '0';
		$iPriGoodsPer = '0';
		$iGoodsType = $this->getType();
		//判断是否有重复的菜品优惠
		$sFind = "*";
		$sWhere = " ((varil_begin_time <= $iVarilBeginTime and varil_end_time >= $iVarilBeginTime)
		or (varil_begin_time <= $iVarilEndTime and varil_end_time >= $iVarilEndTime) )
		and status <> -1 and goods_v_type = {$iGoodsVType} and goods_type = {$iGoodsType}
		and merchant_id = {$iMerchantId}  ";
		$aExitArr = $this->find($sFind, $sWhere);
		if (isset($aExitArr['msg'][0]['id'])&&$aExitArr['msg'][0]['id']) {
			return BaseFunctions::returnResult(false, array('ER0012','已存在有冲突的vip促销活动!'));
		}
		
		return $this->addPro($iAddId,$iMerchantId,$sGoodsName,$iGoodsVType,$iPerType,
				$iVarilBeginTime,$iVarilEndTime,$sGoodsDesc,$iTBeginTime,
				$iTEndTime,$iPriTimePer,$iPriGoodsPer,$iVipPer
		);
	}
	
	/**
	 * 
	 * @param unknown $id
	 * @param unknown $iAddId
	 * @param unknown $iMerchantId
	 * @param unknown $sGoodsName
	 * @param unknown $iPerType
	 * @param unknown $iVarilBeginTime
	 * @param unknown $iVarilEndTime
	 * @param unknown $sGoodsDesc
	 * @param unknown $iVipPer
	 * @return Ambigous <multitype:array, multitype:boolean unknown >|Ambigous <boolean, unknown>
	 */
	public function updateVipPro($id,$iAddId,$iMerchantId,$sGoodsName,$iPerType,
			$iVarilBeginTime,$iVarilEndTime,$sGoodsDesc,$iVipPer){
		$iGoodsVType = 3;
		$iTBeginTime = '';
		$iTEndTime = '';
		$iPriTimePer = '0';
		$iPriGoodsPer = '0';
		$iGoodsType = $this->getType();
		//判断是否有重复的菜品优惠
		$sFind = "*";
		$sWhere = " ((varil_begin_time <= $iVarilBeginTime and varil_end_time >= $iVarilBeginTime)
		or (varil_begin_time <= $iVarilEndTime and varil_end_time >= $iVarilEndTime) )
		and status <> -1 and goods_v_type = {$iGoodsVType} and goods_type = {$iGoodsType}
		and merchant_id = {$iMerchantId} and id <> {$id} ";
		$aExitArr = $this->find($sFind, $sWhere);
		if (isset($aExitArr['msg'][0]['id'])&&$aExitArr['msg'][0]['id']) {
			return BaseFunctions::returnResult(false, array('ER0012','已存在有冲突的vip促销活动!'));
		}
		//修改vip促销
		$aParam = array(
				'goods_name'=>$sGoodsName,
				'vip_per'=>$iVipPer,
				'per_type'=>$iPerType,
				'varil_begin_time'=>$iVarilBeginTime,
				'varil_end_time'=>$iVarilEndTime,
				'goods_desc'=>$sGoodsDesc,
				'status'=>0
		);
		$re = $this->updateById($id, $aParam);
		if ($re['type']) {
			return $re;
		}
		return BaseFunctions::returnResult(false, array('ER0011','数据修改失败!'));
	}
	
	/**
	 * 
	 * 添加促销
	 * @param unknown $iAddId
	 * @param unknown $iMerchantId
	 * @param unknown $sGoodsName
	 * @param unknown $iGoodsVType
	 * @param unknown $iPerType
	 * @param unknown $iVarilBeginTime
	 * @param unknown $iVarilEndTime
	 * @param unknown $sGoodsDesc
	 * @param string $iTBeginTime
	 * @param string $iTEndTime
	 * @param string $iPriTimePer
	 * @param string $iPriGoodsPer
	 * @param string $iVipPer
	 */
	public function addPro($iAddId,$iMerchantId,$sGoodsName,$iGoodsVType,$iPerType,
			$iVarilBeginTime,$iVarilEndTime,$sGoodsDesc,$iTBeginTime='',
			$iTEndTime='',$iPriTimePer='0',$iPriGoodsPer='0',$iVipPer='0'
			){
		$aP= array();
		$aP['goods_name'] = $sGoodsName;
		$aP['goods_v_type'] = $iGoodsVType;
		$aP['t_begin_time'] = $iTBeginTime;
		$aP['t_end_time'] = $iTEndTime;
		$aP['pri_time_per'] = $iPriTimePer;
// 		$aP['pri_goods_list'] = isset($aParam['pri_goods_list'])?$aParam['pri_goods_list']:'';//waite
		$aP['pri_goods_per'] = $iPriGoodsPer;
		$aP['vip_per'] = $iVipPer;
		$aP['per_type'] = $iPerType;//长期，或 短期优惠
		$aP['varil_begin_time'] = $iVarilBeginTime;//开始时间
		$aP['varil_end_time'] = $iVarilEndTime;//结束时间
		$aP['goods_desc'] = $sGoodsDesc;
		$aP['goods_type'] = $this->getType();
		$aP['add_time'] = time();
		$aP['add_user_id'] = $iAddId;
		$aP['merchant_id'] = $iMerchantId;
		$re = $this->add($aP,true);
		return $re;
	}
	
	/**
	 * 
	 *  添加促销优惠
	 * @param unknown $iAddId
	 * @param unknown $iMerchantId
	 * @param unknown $aParam
	 * @return Ambigous <boolean, unknown>
	 */
	public function addPromotions($iAddId,$iMerchantId,$aParam){
		//aParamAdd = array();
		$aP['goods_name'] = isset($aParam['goods_name'])?$aParam['goods_name']:'';
		$aP['goods_v_type'] = isset($aParam['goods_v_type'])?$aParam['goods_v_type']:'';
		$aP['t_begin_time'] = isset($aParam['t_begin_time'])?$aParam['t_begin_time']:'';
		$aP['t_end_time'] = isset($aParam['t_end_time'])?$aParam['t_end_time']:'';
		$aP['pri_time_per'] = isset($aParam['pri_time_per'])?$aParam['pri_time_per']:'';
		$aP['pri_goods_list'] = isset($aParam['pri_goods_list'])?$aParam['pri_goods_list']:'';//waite
		$aP['pri_goods_per'] = isset($aParam['pri_goods_per'])?$aParam['pri_goods_per']:'';
		$aP['vip_per'] = isset($aParam['vip_per'])?$aParam['vip_per']:'';
		$aP['per_type'] = isset($aParam['per_type'])?$aParam['per_type']:'';//长期，或 短期优惠
		$aP['varil_begin_time'] = isset($aParam['varil_begin_time'])?strtotime($aParam['varil_begin_time']):'';//开始时间
		$aP['varil_end_time'] = isset($aParam['varil_end_time'])?strtotime($aParam['varil_end_time']):'';//结束时间
		$aP['goods_desc'] = isset($aParam['goods_desc'])?$aParam['goods_desc']:'';
		$aP['goods_type'] = $this->getType();
		$aP['add_time'] = time();
		$aP['add_user_id'] = $iAddId;
		$aP['merchant_id'] = $iMerchantId;
		$re = $this->add($aP,true);
		$iAddId = $re['msg'];
		$ap['pri_goods_list_array_temp'] =  isset($aParam['pri_goods_list_array_temp'])?$aParam['pri_goods_list_array_temp']:array();
		//添加餐牌和优惠卷之间的关系
		//pri_goods_list_array_temp
		$o = new GoodsModel();
		foreach ($ap['pri_goods_list_array_temp'] as $iGoodsKey){
			$o->addFavorable($iGoodsKey, $iAddId, $iAddId, $iMerchantId,2);
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
		return $re;
	}
	
	/**
	 * 修改促销优惠
	 * @param unknown $iProId
	 * @param unknown $aParam
	 */
	public function updatePromotions($iProId,$aParam){
		$this->updateById($iProId, $aParam);
	}
	
	public function updatePro($iProId,$iAddId,$iMerchantId, $aParam){
		$aP = array();
		$aP['goods_name'] = isset($aParam['goods_name'])?$aParam['goods_name']:'';
		$aP['goods_v_type'] = isset($aParam['goods_v_type'])?$aParam['goods_v_type']:'';
		$aP['t_begin_time'] = isset($aParam['t_begin_time'])?$aParam['t_begin_time']:'';
		$aP['t_end_time'] = isset($aParam['t_end_time'])?$aParam['t_end_time']:'';
		$aP['pri_time_per'] = isset($aParam['pri_time_per'])?$aParam['pri_time_per']:'';
		$aP['pri_goods_list'] = isset($aParam['pri_goods_list'])?$aParam['pri_goods_list']:'';
		$aP['pri_goods_per'] = isset($aParam['pri_goods_per'])?$aParam['pri_goods_per']:'';
		$aP['vip_per'] = isset($aParam['vip_per'])?$aParam['vip_per']:'';
		$aP['per_type'] = isset($aParam['per_type'])?$aParam['per_type']:'';
		$aP['varil_begin_time'] = isset($aParam['varil_begin_time'])?strtotime($aParam['varil_begin_time']):'';
		$aP['varil_end_time'] = isset($aParam['varil_end_time'])?strtotime($aParam['varil_end_time']):'';
		$aP['goods_desc'] = isset($aParam['goods_desc'])?$aParam['goods_desc']:'';
		return $this->updateById($iProId, $aP);
	}
	
	/**
	 * 获取限时优惠的优惠卷
	 * @param unknown $iMerId
	 */
	public function getProList($iMerId){
		$iGoodsType = $this->getType();
		return $this->getList($iGoodsType,$iMerId);
	}
	
	/**
	 *
	 * 计算促销队菜品的价格的影响
	 * @param unknown $aGood  array $aGood array(id,gold,good_no,goods_v_type)
	 * @param unknown $aProList
	 * @param string $isVip
	 * @return array(id,gold新价格,good_no,goods_v_type,o_gold原来价格 )
	 */
	public function computerPice($aGood,$aProList,$date="",$time="",$isVip=false){
		$iOGold = $aGood['gold']?$aGood['gold']:0;
		$addRe = array('o_gold'=>$iOGold);
		//判断是否符合时间要求
		$iTime = strtotime($date." ".$time);
		if ($aProList['varil_begin_time']>$iTime||$aProList['varil_end_time']<$time) {
			return $aGood;
		}
		//限时优惠
		if ($aProList['goods_v_type'] == 1) {
			$iPer = $aProList['pri_time_per']?$aProList['pri_time_per']:0;
			$iNewGold = $iOGold*$iPer/100;
			$addRe['gold'] = $iNewGold;
			return $addRe+$aGood;
		}
		//菜品优惠
		if ($aProList['goods_v_type'] == 2) {
			$pos = strpos($aProList['pri_goods_list'], $aGood['id']);
			if ($pos === false) {
				return $aGood;
			} else {
				$iPer = $aProList['pri_goods_per']?$aProList['pri_goods_per']:0;
				$iNewGold = $iOGold*$iPer/100;
				$addRe['gold'] = $iNewGold;
				return $addRe+$aGood;
			}
		}
		//vip
		if (!$isVip) {
			return $aGood;
		}
		if ($aProList['goods_v_type'] == 3) {
			//vip_per
			$iPer = $aProList['vip_per']?$aProList['vip_per']:0;
			$iNewGold = $iOGold*$iPer/100;
			$addRe['gold'] = $iNewGold;
			return $addRe+$aGood;
		}
		//折扣卷
		return $aGood;
	}
	
	/**
	 *
	 */
	public function getNewPro($iMerId){
		$re = $this->foundNew(1,$iMerId,1);
		return BaseFunctions::returnResult(true, $re);
	}
	
	/**
	 * 获取促销优惠信息
	 * @param unknown $iGoodsId
	 */
	public function getPromotions($iGoodsId,$iMerchantId=0){
		$re = $this->findById($iGoodsId,true);
		if (!$re['type']||!isset($re['msg'][0]['id'])) {
			return BaseFunctions::returnResult(false, array());
		}
		$aData = $re['msg'][0];
		if($iMerchantId&&$aData['merchant_id']!=$iMerchantId){
			return BaseFunctions::returnResult(false, array());
		}
		if ($aData['goods_type']!=$this->getType()) {
			return BaseFunctions::returnResult(false, array());
		}
		if ($aData['goods_v_type']==2) {
			$o = new ProGoodsModel();
			$aData['pri_goods_list'] = $o->getProRelationGoods($aData['id']);
		}
		return BaseFunctions::returnResult(true, $aData);
	}
	
}
?>