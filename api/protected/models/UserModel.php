<?php
class UserModel extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$sTableKey = "user";
		parent::__construct($sTableKey);
	}
	
	public function getTableKey(){
		return $this->sTableKey;
	}
	
	public function login($accountName,$password,$type=-1){
		if (!$accountName) {
			return BaseFunctions::returnResult(false, array("ER00021","请填写账户"));
		}
		$sWhere = " `account_name` = '{$accountName}' and password = '{$password}' ";
		$sWhere .= $type>0?" and `type` = '{$type}'  ":"";
		$re =Yii::app()->objMySql->find($this->sMtable, $sWhere, true);
		if($re['type']){
			return BaseFunctions::returnResult(true, $re['msg'][0]);
		}else{
			return BaseFunctions::returnResult(false, array("ER00024","账户或密码错误"));
		}
	}
	
	public function loginEmail($email,$password,$type=1){
		if (!$email) {
			return BaseFunctions::returnResult(false, array("ER00022","请填写邮箱"));
		}
		$sWhere = " `email` = '{$email}' and password = '{$password}' ";
		$sWhere .= $type>0?" and `type` = '{$type}'  ":"";
	$re =Yii::app()->objMySql->find($this->sMtable, $sWhere, true);
		if($re['type']){
			return BaseFunctions::returnResult(true, $re['msg'][0]);
		}else{
			return BaseFunctions::returnResult(false, array("ER00024","账户或密码错误"));
		}
	}
	
	public function loginPhone($phone,$password,$type=1){
		if (!$phone) {
			return BaseFunctions::returnResult(false, array("ER00023","请填写手机"));
		}
		$sWhere = " `iphone` = '{$phone}' and password = '{$password}' ";
		$sWhere .= $type>0?" and `type` = '{$type}'  ":"";
		$re =Yii::app()->objMySql->find($this->sMtable, $sWhere, true);
		if($re['type']){
			return BaseFunctions::returnResult(true, $re['msg'][0]);
		}else{
			return BaseFunctions::returnResult(false, array("ER00024","账户或密码错误"));
		}
	}
	
	/**
	 * 检测用户是否合法
	 * @param unknown $iUserid
	 */
	public function detection($iUserid){
		$oUser = $this->findById($iUserid);
		if (isset($oUser['msg'][0]['status'])&&$oUser['msg'][0]['status']>-1) {
			return $oUser['msg'][0];
		}
		return false;
	}
	
	/**
	 * 
	 * @param unknown $iUserId
	 * @param unknown $sUserName
	 * @param unknown $iSex
	 */
	public function updateBaseMsg($iUserId,$sUserName,$iSex){
		if (!$iUserId) {
			return BaseFunctions::returnResult(false, array('ER0001','用户不存在!'));
		}
		return $this->updateById($iUserId, array('username'=>$sUserName,'sex'=>$iSex));
	}
	
	public function updatePSW($iUserId,$sOPSW,$sNPSW){
		$aUser = $this->detection($iUserId);
		if(!$aUser){
			return BaseFunctions::returnResult(false, array('ER0001','用户不存在!'));
		}
		if ($aUser['password']!=$sOPSW) {
			return BaseFunctions::returnResult(false, array('ER0008','用户密码错误!'));
		}
		return $this->updateById($iUserId, array('password'=>$sNPSW));
	}
	
	public function updatePhone($iUserId,$sOphone,$sNphone,$scode){
		$aUser = $this->detection($iUserId);
		if(!$aUser){
			return BaseFunctions::returnResult(false, array('ER0001','用户不存在!'));
		}
		if ($aUser['password']!=$sOphone) {
			return BaseFunctions::returnResult(false, array('ER0009','用户手机错误!'));
		}
		return $this->updateById($iUserId, array('iphone'=>$sNphone));
	}
	
	public function updateTag($iUserId,$sTagName){
		$aUser = $this->detection($iUserId);
		if(!$aUser){
			return BaseFunctions::returnResult(false, array('ER0001','用户不存在!'));
		}
		return $this->updateById($iUserId, array('tag_list'=>$sTagName));
	}

	public function updateUserLogo($iId,$sStr){
		$aParam = array('logo' => $sStr, );
		return $this->updateById($Id,$aParam);
	}

	public function emailRegist($sEmail,$sPassWord){
		$sWhere = " `email` = '{$sEmail}' ";
		$re = Yii::app()->objMySql->find($this->sMtable, $sWhere, true);
		if ($re['type']) {
			return BaseFunctions::returnResult(false, array('ER0021','存在重复用户!'));
		}
		$aParam = array(
			'account_name' => $sEmail,
			'email' => $sEmail,
			'password'=>$sPassWord
		 );		
		return $this->add($aParam);
	}

	public function phoneRegist($sPhone,$sPassWord){
		$sWhere = " `iphone` = '{$sEmail}' ";
		$re = Yii::app()->objMySql->find($this->sMtable, $sWhere, true);
		if ($re['type']) {
			return BaseFunctions::returnResult(false, array('ER0021','存在重复用户!'));
		}
		$aParam = array(
			'account_name' => $sPhone,
			'iphone' => $sPhone,
			'password'=>$sPassWord
		 );		
		return $this->add($aParam);
	}
}

?>