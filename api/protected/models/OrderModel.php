<?php
class OrderModel extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$sTableKey = "order";
		parent::__construct($sTableKey);
	}
	
	public function getTableKey(){
		return $this->sTableKey;
	}
	
	/**
	 * 添加订单
	 * @param unknown $addId
	 * @param unknown $sUserName
	 * @param unknown $sAccountName
	 * @param unknown $iUserId
	 * @param unknown $aMenuArr array(id,name,b_gold原来的金钱,gold金钱,b_v_gold原来的虚拟货币,v_gold虚拟货币)
	 * @param unknown $iMerId
	 * @return Ambigous <Ambigous, multitype:array, multitype:boolean unknown >
	 */
	public function addBookOrder($addId,$sUserName,$sAccountName,$iUserId,$aMenuArr,$iMerId){
		//生成主单 id order_num
// 		BaseFunctions::writeLog("addBookOrder");
		$aMainOrder = $this->addOrder($addId, $sUserName, $sAccountName, $iUserId, "", "0", 
				"0", "0", "0", $iMerId, "", "0");
// 		BaseFunctions::writeLog("this->addOrder".json_encode($aMainOrder));
		$aAddOrder = array();
		if ($aMainOrder['type']) {
			$aAddOrder[] = $aMainOrder['msg']['id'];
			//生成副单
			foreach ($aMenuArr as $oMenu){
				$pro_id=$oMenu['pro_id']?$oMenu['pro_id']:0;
				$croup_id=$oMenu['croup_id']?$oMenu['croup_id']:0;
				$croup_str=$oMenu['croup_str']?$oMenu['croup_str']:'';
				$aChildOrder = $this->addOrder($addId, $sUserName, $sAccountName, 
						$iUserId, $oMenu['id'], $oMenu['b_gold'], $oMenu['gold'], $oMenu['b_v_gold'], 
						$oMenu['v_gold'], $iMerId, $aMainOrder['msg']['id'], $aMainOrder['msg']['order_num']);
				if ($aChildOrder['type']) {
					$aAddOrder[] = $aChildOrder['msg']['id'];
				}else{
					foreach ($aAddOrder as $iHasInId){
						$this->delById($iHasInId);
					}
					return $aChildOrder;
				}
			}
			//统计总价 TODO
			return $aMainOrder;
		}else{
			return $aMainOrder;
		}
		
	}
	
	/**
	 * 添加订单
	 * @param unknown $addId
	 * @param unknown $sUserName
	 * @param unknown $sAccountName
	 * @param unknown $iUserId
	 * @param unknown $addGoodId
	 * @param unknown $fGoodNum
	 * @param unknown $fRealNum
	 * @param unknown $fVirtualGold
	 * @param unknown $fRealVirtualGold
	 * @param unknown $iMerId
	 * @param unknown $parent_id
	 * @param unknown $sParentNum
	 * @return Ambigous <multitype:array, multitype:boolean unknown >
	 */
	public function addOrder($addId,$sUserName,$sAccountName,$iUserId,$addGoodId,$fGoodNum,
			$fRealNum,$fVirtualGold,$fRealVirtualGold,$iMerId,$parent_id,$sParentNum,$pro_id=0,$croup_id=0,$croup_str=''){
		$aParam = array();
		$o =  new UserModel();
		BaseFunctions::writeLog("baseModel");
		$iAddTime = time();
		$sOrNum = $this->getOrderNum($iMerId);
		$aParam['order_num'] = $sOrNum;
		$aParam['b_v_gold'] = $fVirtualGold;
		$aParam['v_gold'] = $fRealVirtualGold;
		$aParam['b_gold'] = $fGoodNum;
		$aParam['order_gold'] = $fRealNum;
		$aParam['user_id'] = $iUserId;
		$aParam['account_name'] = $sAccountName;
		$aParam['user_name'] = $sUserName;
		$aParam['order_time'] = $iAddTime;
// 		$aParam['user_phone'] = ;
		$aParam['parent_order_id'] = $parent_id;
		$aParam['parnt_order_num'] = $sParentNum;
// 		$aParam['plant_come_num'] = ;
		$aParam['merchant_id'] = $iMerId;
		$aParam['status'] = 0;
		$aParam['add_user_id'] = $addId;
		$aParam['add_time'] = $iAddTime;
		$aParam['goods_id'] = $addGoodId;
		$aParam['pro_id'] = $pro_id;
		$aParam['croup_id'] = $croup_id;
		$aParam['croup_str'] = $croup_str;
		$re = $this->add($aParam,true);
		if($re){
			return BaseFunctions::returnResult(true, array('id'=>$re['msg'],'order_num'=>$sOrNum));
		}
		return BaseFunctions::returnResult(false, array("ER0006","添加订单失败"));
	}
	
// 	private function getOrderNum(){
// 		return "OR-".date("Y-m-d")."000001";
// 	}
	
	/**
	 *
	 * OR + 20140506 + 00000000
	 * 前序 + 日期  + 编号
	 * @param unknown $iMerchantId
	 * @return number
	 */
	private function getOrderNum($iMerchantId){
		$sBr = "OR";
		$sT = date("Ymd");
		$sFind = " max(order_num) as min_num ";
		$sWhere = " `order_num` like '{$sBr}{$sT}%' and `merchant_id` = '{$iMerchantId}' ";
		$aRe = $this->find($sFind,$sWhere);
		if($aRe['msg'][0]['min_num']){
			$sFindNum = substr($aRe['msg'][0]['min_num'],10);
			$iFindNum = intval($sFindNum);
			$iFindNum = $iFindNum +1;
			//$newNumber = $this->dispRepair($iFindNum,6,0);//substr(strval($iFindNum+100000),1,5);
			return $this->createOrderOrNum($iFindNum);
		}else{
			return $this->createOrderOrNum(1);
		}
	}
	
	private function createOrderOrNum($iNum){
		$sBr = "OR";
		$sT = date("Ymd");
		return $sBr.$sT.$this->dispRepair($iNum,8,0);
	}
	
	/*
	 方法函数如下，这样当你要的结果001的话，方法：dispRepair('1',3,'0')
	功能：补位函数
	str:原字符串
	type：类型，0为后补，1为前补
	len：新字符串长度
	msg：填补字符
	*/
	function dispRepair($str,$len,$msg,$type='1') {
		$length = $len - strlen($str);
		if($length<1)return $str;
		if ($type == 1) {
			$str = str_repeat($msg,$length).$str;
		} else {
			$str .= str_repeat($msg,$length);
		}
		return $str;
	}
}