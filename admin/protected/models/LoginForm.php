<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username', 'required','message'=>'用户名不能为空！'),
			array('password', 'required','message'=>'密码不能为空！'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
			BaseFunctions::writeLog("error temp");
		if(!$this->hasErrors())
		{
			BaseFunctions::writeLog("error temp 1111111111");
			$this->_identity=new UserIdentity($this->username,$this->password);
			BaseFunctions::writeLog("error temp 222222222222222222222");
			if(!$this->_identity->authenticate()){
				BaseFunctions::writeLog("error temp 222");
				$this->addError('password','用户名或密码错误.');
			}
		}
			BaseFunctions::writeLog("out temp");
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
			BaseFunctions::writeLog("pujie---------------------->");
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			Yii::app()->user->login($this->_identity,3600*24);
			return true;
		}
		else
			return false;
	}
}
