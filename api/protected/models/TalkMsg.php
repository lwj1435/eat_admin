<?php

/**
 *
 * @author jen
 * Book model
 */
class TalkMsg extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$sTableKey = "talk_log";
		parent::__construct($sTableKey);
	}
	
	public function getTableKey(){
		return $this->sTableKey;
	}
	
	/**
	 * 回复信息
	 * @param unknown $iRId
	 * @param unknown $iUserId
	 * @param unknown $iMerchantId
	 * @param unknown $sCon
	 */
	public function replyMsg($iRId,$iUserId,$iMerchantId,$sCon){
		//读取信息
		$aMsg = $this->findById($iRId);
		//判断权限
		if (!$aMsg['type']||!isset($aMsg['msg'][0]['to_merchant_id'])||$aMsg['msg'][0]['to_merchant_id']!=$iMerchantId) {
			return BaseFunctions::returnResult(false, "无权限");
		}
		$iTime = time();
		//修改 信息
		$this->updateById($iRId, array(
				'status'=>2,
				'reply_content'=>$sCon,
				'reply_time' => $iTime,
		));
		$oUser= new UserModel();
		$aUserMsg = $oUser->findById($iUserId);
		if (!$aUserMsg['type']||!isset($aUserMsg['msg'][0]['id'])) {
			return BaseFunctions::returnResult(false, "无此用户");
		}
		$sUserName = isset($aUserMsg['msg'][0]['username'])?$aUserMsg['msg'][0]['username']:'';
		
		//添加记录
		return $this->add(array(
				'from_user_id' => $iUserId,
				'to_user_id' => $aMsg['msg'][0]['from_user_id'],
				'add_time' => $iTime,
				'status' => '0',
				'parent_id' => $iRId,
				'first_id' => $aMsg['msg'][0]['first_id'],
				'from_user_name' => $sUserName,
				'to_name' => $aMsg['msg'][0]['from_user_name'],
				'content' => $sCon,
				'send_time' =>$iTime
		));
	}
}