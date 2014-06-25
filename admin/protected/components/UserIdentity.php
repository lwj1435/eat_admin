<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	
	private $_id;
	private $key;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$result = HttpClient("/site/adminlogin", array('username'=>$this->username,'password'=>$this->password,'ip'=>Yii::app()->getRequest()->userHostAddress));


		if($result['errorCode'])
		{
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
			return !$this->errorCode;
		}
		$this->_id = $result['uid'];
//		$this->username = $result['username'];
		Yii::app()->cache->set('username_'.$this->_id, $result['username'], 3600*24);
		Yii::app()->cache->set('mkey_'.$this->_id, $result['key'], 3600*24);
		$dataModel = new DataModelClass();
		$dataModel->skey = 'merchant';
		
// 		$result = $dataModel->find('merchant_msg', "`user_id` = '{$this->_id}'");
		
		Yii::app()->cache->set('merchant_'.$this->_id, $result['merchantId'], 3600*24);

//		$this->setState('key',$result['key']);

		$this->errorCode=self::ERROR_NONE;

		return !$this->errorCode;
	}
	
	public function getId()  
    {  
        return $this->_id;  
    }  
}