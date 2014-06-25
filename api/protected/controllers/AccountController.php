<?php
class AccountController extends BaseController{
	public function actinRegister(){
		$aData = json_decode($_REQUEST['d'],true);
		$iType = "";
		$sAccount = "";
		$sEmail = "";
	}
	
	public function actionSendNotice(){
		$aData = json_decode($_REQUEST['d'],true);
		$iType = isset($_REQUEST['type'])?$_REQUEST['type']:'1';
		$sToNo = isset($_REQUEST['to_no'])?$_REQUEST['to_no']:'';
		if(!$sToNo){
			BaseFunctions::outputResult(false, "无效号码");
			return;
		}
		$o = new UserModel();
		//$o->
	}
}