<?php
/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class StoreAddForm extends CFormModel
{
	/*
	 * 坐席编号
坐席类型
状态
坐席区域
	 */
	
	public $merchant_id;
	public $seat_type;
	public $min_num;
	public $max_num;
	public $status;
	public $desc;
	public $at_area;
	public $seat_num;
	
	public function rules()
	{
		return array(
				array('seat_type', 'required','message'=>'座位类型不能空！'),
				array('status', 'required','message'=>'座位状态不能为空！'),
				array('at_area', 'required','message'=>'座位区域不能为空！'),
				array('seat_num', 'required','message'=>'座位编号不能为空！'),
				array('seat_num',  'match', 'allowEmpty'=>false, 'pattern'=>'/^[\da-zA-Z]{3}$/','message'=>'座位编号必须要为3位的数字和字母的组合'),
		);
	}
}