<?php
class MessageController extends Controller {
	public function filters()
	{
		return array(
				array(
						'application.filters.AdminFilter'
				),
		);
	}
	public function actionNotice(){
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		//获取详细的信息
		/*
		 * $user_id = isset($aData['user_id'])?$aData['user_id'] : '';
		//商户id
		$merchant_id = isset($aData['merchant_id'])?$aData['merchant_id'] : '';
		
		$to_user_id = isset($aData['to_user_id'])?$aData['to_user_id'] : '';
		$to_user_name = isset($aData['to_user_name'])?$aData['to_user_name'] : '';
		$iPhoneNo = isset($aData['to_iphone'])?$aData['to_iphone'] : '';
		 */
		$to_user_id = isset($_REQUEST['to_user_id'])?$_REQUEST['to_user_id']:'';
		$to_user_name = isset($_REQUEST['to_user_name'])?$_REQUEST['to_user_name']:'';
		$to_iphone = isset($_REQUEST['to_iphone'])?$_REQUEST['to_iphone']:'';
		$customer_id = isset($_REQUEST['to_cus_id'])?$_REQUEST['to_cus_id']:'';
		if (!$to_iphone||!$to_user_name) {
			BaseFunctions::outputResult(false, "资料不全！");
			return;
		}
		$info = array(
				"user_id"=>Yii::app()->user->id,
				'merchant_id'=>$merid,
				'to_user_id'=> $to_user_id,
				'to_user_name' => $to_user_name,
				'to_iphone' => $to_iphone,
				'customer_id'=> $customer_id
		);
		$aRe = $this->dataChannel("message","addNotice",$info);
		if ($aRe['type']) {
			BaseFunctions::outputResult(true, "已添加提醒！");
			return;
		}else{
			BaseFunctions::ouputToString($aRe);
		}
	}
}

?>