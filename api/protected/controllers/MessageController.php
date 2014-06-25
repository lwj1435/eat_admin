<?php
class MessageController extends BaseController {
	
	public function actionAddNotice(){
		BaseFunctions::writeLog(json_encode($_REQUEST));
		$aData = json_decode($_REQUEST['d'],true);
		//用户id
		$user_id = isset($aData['user_id'])?$aData['user_id'] : '';
		//商户id
		$merchant_id = isset($aData['merchant_id'])?$aData['merchant_id'] : '';
		
		$to_user_id = isset($aData['to_user_id'])?$aData['to_user_id'] : '';
		$to_user_name = isset($aData['to_user_name'])?$aData['to_user_name'] : '';
		$iPhoneNo = isset($aData['to_iphone'])?$aData['to_iphone'] : '';
		$customer_id =  isset($aData['customer_id'])?$aData['customer_id'] : '';
		//$msg = isset($aData['merchant_id'])?$aData['merchant_id'] : '';
		$o = new MessageModel();
		$sendTime = time();
		$message = "你已到号，请尽快到餐厅!";
		$re = $o->addListNotice($to_user_id, $to_user_name, $iPhoneNo, $user_id, $message, $sendTime, $merchant_id,$customer_id);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionAddMessage(){
		$aData = json_decode($_REQUEST['d'],true);
		//用户id
		$user_id = isset($aData['user_id'])?$aData['user_id'] : '';
		//商户id
		$merchant_id = isset($aData['merchant_id'])?$aData['merchant_id'] : '';
		$idlist = isset($aData['idlist'])?$aData['idlist']:'';
		$send_type = isset($aData['send_type'])?$aData['send_type']:'';
		$send_content = isset($aData['send_content'])?$aData['send_content']:'';
		$send_time = isset($aData['send_time'])?$aData['send_time']:'';
		$send_time = strtotime($send_time);
		$o = new MessageModel();
		if($send_type==2){
			$re = $o->addMessageByMerId($merchant_id,$send_content,$user_id,$send_time);
		}else{
			$idlist = $this->stringAndArray($idlist);

			$re = $o->addMessageByUser($merchant_id,$send_content,$send_time,$user_id,$idlist);
		}
		BaseFunctions::ouputToString($re);
	}
	
	public function actionAddPush(){
		$aData = json_decode($_REQUEST['d'],true);
		//用户id
		$user_id = isset($aData['user_id'])?$aData['user_id'] : '';
		//商户id
		$merchant_id = isset($aData['merchant_id'])?$aData['merchant_id'] : '';
		$idlist = isset($aData['idlist'])?$aData['idlist']:'';
		$send_type = isset($aData['send_type'])?$aData['send_type']:'';
		$send_content = isset($aData['send_content'])?$aData['send_content']:'';
		$send_time = isset($aData['send_time'])?$aData['send_time']:'';
		$title = isset($aData['title'])?$aData['title']:'';
		$send_time = strtotime($send_time);
		$o = new MessageModel();
		if($send_type==2){
			$re = $o->addPushByMerId($merchant_id,$send_content,$user_id,$send_time,$title);
		}else{
			$idlist = $this->stringAndArray($idlist);
	
			$re = $o->addPushByUser($merchant_id,$send_content,$send_time,$user_id,$idlist,$title);
		}
		BaseFunctions::ouputToString($re);
	}
}

?>