<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class MerchantInfoForm extends CFormModel
{
	public $merchant_name;
	public $merchant_branch;
	public $merchant_alias;
	public $merchant_service;

	public function rules()
	{
		return array(
			array('merchant_name', 'required','message'=>'商店名称不能为空！'),
			array('merchant_service', 'required','message'=>'请选择服务内容！')
		);
	}

}
