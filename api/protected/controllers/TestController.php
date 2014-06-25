<?php
class TestController extends BaseController {
	public function actionTMA(){
		$o = new MessageModel();
		$merId=1;
		$content='你好李文锦';
		$sendTime=time();
		$addUserId='';
		$userId="1";
		$userName="李文锦";
		$iPhoneNo='13632342271';
		$customer_id="";
		$re = $o->sendImmediatelyMsg($merId,$content,$sendTime,$addUserId,$userId,$userName,$iPhoneNo,$customer_id);
		BaseFunctions::ouputToString($re);
	}
}

?>