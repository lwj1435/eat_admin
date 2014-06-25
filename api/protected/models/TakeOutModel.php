<?php
class TakeOutModel extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$this->sTableKey = "take_out";
		parent::__construct($this->sTableKey);
	}

	public function getTableKey(){
		return $this->sTableKey;
	}
	
	/**
	 * 
	 * @param unknown $user_id
	 * @param unknown $account_name
	 * @param unknown $user_name
	 * @param unknown $user_phone
	 * @param unknown $order_num
	 * @param unknown $price_count
	 * @param unknown $take_num_count
	 * @param unknown $take_outcol
	 * @param unknown $take_time
	 * @param unknown $pro_time
	 * @param unknown $out_time
	 * @param unknown $get_time
	 * @param unknown $merchant_id
	 * @param unknown $status
	 * @param unknown $add_time
	 * @param unknown $take_out_name
	 * @param unknown $take_out_type
	 * @param unknown $favorable_id
	 * @param unknown $pay_type
	 * @param unknown $pay_status
	 * @param unknown $add
	 * @param unknown $take_out_status
	 * @param unknown $super_need
	 * @param unknown $take_num
	 * @param unknown $take_out_date
	 * @param unknown $take_out_time
	 * @param unknown $customer_id
	 * @param unknown $take_out_phone
	 * @return Ambigous <boolean, unknown>
	 */
	public function addTakeOut($user_id,$account_name,$user_name,$user_phone,$order_num,$price_count,
			$take_num_count,$take_outcol,$take_time,$pro_time,$out_time,$get_time,$merchant_id,$status,$add_time,
			$take_out_name,$take_out_type,$favorable_id,$pay_type,$pay_status,$add,$take_out_status,$super_need,$take_num,
			$take_out_date,$take_out_time,$customer_id,$take_out_phone,$order_id){
		$aParam = array();
		$aParam["take_out_num"]=$this->getOrderNum($merchant_id);
		$aParam["user_id"]=$user_id;
		$aParam["account_name"]=$account_name;
		$aParam["user_name"]=$user_name;
		$aParam["user_phone"]=$user_phone;
		$aParam["order_num"]=$order_num;
		$aParam["price_count"]=$price_count;
		$aParam["take_num_count"]=$take_num_count;
		$aParam["take_outcol"]=$take_outcol;
		$aParam["take_time"]=$take_time;
		$aParam["pro_time"]=$pro_time;
		$aParam["out_time"]=$out_time;
		$aParam["get_time"]=$get_time;
		$aParam["merchant_id"]=$merchant_id;
		$aParam["status"]=$status;
		$aParam["add_time"]=$add_time;
		$aParam["take_out_name"]=$take_out_name;
		$aParam["take_out_type"]=$take_out_type;
		$aParam["favorable_id"]=$favorable_id;
		$aParam["pay_type"]=$pay_type;
		$aParam["pay_status"]=$pay_status;
		$aParam["add"]=$add;
		$aParam["take_out_status"]=$take_out_status;
		$aParam["super_need"]=$super_need;
		$aParam["take_num"]=$take_num;
		$aParam["take_out_date"]=$take_out_date;
		$aParam["take_out_time"]=$take_out_time;
		$aParam["customer_id"]=$customer_id;
		$aParam["take_out_phone"]=$take_out_phone;
		$aParam['order_id'] = $order_id;
		return $this->add($aParam,true);
	}

	public function updateTakeOut($id,$take_out_num,$user_id,$account_name,$user_name,$user_phone,$order_num,$price_count,$take_num_count,$take_outcol,$take_time,$pro_time,$out_time,$get_time,$merchant_id,$status,$add_time,$take_out_name,$take_out_type,$favorable_id,$pay_type,$pay_status,$add,$take_out_status,$super_need,$take_num,$take_out_date,$take_out_time,$customer_id,$take_out_phone){
		$aParam = array();
		$aParam["id"]=$id;
		$aParam["take_out_num"]=$take_out_num;
		$aParam["user_id"]=$user_id;
		$aParam["account_name"]=$account_name;
		$aParam["user_name"]=$user_name;
		$aParam["user_phone"]=$user_phone;
		$aParam["order_num"]=$order_num;
		$aParam["price_count"]=$price_count;
		$aParam["take_num_count"]=$take_num_count;
		$aParam["take_outcol"]=$take_outcol;
		$aParam["take_time"]=$take_time;
		$aParam["pro_time"]=$pro_time;
		$aParam["out_time"]=$out_time;
		$aParam["get_time"]=$get_time;
		$aParam["merchant_id"]=$merchant_id;
		$aParam["status"]=$status;
		$aParam["add_time"]=$add_time;
		$aParam["take_out_name"]=$take_out_name;
		$aParam["take_out_type"]=$take_out_type;
		$aParam["favorable_id"]=$favorable_id;
		$aParam["pay_type"]=$pay_type;
		$aParam["pay_status"]=$pay_status;
		$aParam["add"]=$add;
		$aParam["take_out_status"]=$take_out_status;
		$aParam["super_need"]=$super_need;
		$aParam["take_num"]=$take_num;
		$aParam["take_out_date"]=$take_out_date;
		$aParam["take_out_time"]=$take_out_time;
		$aParam["customer_id"]=$customer_id;
		$aParam["take_out_phone"]=$take_out_phone;
		return $this->updateById($id,$aParam,true);
	}

	/**
	 * 获取统计
	 * @param unknown $iBTime 开始时间
	 * @param unknown $iETime 结束时间
	 * @param unknown $iMerchantId
	 */
	public function getTotal($iBTime,$iETime,$iMerchantId){
		$sFind = " count(1) as num , `status` ";
		$sWhere = " `merchant_id` = '{$iMerchantId}' and `add_time` > {$iBTime} and `add_time` < {$iETime} group by `status` ";
		$aArr = $this->find($sFind, $sWhere);
		return $aArr;
	}
	
	/**
	 * 添加外卖订单
	 * @param unknown $iAddUser
	 * @param unknown $aParam
	 */
	public function addPutOut($iAddUser,$aParam){
		$aParam['add_user'] = $iAddUser;
		return $this->add($aParam);
	}
	
	/**
	 * 改变状态
	 */
	public function changeStatus($iUserId,$iOrderId,$iToStatus,$iMerchantId,$iFromStatus=-100){
		if ($iFromStatus>-100) {
			//TODO判断是否 符合条件 商家已经
		}
		if ($iToStatus == 1) {
			$aParam = array(
					'status' => $iToStatus,
					'take_time'=>time()
			);
		}else if ($iToStatus == 2) {
			$aParam = array(
					'status' => $iToStatus,
					'out_time'=>time()
			);
		}else if ($iToStatus == 3) {
			$aParam = array(
					'status' => $iToStatus,
					'get_time'=>time()
			);
		}else if ($iToStatus == 4) {
			$aParam = array(
					'status' => $iToStatus
			);
		}else{
			return BaseFunctions::returnResult(false, "没该状态");
		}
		$aBookArr = $this->findById($iOrderId);
		$this->sendNoticeMsg($iToStatus,$aBookArr['msg'][0]['take_out_phone'],
				$aBookArr['msg'][0]['take_out_name'],$aBookArr['msg'][0]['take_out_num'],
				$iMerchantId,$iUserId,$aBookArr['msg'][0]['user_id'],$aBookArr['msg'][0]['customer_id']);
		
		return $this->updateById($iOrderId, $aParam,true);
	}
	
	/**
	 * 
	 * 添加外卖订单
	 * @param unknown $iAddUserId
	 * @param unknown $iMerId
	 * @param unknown $sAdd
	 * @param unknown $bookDate
	 * @param unknown $bookTime
	 * @param unknown $bookSeatType
	 * @param unknown $bookName
	 * @param unknown $bookPhone
	 * @param unknown $bookDesc
	 * @param unknown $bookMenArr
	 * @param unknown $aCoupon
	 * @return Ambigous <multitype:array, multitype:boolean unknown >|unknown
	 */
	public function addTakeOutCli($iAddUserId,$iMerId,$sAdd,$bookDate,$bookTime,$bookSeatType,$bookName,$bookPhone,$bookDesc,$bookMenArr,$aCoupon){
		//用户是否合法
		$oUser = new UserModel();
		$aUserMsg = $oUser->detection($iAddUserId);
		if (!$aUserMsg) {
			return BaseFunctions::returnResult(false, "ER0001");
		}
		// 		//促销计算
		// 		$oPro = new Promotions();
		// 		$aProList = $oPro->getProList($iMerId);
		// 		//优惠卷判断
		// 		$oCoup = new Coupon();
		// 		$aCoupList = $oCoup->getCoupList($iMerId);
		$oPro = new Promotions();
		$aProList = $oPro->getProList($iMerId);
		$sCoupStr = $aCoupon[0]?$aCoupon[0]:'';
		//订餐是否有更改
		$aMenuArr = array();
		foreach ($bookMenArr as $oMenu){
			$oMenu['name'] = $oMenu['name']?$oMenu['name']:'';
			if (!$oMenu['id']) {
				return BaseFunctions::returnResult(false, array("ER0002",$oMenu['name']."参数传递错误"));
			}
			$oGoods = new GoodsModel();
			$aGoods = $oGoods->detection($oMenu['id']);
			if (!$aGoods) {
				return BaseFunctions::returnResult(false, array("ER0003",$oMenu['name']."不存在或已停售"));
			}
			/*if ($aGoods['goods_real_pice']!=$oMenu['pice']) {
				return BaseFunctions::returnResult(false, array("ER0004",$oMenu['name']." 价格已变更"));
			}
			if ($aGoods['goods_name']!=$oMenu['name']) {
				return BaseFunctions::returnResult(false, array("ER0005",$oMenu['name']."已变更"));
			}*/
			//优惠计算
			$aTempGoodGold = array(
					'id' => $aGoods['id'],//
					'name' => $aGoods['goods_name'],//
					'b_gold' => $aGoods['goods_pice'],//
					'gold' => $aGoods['goods_real_pice'],//
					'b_v_gold' => $aGoods['goods_virtual_gold'] ,//原来的虚拟货币
					'v_gold' => $aGoods['goods_real_virtual_gold'], //虚拟货币
					'pro_order'=>0,
					'pro_id'=>0,
					'croup_id'=>0,
					'croup_str'=>''
			);
			$aTempGoodGold = $oGoods->computerProPice($aTempGoodGold,$iMerId,$aProList,$sCoupStr);
			$aMenuArr[] =$aTempGoodGold;
		}
		//生成消费订单
		$oOrder = new OrderModel();
		$aOrderAdd = $oOrder->addBookOrder($iAddUserId, $aUserMsg['username'], $aUserMsg['account_name'], $iAddUserId, $aMenuArr, $iMerId);
		if (!$aOrderAdd['type']) {
			return $aOrderAdd;
		}
		$orderId = $aOrderAdd['msg']['id'];
		$orderNum = $aOrderAdd['msg']['order_num'];
		
		//-----------------
		//添加客户关系信息
		$oCustomer = new Customer();
		$iCusTomerId = 0;
// 		echo "aa";
// 		return;
		if ($bookPhone) {
			$sFind = " * ";
			$sWhere = " phone = '{$bookPhone}'  and mrchant_id = '{$iMerId}' ";
			$aCustomerList = $oCustomer->find($sFind, $sWhere,true);
			if ($aCustomerList['msg'][0]) {
				//如果有就更新原来的;
				//统计订单数量
				$iBookNum = $aCustomerList['msg'][0]['take_out_num']?$aCustomerList['msg'][0]['take_out_num']:0;
				$iBookNum += 1;
				$iCusTomerId = $aCustomerList['msg'][0]['id'];
				$oCustomer->updateById($aCustomerList['msg'][0]['id'], array('take_out_num'=>$iBookNum,'c_name'=>$bookName,'user_id'=>$iAddUserId,'source_type' =>1),true);
			}else{
				//如果没有就插入
		
				$aAddCustomer = array(
						'mrchant_id'=>$iMerId,
						'c_name'=>$bookName,
						'phone'=>$bookPhone,
						'take_out_num'=>1,
						'source_type' =>1,
						'c_name' =>$bookName,
						'user_id'=>$iAddUserId
				);
		
				//如果没有就是
				$aDDCustomer = $oCustomer->add($aAddCustomer,true);
				$iCusTomerId = $aDDCustomer['msg']?$aDDCustomer['msg']:0;
			}
		}
		//----------------
		$aReAddBook = $this->addTakeOut($iAddUserId, $aUserMsg['account_name'], $aUserMsg['username'], $aUserMsg['iphone'], 
				$orderNum, '', '', '', 0, 
				0, 0, 0, $iMerId, 0, time(), 
				$bookName, 1, '', 0, 0, 
				$sAdd, 0, '', '', $bookDate, 
				$bookTime, $iCusTomerId, $bookPhone,$orderId);
		//Book($iAddUserId, $iMerId, $aParam,false);
		if($aReAddBook){
			return BaseFunctions::returnResult(true, $aReAddBook);
			//更新尤为卷为已经使用
		}else{
			return BaseFunctions::returnResult(false, array("ER0007","添加订单失败"));
		}
	}
	
	
	/**
	 *
	 * TO + 20140506 + 000000
	 * 前序 + 日期  + 编号
	 * @param unknown $iMerchantId
	 * @return number
	 */
	private function getOrderNum($iMerchantId){
		$sBr = "TO";
		$sT = date("Ymd");
		$sFind = " max(take_out_num) as min_num ";
		$sWhere = " `take_out_num` like '{$sBr}{$sT}%' and `merchant_id` = '{$iMerchantId}' ";
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
		$sBr = "TO";
		$sT = date("Ymd");
		return $sBr.$sT.$this->dispRepair($iNum,6,0);
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
	
	/**
	 *
	 * @param unknown $iStatus 更改后状态
	 * @param unknown $iPhone 电话号码
	 * @param unknown $sUserName 用户名字
	 * @param unknown $sOrderMsg 订单号码
	 * @param unknown $iMerchantId
	 * @param unknown $addUserId
	 * @param unknown $userId
	 * @param unknown $customer_id
	 * @return boolean
	 */
	private function sendNoticeMsg($iStatus,$iPhone,$sUserName,$sOrderMsg,$iMerchantId,$addUserId,$userId,$customer_id){
		$sBookMsg = array(
					'0' => '未确认',
					'1' => '送餐未安排',
					'2' => '送餐中，待客户签收',
		);
		$sStatusMsg = isset($sBookMsg[$iStatus])?$sBookMsg[$iStatus]:'';
		if (!$sStatusMsg) {
			return;
		}
		$sMsg = "{$sUserName}您好，你的外卖订单现在的状态是{$sStatusMsg}";
		$sMsg .= $sOrderMsg?",外卖订单验证码为{$sOrderMsg}":'';
		$o=new MessageModel();
		return	$o->sendImmediatelyNotice($sMsg,$iPhone,$iMerchantId,$addUserId,$userId,$sUserName,$customer_id);
	}
}
?>

