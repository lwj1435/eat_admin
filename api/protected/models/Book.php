<?php
/**
 *
 * @author jen
 * Book model
 */
class Book extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$sTableKey = "book";
		parent::__construct($sTableKey);
	}
	
	public function getTableKey(){
		return $this->sTableKey;
	}

	/**
	 * 获取当前到号
	 * @param unknown $sType array(0=>全部,A=>2人,B=>2到4人，C=>5-8人,D=>包厢)
	 */
	public function getBookReachNum($iType,$iMerchantId){
		if ($iType>0) {
			$sWhere = " `status` = '{2}' and `book_type` = '{$sType}' and `merchange_id` = '{$iMerchantId}' ";
		}else{
			$sWhere = " `status` = '{2}' and `merchange_id` = '{$iMerchantId}' ";
		}
		$aFindResult =  Yii::app()->objMySql->find($this->sMtable,$sWhere,false);
		if($aFindResult['msg']){
			return $aFindResult;
		}else{
			//TODO
			//没有就插入新的,不用插入
			//返回空值
			return BaseFunctions::returnResult(true, array());
		}
	}
	
// 	private function getBookReachNumByType($sType){
// 		$sWhere = " `status` = '{2}' and `book_type` = '{$sType}' ";
// 		$aFindResult =  Yii::app()->objMySql->find($this->sMtable,$sWhere,false);
// 		if($aFindResult['msg']){
// 			return $aFindResult;
// 		}else{
// 			//TODO
// 			//没有就插入新的,不用插入
// 			//返回空值
// 			return BaseFunctions::returnResult(true, array());
// 		}
// 	}
	
	/**
	 * 
	 */
	public function changeBookNum(){
		
	}
	
	/**
	 * 添加订单
	 * @param unknown $iAddUser
	 * @param unknown $aParam
	 */
	public function addBook($iAddUser,$iMerchantId,$aParam){
		$order_num = $this->getOrderNum($iMerchantId);
		$aAddParam = array();
		$aAddParam['user_id'] = $aParam['user_id']?$aParam['user_id']:'';
		$aAddParam['account_name'] = $aParam['account_name']?$aParam['account_name']:'';
		$aAddParam['user_name'] = $aParam['user_name']?$aParam['user_name']:'';
		$aAddParam['merchange_id'] = $iMerchantId?$iMerchantId:"0";
		$aAddParam['book_time'] = $aParam['book_time']?$aParam['book_time']:'';
		$aAddParam['book_desc'] = $aParam['book_desc']?$aParam['book_desc']:'';
		$aAddParam['book_phone'] = $aParam['book_phone']? $aParam['book_phone']:'';
		$aAddParam['book_name'] = $aParam['book_name']?$aParam['book_name']:'';
		$aAddParam['book_num'] = $aParam['book_num']?$aParam['book_num']:'';
		$aAddParam['book_no'] = $aParam['book_no']?$aParam['book_no']:'';
		$aAddParam['status'] = 0;
		$aAddParam['book_or_num'] =  $this->createOrderOrNum($order_num);
		$aAddParam['book_type'] = $aParam['book_type']?$aParam['book_type']:'0';
		$aAddParam['add_user_id'] = $iAddUser;
		$aAddParam['commit_time'] = time();
		$aAddParam['book_date'] = isset($aParam['book_date'])?$aParam['book_date']:'';
		$aAddParam['book_sex'] = isset($aParam['book_sex'])?$aParam['book_sex']:'';
		$aAddParam['add_time'] = time();
		return $this->add($aAddParam);
	}
	
	/**
	 * 
	 * 添加订单
	 * @param unknown $iAddUser
	 * @param unknown $iMerchantId
	 * @param unknown $aParam
	 * @param string $type true 为商家添加  false为客户添加
	 * @return Ambigous <boolean, unknown>
	 */
	public function addMerBook($iAddUser,$iMerchantId,$aParam,$type=true){
		$order_num = $this->getOrderNum($iMerchantId);
		$aAddParam = array();
		$aAddParam['user_id'] = $aParam['user_id']?$aParam['user_id']:'';
		$aAddParam['account_name'] = $aParam['account_name']?$aParam['account_name']:'';
		$aAddParam['user_name'] = $aParam['user_name']?$aParam['user_name']:'';
		$aAddParam['merchange_id'] = $iMerchantId?$iMerchantId:"0";
		$aAddParam['book_time'] = $aParam['book_time']?$aParam['book_time']:'';
		$aAddParam['book_desc'] = $aParam['book_desc']?$aParam['book_desc']:'';
		$aAddParam['book_phone'] = $aParam['book_phone']? $aParam['book_phone']:'';
		$aAddParam['book_name'] = $aParam['book_name']?$aParam['book_name']:'';
		$aAddParam['book_num'] = $aParam['book_num']?$aParam['book_num']:'';
		$aAddParam['book_no'] = $aParam['book_no']?$aParam['book_no']:'';
		$aAddParam['status'] = $type?1:'0';//商家就是已确认
		$aAddParam['book_or_num'] =  $this->createOrderOrNum($order_num);
		$aAddParam['book_type'] = $aParam['book_type']?$aParam['book_type']:'0';
		$aAddParam['add_user_id'] = $iAddUser;
		$aAddParam['commit_time'] = $type?time():0;
		$aAddParam['book_date'] = isset($aParam['book_date'])?$aParam['book_date']:'';
		$aAddParam['book_sex'] = isset($aParam['book_sex'])?$aParam['book_sex']:'';
		$aAddParam['add_time'] = time();
		$aAddParam['book_phone'] = trim($aAddParam['book_phone']);
		$aAddParam['book_source_type'] =  isset($aParam['book_source_type'])?$aParam['book_source_type']:2;
		$aAddParam['order_num'] =  isset($aParam['order_num'])?$aParam['order_num']:'';
		$aAddParam['order_id'] =  isset($aParam['order_id'])?$aParam['order_id']:0;
		
		//判断是否有这个用户
		$oUser = new UserModel();
		$sFind = " * ";
		$sWhere = " iphone ='{$aAddParam['book_phone']}' ";
		$aUserList = $oUser->find($sFind, $sWhere,true);
		$iSourceType = $type?2:1;//商家默认为2/线下  1/线上
		$iUserName = "";
		//如果有就是线上，然后更改
		if ($aUserList['msg'][0]) {
			$iSourceType = 1;
			$iUserName = $aUserList['msg'][0]['username'];
			$aAddParam['user_id'] =  $aUserList['msg'][0]['id'];
			$aAddParam['user_name'] = $iUserName;
		}else{
			$iSourceType = 2;
			$iUserName = $aAddParam['book_name'];
		}
		$aAddParam['book_source_type']=$iSourceType;
		
		
		//添加客户关系信息
		$oCustomer = new Customer();
		$iCusTomerId = 0;
		if ($aAddParam['book_phone']) {
			$sFind = " * ";
			$sWhere = " phone = '{$aAddParam['book_phone']}'  and mrchant_id = '{$aAddParam['merchange_id']}' ";
			$aCustomerList = $oCustomer->find($sFind, $sWhere,true);
			if ($aCustomerList['msg'][0]) {
				//如果有就更新原来的;
				//统计订单数量
				$iBookNum = $aCustomerList['msg'][0]['book_num']?$aCustomerList['msg'][0]['book_num']:0;
				$iBookNum += 1;
				$iCusTomerId = $aCustomerList['msg'][0]['id'];
				$oCustomer->updateById($aCustomerList['msg'][0]['id'], array('book_num'=>$iBookNum,'c_name'=>$iUserName,'user_id'=>$aAddParam['user_id'],'source_type' =>$iSourceType),true);
			}else{
				//如果没有就插入
				
				$aAddCustomer = array(
						'mrchant_id'=>$aAddParam['merchange_id'],
						'c_name'=>$aAddParam['book_name'],
						'phone'=>$aAddParam['book_phone'],
						'book_num'=>1,
						'source_type' =>$iSourceType,
						'c_name' =>$iUserName,
						'user_id'=>$aAddParam['user_id']
				);
				
				//如果没有就是
				$aDDCustomer = $oCustomer->add($aAddCustomer,true);
				$iCusTomerId = $aDDCustomer['msg']?$aDDCustomer['msg']:0;
			}
		}
		$aAddParam['customer_id'] = $iCusTomerId;
		$addRe = $this->add($aAddParam,true);

		//添加发送电话
		if ($type&&$addRe['type']) {
			$this->sendNoticeMsg(1,$aAddParam['book_phone'],$aAddParam['book_name'],$order_num,$iMerchantId,$iAddUser,$aAddParam['user_id'],$aAddParam['customer_id']);
		}
		return $addRe;
	}
	
	/**
	 * 
	 * OR + 20140506 + 000000
	 * 前序 + 日期  + 编号
	 * @param unknown $iMerchantId
	 * @return number
	 */
	private function getOrderNum($iMerchantId){
		$sBr = "OR";
		$sT = date("Ymd");
		$sFind = " max(book_or_num) as min_num ";
		$sWhere = " `book_or_num` like '{$sBr}{$sT}%' and `merchange_id` = '{$iMerchantId}' ";
		$aRe = $this->find($sFind,$sWhere);
		if($aRe['msg'][0]['min_num']){
			$sFindNum = substr($aRe['msg'][0]['min_num'],10);
			$iFindNum = intval($sFindNum);
			$iFindNum = $iFindNum +1;
			//$newNumber = $this->dispRepair($iFindNum,6,0);//substr(strval($iFindNum+100000),1,5);
			return $iFindNum;
		}else{
			return 1;
		}
	}
	
	private function createOrderOrNum($iNum){
		$sBr = "OR";
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
	 * 更变订单状态
	 * @param unknown $iUserId
	 * @param unknown $iOrderId
	 * @param unknown $iToStatus
	 * @param unknown $iMerchantId
	 * @param unknown $iFromStatus
	 */
	function changeBookStatus($iUserId,$iOrderId,$iToStatus,$iMerchantId,$iFromStatus=-100){
		if ($iFromStatus>-100) {
			//TODO判断是否 符合条件 商家已经
		}
		$aParam = array(
				'status' => $iToStatus
		);
		$re =  $this->updateById($iOrderId, $aParam,true);
		if($re['type']){
			if ($iToStatus!=3) {
// 				$o = new Book();
				$aBookArr = $this->findById($iOrderId);
				if ($aBookArr['type']) {
					
					$this->sendNoticeMsg($iToStatus,$aBookArr['msg'][0]['book_phone'],
							$aBookArr['msg'][0]['book_name'],$aBookArr['msg'][0]['book_or_num'],
							$iMerchantId,$iUserId,$aBookArr['msg'][0]['user_id'],$aBookArr['msg'][0]['customer_id']);
					
				}
			}
			BaseFunctions::outputResult(true, "修改成功");
		}else{
			BaseFunctions::outputResult(false, "修改失败");
		}
	}
	
	/**
	 * 预约统计
	 * @param unknown $iBTime 开始时间
	 * @param unknown $iETime 结束时间
	 */
	function getBookTotal($iBTime,$iETime,$iMerchantId){
		$sFind = " count(1) as num , `status` ";
		$sWhere = " `merchange_id` = '{$iMerchantId}' and `reserve_time` > {$iBTime} and `reserve_time` < {$iETime} group by `status` ";
		$aArr = $this->find($sFind, $sWhere);
		return $aArr;
	}
	
	/**
	 * 获取详细的查找
	 * @param unknown $iBookId
	 * @param unknown $iMerchantId
	 * @param string $isShowSQL
	 * @return unknown
	 */
	function getBookDetail($iBookId,$iMerchantId,$isShowSQL=false){
		return $this->findById($iBookId,$isShowSQL);
	}
	
	/**
	 * 设置座位
	 * @param unknown $iBookId
	 * @param unknown $iSeatId
	 * @param unknown $iMerchantId
	 */
	public function setSeat($iUserId,$iBookId,$iMerchantId,$iChangeType,$iSeatId,$bookSeatType,$bookSeatNum){
		$oSeat = new Seat();
		$reSet = $oSeat->changeSeatStatus($iMerchantId,$iSeatId,3,1,true);
		if ($reSet['type']) {
			//$this->changeBookStatus($iUserId, $iBookId, $iToStatus, $iMerchantId);
			$iNowTime = time();
			$aParam = array(
					'reach_time' => $iNowTime,
					'begin_time' => $iNowTime,
					'book_seat_id'=>$iSeatId,
			);
			if ($bookSeatNum) {
				$aParam['book_seat_num'] = $bookSeatNum;
			}
			if ($bookSeatType) {
				$aParam['book_seat_type'] = $bookSeatType;
			}
			if ($iChangeType == 1) {
				$aParam['status'] = 2;
				$aParam['reach_time'] = time();
			}else if ($iChangeType == 2) {
				$aParam['status'] = 3;
				$aParam['over_time'] = time();
			}else{
				return BaseFunctions::returnResult(false, "缺少参数!");
			}
			$re = $this->updateById($iBookId, $aParam,true);
			if ($re['type']) {
				$aBookArr = $this->findById($iBookId);
				if ($aBookArr['type']) {
					$this->sendNoticeMsg($aParam['status'],$aBookArr['msg'][0]['book_phone'],
							$aBookArr['msg'][0]['book_name'],$aBookArr['msg'][0]['book_or_num'],
							$iMerchantId,$iUserId,$aBookArr['msg'][0]['user_id'],$aBookArr['msg'][0]['customer_id']);
						
				}
				//$o->sendImmediatelyMsg($iMerchantId, $content, time(), $iUserId, $userId, $userName, $iPhoneNo, $customer_id);	
				return BaseFunctions::returnResult(true, "修改完毕");
			}else{
				return BaseFunctions::returnResult(false, "修改有误");
			}
		
		}else{
			return $reSet;
		}
	}
	
	public function addDelayTime($iUserId,$iMerchantId,$iBookId){
		$aBre = $this->findById($iBookId);
		if(!$aBre['type']||!isset($aBre['msg'][0]['merchange_id'])||$aBre['msg'][0]['merchange_id']!=$iMerchantId){
			return BaseFunctions::returnResult(false, "没此记录，或没权限");
		}
		$iTime = isset($aBre['msg'][0]['delay_time'])?$aBre['msg'][0]['delay_time']:0;
		$iAddTime = 10 * 60 ;
		$iT = $iTime + $iAddTime;
		$aParam = array('delay_time'=>$iT);
		$this->updateById($iBookId, $aParam);
		return BaseFunctions::returnResult(true, "更改成功");
	}
	
	public function getReach($merId){
		$re = array();
		$aReach = $this->getReachByType("A", $merId);
		$bReach = $this->getReachByType("B", $merId);
		$cReach = $this->getReachByType("C", $merId);
		$dReach = $this->getReachByType("D", $merId);
		return BaseFunctions::returnResult(true, array(
				'A'=>$aReach,
				'B'=>$bReach,
				'C'=>$cReach,
				'D'=>$dReach
		));
	}
	
	public function getReachByType($sType,$merId){
		$sDate = date("Y-m-d");
		$sWhere = " merchange_id = '$merId' and book_type = '$sType' and status = 2 and  book_date = '{$sDate}' ";
		$re = $this->find('book_no', $sWhere);
		return isset($re['msg'][0]['book_no'])?($re['msg'][0]['book_no']?$re['msg'][0]['book_no']:0):0;
	}
	
	/**
	 * 通过人数计算座位号码
	 * @param unknown $bookNum
	 * @return string
	 */
	public function countBookType($bookNum){
		return $bookNum>8?"D":($bookNum>4?"C":($bookNum>2?"B":"A"));
	}
	
	/**
	 * 添加订座 --> 客户端
	 * @param unknown $iAddUserId
	 * @param unknown $iMerId
	 * @param unknown $bookDate
	 * @param unknown $bookTime
	 * @param unknown $bookNum
	 * @param unknown $bookSeatType
	 * @param unknown $bookName
	 * @param unknown $bookPhone
	 * @param unknown $bookDesc
	 * @param unknown $bookMenArr
	 * @return Ambigous <multitype:array, multitype:boolean unknown >|Ambigous <Ambigous, unknown, multitype:array, multitype:boolean unknown >
	 */

	public function addBookCli($iAddUserId,$iMerId,$bookDate,$bookTime,$bookNum,$bookSeatType,$bookName,$bookPhone,$bookDesc,$bookMenArr){
		//用户是否合法
		$oUser = new UserModel();
		$aUserMsg = $oUser->detection($iAddUserId);
		if (!$aUserMsg) {
			return BaseFunctions::returnResult(false, "ER0001");
		}
			
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
			$aMenuArr[] = array(
					'id' => $aGoods['id'],//
					'name' => $aGoods['goods_name'],//
					'b_gold' => $aGoods['goods_pice'],//
					'gold' => $aGoods['goods_real_pice'],//
					'b_v_gold' => $aGoods['goods_virtual_gold'] ,//原来的虚拟货币
					'v_gold' => $aGoods['goods_real_virtual_gold'] //虚拟货币
			);
		}
		//生成消费订单
		$oOrder = new OrderModel();
		BaseFunctions::writeLog("生成消费订单");
		$aOrderAdd = $oOrder->addBookOrder($iAddUserId, $aUserMsg['username'], $aUserMsg['account_name'], $iAddUserId, $aMenuArr, $iMerId);
		if (!$aOrderAdd['type']) {
			return $aOrderAdd;
		}
		$orderId = $aOrderAdd['msg']['id'];
		$orderNum = $aOrderAdd['msg']['order_num'];
		//计算定位的类型
		$book_type = $bookSeatType?'D':$this->countBookType($bookNum);
		//生成book单
		$aParam = array(
					'user_id' =>$iAddUserId,
					'account_name' =>$aUserMsg['account_name'],
					'user_name' =>$aUserMsg['username'],
					'book_time' =>$bookTime,
					'book_desc' =>$bookDesc,
					'book_phone' =>$bookPhone,
					'book_name' =>$bookName,
					'book_num' =>$bookNum,
					'book_no' =>'',
					'book_or_num' =>$this->createOrderOrNum($this->getOrderNum($iMerId)),
					'book_type' =>$book_type,//订座类型
					'book_date' =>$bookDate,
					'book_sex' =>$aUserMsg['sex'],
					'book_phone' =>$bookPhone,
					'book_source_type'=>1,
					'order_num'=> $orderNum,//消费单编号
					'order_id'=> $orderId,//消费单id
		);
		$aReAddBook = $this->addMerBook($iAddUserId, $iMerId, $aParam,false);
		if($aReAddBook){
			return BaseFunctions::returnResult(true, $aReAddBook);
		}else{
			return BaseFunctions::returnResult(false, array("ER0007","添加订单失败"));
		}
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
				'0'=>'未确认',
				'1'=>'已确认',
				'2'=>'已到号',
				'3'=>'已入席',
				'4'=>'已取消',
				'5'=>'已取消',
		);
		$sStatusMsg = isset($sBookMsg[$iStatus])?$sBookMsg[$iStatus]:'';
		$sMsg = "{$sUserName}您好，你的订座现在的状态是{$sStatusMsg}";
		$sMsg .= $sOrderMsg?",定座验证码为{$sOrderMsg}":'';
		$o=new MessageModel();
		return	$o->sendImmediatelyNotice($sMsg,$iPhone,$iMerchantId,$addUserId,$userId,$sUserName,$customer_id);
	}
}

?>