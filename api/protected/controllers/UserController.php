<?php
class UserController extends BaseController {
	public function actionIndex(){
		print_r($_REQUEST);
		echo "test";
	}
	public function actionUpdateMsg(){
		$aData = json_decode($_REQUEST['d'],true);
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';//用户id
		$sUserName = isset($aData['user_name'])?$aData['user_name']:'0';//用户名字
		$sex = isset($aData['sex'])?$aData['sex']:'';//用户性别
		$o = new UserModel();
		$re = $o->updateBaseMsg($iUserId,$sUserName,$sex);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionChangePSW(){
		$aData = json_decode($_REQUEST['d'],true);
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';//用户id
		$sOPSW = isset($aData['old_psw'])?$aData['old_psw']:'0';//旧密码
		$sNPSW = isset($aData['new_psw'])?$aData['new_psw']:'0';//新密码
		$o = new UserModel();
		$re = $o->updatePSW($iUserId,$sOPSW,$sNPSW);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionBingPhone(){
		$aData = json_decode($_REQUEST['d'],true);
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';//用户id
		$sOphone = isset($aData['old_phone'])?$aData['old_phone']:'0';//旧手机
		$sNphone = isset($aData['new_phone'])?$aData['new_phone']:'0';//新手机
		$scode  = isset($aData['code '])?$aData['code ']:'0';//新验证码
		$o = new UserModel();
		$re = $o->updatePhone($iUserId,$sOphone,$sNphone,$scode);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionUpAddress(){
		$aData = json_decode($_REQUEST['d'],true);
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';//用户id
		$id = isset($aData['id'])?$aData['id']:'';
		$address = isset($aData['address'])?$aData['address']:'';
		$phone = isset($aData['phone'])?$aData['phone']:'';
		$name = isset($aData['name'])?$aData['name']:'';
		$other_phone = isset($aData['other_phone'])?$aData['other_phone']:'';
		$user_id = isset($aData['user_id'])?$aData['user_id']:'';
		$area = isset($aData['area'])?$aData['area']:'';
		$pro = isset($aData['pro'])?$aData['pro']:'';
		$city = isset($aData['city'])?$aData['city']:'';
		$isUse = isset($aData['isUse'])?$aData['isUse']:'0';
		$o = new UserAddressModel();
		$re = $o->upAddress($id,$iUserId,$address,$phone,$name,$area,$pro,$city,$isUse);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionAddAddress(){
		$aData = json_decode($_REQUEST['d'],true);
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';//用户id
		$address = isset($aData['address'])?$aData['address']:'';
		$phone = isset($aData['phone'])?$aData['phone']:'';
		$name = isset($aData['name'])?$aData['name']:'';
		$other_phone = isset($aData['other_phone'])?$aData['other_phone']:'';
		$user_id = isset($aData['user_id'])?$aData['user_id']:'';
		$status = isset($aData['status'])?$aData['status']:'';
		$area = isset($aData['area'])?$aData['area']:'';
		$pro = isset($aData['pro'])?$aData['pro']:'';
		$city = isset($aData['city'])?$aData['city']:'';
		$isUse = isset($aData['isUse'])?$aData['isUse']:'0';
		$o = new UserAddressModel();
		$re = $o->addAddress($iUserId,$address,$phone,$name,$area,$pro,$city,$isUse);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionDelAddress(){
		$aData = json_decode($_REQUEST['d'],true);
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';//用户id
		$id = isset($aData['id'])?$aData['id']:'';
		$o = new UserAddressModel();
		$re = $o->delAddress($id,$iUserId);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionListAddress(){
		$aData = json_decode($_REQUEST['d'],true);
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';//用户id
		$o = new UserAddressModel();
		$re = $o->listAddress($iUserId);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionListTag(){
		$aData = json_decode($_REQUEST['d'],true);
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';//用户id
		$startPage = isset($aData['startPage'])?$aData['startPage']:'1';//用户id
		$pageNum = isset($aData['pageNum'])?$aData['pageNum']:'10';//用户id
		$count = isset($aData['count'])?$aData['count']:'1';//用户id
		$o = new TagModel();
		$re = $o->listTag( $startPage, $pageNum, $count);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionAddTag(){
		$aData = json_decode($_REQUEST['d'],true);
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';//用户id
		$sTagName = isset($aData['tag_name'])?$aData['tag_name']:'';//tagname
		$o = new usermodel();
		$re = $o->updateTag($iUserId,$sTagName);
		BaseFunctions::ouputToString($re);
	}
	
	/**
	 *  美吃试食接口
	 */
	public function actionApplyFreeFeed(){
		$aData = json_decode($_REQUEST['d'],true);
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';
		$sName = isset($aData['user_name'])?$aData['user_name']:'';
		$iPhone = isset($aData['phone'])?$aData['phone']:'';
		$sEmail = isset($aData['email'])?$aData['email']:'';
		$iActivityId = isset($aData['activity_id'])?$aData['activity_id']:'';
		$sQq = isset($aData['qq'])?$aData['qq']:'';
		$o= new FfUserListModel();
		$re= $o->addFFUL($iUserId,$sName,$iPhone,$sEmail,$iActivityId,$sQq,1);
		BaseFunctions::ouputToString($re);
	}
	
	/**
	 * 添加试食评论
	 */
	public function actionSendEssay(){
		$aData = json_decode($_REQUEST['d'],true);
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';
		$iMerId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$sTitle = isset($aData['title'])?$aData['title']:'';
		$sContext = isset($aData['context'])?$aData['context']:'';
		$fEva = isset($aData['eva'])?$aData['eva']:'';
		$fPer = isset($aData['per'])?$aData['per']:'';
		$aImageList = isset($aData['activity_id'])?$aData['activity_id']:'';
		$sMerName = isset($aData['mer_name'])?$aData['mer_name']:'';
		$sMerFeel = isset($aData['mer_feel'])?$aData['mer_feel']:'';
		$sArea = isset($aData['area'])?$aData['activity_id']:'';
		$sCity = isset($aData['city'])?$aData['city']:'';
		$sPro = isset($aData['pro'])?$aData['pro']:'';
		$iActivityId = isset($aData['activity_id'])?$aData['activity_id']:'';
		$o = new Article();
		$re = $o->addEssay($iMerId,$sTitle,$sContext,$fEva,$fPer,$aImageList,$iUserId,$sMerName,$sMerFeel,$sArea,$sCity,$sPro,$iActivityId);
		BaseFunctions::ouputToString($re);
	}

	/*
	 * 
	 */
	public function actoinChangeLogo(){
		$aData = json_decode($_REQUEST['d'],true);
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';
		$sStr = isset($aData['logo'])?$aData['logo']:'';
		$o = new UserModel();
		$re = $o->updateUserLogo($iUserId,$sStr);
		BaseFunctions::ouputToString($re);
	}


	public function actionLogin(){
		$aData = json_decode($_REQUEST['d'],true);
		$accountName = isset($aData['accountName'])?$aData['accountName']:'test';
		$password = isset($aData['password'])?$aData['password']:'123456';
		$type = isset($aData['type'])?$aData['type']:'';
		$o = new UserModel();
		if (ereg("^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+",$accountName)){
			$re =$o->loginEmail($accountName,$password,0);
		}else if(preg_match("/1[3458]{1}\d{9}$/",$phonenumber)){
			$re =$o->loginPhone($accountName,$password,0);
		}else{
			$re =$o->login($accountName,$password,0);
		}
		
		BaseFunctions::ouputToString($re);
	}
	

	public function actionEmailRegist(){
		$aData = json_decode($_REQUEST['d'],true);
		$email= isset($aData['email'])?$aData['email']:'';
		$password = isset($aData['password'])?$aData['password']:'';
		$o = new UserModel();
		$re = $o->emailRegist($email,$password);
		BaseFunctions::ouputToString($re);
	}

	public function actionPhoneRegist(){
		$aData = json_decode($_REQUEST['d'],true);
		$email= isset($aData['phone'])?$aData['phone']:'';
		$password = isset($aData['password'])?$aData['password']:'';
		$o = new UserModel();
		$re = $o->phoneRegist($email,$password);
		BaseFunctions::ouputToString($re);
	}

	public function actionPhoneCode(){
		$aData = json_decode($_REQUEST['d'],true);
		$email= isset($aData['phone'])?$aData['phone']:'';
		$o = new UserModel();
		// $re = $o->phoneRegist($email,$password);
		$re  = BaseFunctions::returnResult(true,array('code' => "123456" ));
		BaseFunctions::ouputToString($re);
	}

	public function actionEmailCode(){
		$aData = json_decode($_REQUEST['d'],true);
		$email= isset($aData['email'])?$aData['email']:'';
		$o = new UserModel();
		$re  = BaseFunctions::returnResult(true,array('code' => "123456" ));
		// $re = $o->emailRegist($email,$password);
		BaseFunctions::ouputToString($re);
	}

}

?>