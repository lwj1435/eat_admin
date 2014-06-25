<?php
class ServerMsgModel extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$this->sTableKey = "server_msg";
		parent::__construct($this->sTableKey);
	}

	public function getTableKey(){
		return $this->sTableKey;
	}
	public function addServerMsg($id,$from_user_id,$to_user_id,$from_merchant_id,$add_time,$status,$parent_id,$first_id,$from_user_name,$to_name,$content,$get_time,$reply_time,$send_time,$reply_content,$detail_content){
		$aParam = array();
		$aParam["id"]=$id;
		$aParam["from_user_id"]=$from_user_id;
		$aParam["to_user_id"]=$to_user_id;
		$aParam["from_merchant_id"]=$from_merchant_id;
		$aParam["add_time"]=$add_time;
		$aParam["status"]=$status;
		$aParam["parent_id"]=$parent_id;
		$aParam["first_id"]=$first_id;
		$aParam["from_user_name"]=$from_user_name;
		$aParam["to_name"]=$to_name;
		$aParam["content"]=$content;
		$aParam["get_time"]=$get_time;
		$aParam["reply_time"]=$reply_time;
		$aParam["send_time"]=$send_time;
		$aParam["reply_content"]=$reply_content;
		$aParam["detail_content"]=$detail_content;
		return $this->add($aParam,true);
	}

	public function updateServerMsg($id,$from_user_id,$to_user_id,$from_merchant_id,$add_time,$status,$parent_id,$first_id,$from_user_name,$to_name,$content,$get_time,$reply_time,$send_time,$reply_content,$detail_content){
		$aParam = array();
		$aParam["id"]=$id;
		$aParam["from_user_id"]=$from_user_id;
		$aParam["to_user_id"]=$to_user_id;
		$aParam["from_merchant_id"]=$from_merchant_id;
		$aParam["add_time"]=$add_time;
		$aParam["status"]=$status;
		$aParam["parent_id"]=$parent_id;
		$aParam["first_id"]=$first_id;
		$aParam["from_user_name"]=$from_user_name;
		$aParam["to_name"]=$to_name;
		$aParam["content"]=$content;
		$aParam["get_time"]=$get_time;
		$aParam["reply_time"]=$reply_time;
		$aParam["send_time"]=$send_time;
		$aParam["reply_content"]=$reply_content;
		$aParam["detail_content"]=$detail_content;
		return $this->updateById($id,$aParam,true);
	}

		/**
	 * 
	 * @param unknown $content
	 * @param unknown $userId
	 * @param unknown $merId
	 * @return Ambigous <boolean, unknown>
	 */
	public function addServerReply($content,$detail_content,$userId,$merId){
		$oUser= new UserModel();
		$aUserMsg = $oUser->findById($userId);
		if (!$aUserMsg['type']||!isset($aUserMsg['msg'][0]['id'])) {
			return BaseFunctions::returnResult(false, "无此用户");
		}
		$sUserName = isset($aUserMsg['msg'][0]['username'])?$aUserMsg['msg'][0]['username']:'';
		return $this->add(array(
				'from_user_id' => $userId,
				'content' => $content,
				'from_merchant_id' => $merId,
				'from_user_name'=>$sUserName,
				'detail_content'=>$detail_content,
				'send_time'=>time()
		),true);
	}
}
?>

