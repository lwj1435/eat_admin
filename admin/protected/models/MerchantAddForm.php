<?php
class MerchantAddForm extends CFormModel
{
	public $merchant_name;
	public $merchant_othername;
	public $merchant_manager;
	public $merchant_manager_phone;
	public $merchant_logo;
	
	public $merchant_start_time;
	public $merchant_end_time;
	public $merchant_ser;
	public $merchant_tag;
	public $merchant_call;
	
	public $merchant_phone;
	public $address;
	public $pro;
	public $city;
	public $area;
	
	public $merchant_per;
	public $merchant_traffic;
	public $free_service;
	public $merchant_desc;
	
	public $longitude;
	public $latitude;
	
	public function rules()
	{
		return array(
				array('merchant_name', 'required','message'=>'商店名称不能为空！'),
				array('merchant_manager_phone', 'match', 'allowEmpty'=>true, 'pattern'=>'/^[\d]{11}$/','message'=>'店长电话号码必须为11位手机号码'),
				array('merchant_call', 'match', 'allowEmpty'=>true, 'pattern'=>'/^[\d-\s]*$/','message'=>'商铺电话必须为电话号码'),
				array('merchant_phone', 'match', 'allowEmpty'=>true, 'pattern'=>'/^[\d]{11}$/i','message'=>'绑定手机必须为11位手机号码'),
				array('merchant_per', 'match', 'allowEmpty'=>true, 'pattern'=>'/^[1-9]\d*\.\d*|[1-9]\d*$/','message'=>'商铺平均金额必须为金额数字'),
		);
	}
}
?>