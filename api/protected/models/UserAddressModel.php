<?php
class UserAddressModel extends BaseModel{
	private $sTableKey;
	public function __construct(){
		$sTableKey = "user_address";
		parent::__construct($sTableKey);
	}

	public function getTableKey(){
		return $this->sTableKey;
	}
	
	private function actionSetUnUse($iUserID){
		$aParam = array('status'=>0);
		Yii::app()->objMySql->update($this->sMtable," `user_id` = {$iUserID} ", $aParam, false);
	}
	
	public function addAddress($iUserId,$sAddress,$iPhone,$sUserName,$sArea,$sPro,$sCity,$isUse){
		$o = new UserModel();
		$aUser = $o->detection($iUserId);
		if (!$aUser) {
			return BaseFunctions::returnResult(false, array('ER0001','用户不存在!'));
		}
		$isUse = $isUse==0?0:1;
		if ($isUse==1) {
			$this->actionSetUnUse($iUserId);
		}
		$aParam = array(
				'address' => $sAddress,
				'phone' => $iPhone,
				'name' => $sUserName,
				'other_phone' => '',
				'user_id' => $iUserId,
				'account_name' => $aUser['account_name'],
				'ad_time' => time(),
				'modify_time' => '',
				'status' => $isUse,
				'area' => $sArea,
				'pro' => $sPro,
				'city' => sCity,
		);
		return $this->add($aParam);
	}
	
	public function delAddress($iAddId,$iUserId){
		$o = new UserModel();
		$aUser = $o->detection($iUserId);
		if (!$aUser) {
			return BaseFunctions::returnResult(false, array('ER0001','用户不存在!'));
		}
		//TODO要判断是否这个用户的
		$aParam = array('modify_time' => time(),'status' => '-1');
		return $this->updateById($iAddId, $aParam);
	}
	
	public function upAddress($iAddId,$iUserId,$sAddress,$iPhone,$sUserName,$sArea,$sPro,$sCity,$isUse){
		$o = new UserModel();
		$aUser = $o->detection($iUserId);
		if (!$aUser) {
			return BaseFunctions::returnResult(false, array('ER0001','用户不存在!'));
		}
		$isUse = $isUse==0?0:1;
		if ($isUse==1) {
			$this->actionSetUnUse($iUserId);
		}
		$aParam = array(
				'address' => $sAddress,
				'phone' => $iPhone,
				'name' => $sUserName,
				'other_phone' => '',
				'user_id' => $iUserId,
				'account_name' => $aUser['account_name'],
				'modify_time' => time(),
				'status' => $isUse,
				'area' => $sArea,
				'pro' => $sPro,
				'city' => sCity,
		);
		return $this->updateById($iAddId, $aParam);
	} 
	
	public function listAddress($iUserId){
		$o = new UserModel();
		$aUser = $o->detection($iUserId);
		if (!$aUser) {
			return BaseFunctions::returnResult(false, array('ER0001','用户不存在!'));
		}
		$sWhere = " `user_id` = $iUserId and status >-1 ";
		$aAddressObj = $this->yiiPage("UserAddress", "*",$sWhere);
		$aRe = array();
		foreach ($aAddressObj as $o){
			$aTemp = array();
			$aTemp['id'] = $o->id;
			$aTemp['address'] = $o->address;
			$aTemp['phone'] = $o->phone;
			$aTemp['name'] = $o->name;
			$aTemp['other_phone'] = $o->other_phone;
			$aTemp['user_id'] = $o->user_id;
			$aTemp['account_name'] = $o->account_name;
			$aTemp['ad_time'] = $o->ad_time;
			$aTemp['modify_time'] = $o->modify_time;
			$aTemp['status'] = $o->status;
			$aTemp['area'] = $o->area;
			$aTemp['pro'] = $o->pro;
			$aTemp['city'] = $o->city;
			$aRe[] = $aTemp;
		}
		return BaseFunctions::outputResult(true, $aRe);
	}
}
?>