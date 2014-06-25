<?php
class MessageModel extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$sTableKey = "message";
		parent::__construct($sTableKey);
	}
	
	public function getTableKey(){
		return $this->sTableKey;
	}

	/**
	 * 发送短信通知
	 * @param unknown $userId
	 * @param unknown $userName
	 * @param unknown $iPhoneNo
	 * @param unknown $addUserID
	 * @param unknown $message
	 * @param unknown $sendTime
	 * @param unknown $merid
	 * @return Ambigous <multitype:array, multitype:boolean unknown >|Ambigous <Ambigous, boolean, unknown>
	 */
	public function addListNotice($userId,$userName,$iPhoneNo,$addUserID,$message,$sendTime,$merid,$customer_id){
		//找出名字
		//
// 		BaseFunctions::writeLog($customer_id."--------------");
		$o = new UserModel();
		if ($customer_id){
			$oCus = new Customer();
			$oCustomer = $oCus->findById($customer_id);
			$userId = isset($oCustomer['msg'][0]['user_id'])?$oCustomer['msg'][0]['user_id']:'';
		}else{
			$oFromUser = $o->findById($userId);
			if (!isset($oFromUser['msg'][0]['id'])&&!$oFromUser['msg'][0]['id']) {
				return BaseFunctions::returnResult(false, "接受的用户错误");
			}
		}
		$oToUser = $o->findById($addUserID);
		if (!isset($oToUser['msg'][0]['id'])&&!$oToUser['msg'][0]['id']) {
			return BaseFunctions::returnResult(false, "添加的发送用户错误");
		}
		$addUserName = $oToUser['msg'][0]['username']?$oToUser['msg'][0]['username']:'';
		return $this->addUserNotice($userId, $userName, $iPhoneNo, $addUserID, $addUserName, $message, $sendTime, $merid,$customer_id);
	}
	
	/**
	 * 添加短信
	 * @param unknown $userId
	 * @param unknown $userName
	 * @param unknown $iPhoneNo
	 * @param unknown $addUserID
	 * @param unknown $addUserName
	 * @param unknown $message
	 * @param unknown $sendTime
	 * @param unknown $merId
	 * @return Ambigous <boolean, unknown>
	 */
	private function addUserNotice($userId,$userName,$iPhoneNo,$addUserID,$addUserName,$message,$sendTime,$merId,$customer_id,$title='',$type=0,$status=0){
// 		BaseFunctions::writeLog($customer_id."------------22--");
		$sendTime = $sendTime?$sendTime:time();
		$aParam = array(
				'from_id' =>$addUserID,
				'to_user_id' =>$userId,
				'to_user_name' =>$userName,
				'content' =>$message,
				'status' =>$status,
				'send_time' =>$sendTime,
				'add_time' =>time(),
				'to_no' =>$iPhoneNo,
				'from_user_name'=>$addUserName,
				'merchant_id'=>$merId,
				'customer_id'=>$customer_id,
				'type'=>$type,
				'title'=>$title
		);
		return $this->add($aParam,true);
	}
	
	/**
	 * 
	 * @param unknown $merId
	 * @param unknown $content
	 * @param unknown $addUserId
	 */
	public function addMessageByMerId($merId,$content,$addUserId,$send_time,$title='',$type=0){
		//获取所有供应商的所有客户
		$o = new Customer();
		//TODO以后这里要分开写
		$sWhere = " mrchant_id = '{$merId}' and `status` >-1 ";
		$re = $o->find("*", $sWhere);
		$arrList = array();
		if ($re['type']) {
			foreach ($re['msg'] as $item){
				if (isset($item['id'])&&$item['id']) {
					$arrList[] =$item['id'];
				}
			}
			return $this->addMessageByUser($merId,$content,$send_time,$addUserId,$arrList,$title,$type);
		}else{
			return BaseFunctions::returnResult(false, "没任何客户记录");
		}
	}
	
	public function addMessageByUser($merId,$content,$sendTime,$addUserId,$arrCusList,$title='',$type=0){
		$o = new UserModel();
		$oToUser = $o->findById($addUserId);
		if (!isset($oToUser['msg'][0]['id'])&&!$oToUser['msg'][0]['id']) {
			return BaseFunctions::returnResult(false, "添加的发送用户错误");
		}
		$addUserName = $oToUser['msg'][0]['username']?$oToUser['msg'][0]['username']:'';
		foreach ($arrCusList as $aid){
			if ($aid) {
				$oCus = new Customer();
				$oCustomer = $oCus->findById($aid);
				$userId = isset($oCustomer['msg'][0]['user_id'])?$oCustomer['msg'][0]['user_id']:'';
				$userName = isset($oCustomer['msg'][0]['c_name'])?$oCustomer['msg'][0]['c_name']:'';
				$phone = isset($oCustomer['msg'][0]['phone'])?$oCustomer['msg'][0]['phone']:'';
				if (!$phone) {
					continue;
				}else{
					$this->addUserNotice($userId, $userName, $phone, $addUserId, $addUserName, $content, $sendTime, $merId, $aid,$title,$type);
				}
			}
		}
		return BaseFunctions::returnResult(false, "添加完成");
	}
	
	public function addPushByMerId($merId,$content,$addUserId,$send_time,$title='',$type=1){
		return $this->addMessageByMerId($merId,$content,$addUserId,$send_time,$title,$type);
	}
	
	public function addPushByUser($merchant_id,$send_content,$send_time,$user_id,$idlist,$title){
		return $this->addMessageByUser($merchant_id,$send_content,$send_time,$user_id,$idlist,$title,1);
	}
	
	/**
	 * 
	 * @param unknown $merId
	 * @param unknown $content
	 * @param unknown $sendTime
	 * @param unknown $addUserId
	 * @param unknown $arrCusList
	 * @param unknown $userId
	 * @param unknown $userName
	 * @param unknown $iPhoneNo
	 * @param unknown $customer_id
	 */
	public function sendImmediatelyMsg($merId,$content,$sendTime,$addUserId,$userId,$userName,$iPhoneNo,$customer_id){
		return $this->addUserNotice($userId,$userName,$iPhoneNo,"","",$content,$sendTime,$merId,$customer_id,'',0,1);
	}
	
	/**
	 * 
	 * @param unknown $con 发送的内容
	 * @param unknown $tel 接受的电话号码
	 * @return boolean
	 */
	public function sendImmediatelyNotice($con,$tel,$iMerchantId,$addUserId,$userId,$userName,$customer_id){
		if(preg_match("/1[3458]{1}\d{9}$/",$tel)){  
			BaseFunctions::writeLog("成功发送");
			$url='http://smsapi.c123.cn/OpenPlatform/OpenApi';
			$ac='1001@500910240001';		//用户账号
			$authkey = '58E117A881742C2F86895331BB9F8AA7';//'9FFC0C71280583642CC8ACCF737180D7';		//认证密钥
			$cgid='1416'; //通道组编号
			$c = urlencode($con);		//内容
			$m= $tel;	//号码
			$csid='';   //签名编号 ,可以为空时，使用系统默认的编号
			$t='';      //发送时间,可以为空表示立即发送
			$sUrl = "http://smsapi.c123.cn/OpenPlatform/OpenApi?action=sendOnce&ac={$ac}&authkey={$authkey}&cgid={$cgid}&c={$c}&m={$m}";
			$a = file_get_contents($sUrl);

			BaseFunctions::writeLog("成功发送  {$sUrl}");
			$sendTime=time();
			$re = $this->sendImmediatelyMsg($iMerchantId,$con,$sendTime,$addUserId,$userId,$userName,$tel,$customer_id);
			
			return true;
		}
			BaseFunctions::writeLog("错误发送");
		return false;
	}
}


?>