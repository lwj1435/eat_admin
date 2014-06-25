<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class PromotionsForm extends CFormModel
{
	public $promotion_name;
	public $promotion_type;
	public $promotion_introduce;
	public $discount;
	public $promotion_start_time;
	public $promotion_end_time;
	public $promotion_goods_id;
	public $promotion_goods_name;
	public $merchant_id;
	public $add_time;
	public $add_user_id;

	public function rules()
	{
		return array(
			array('promotion_name', 'required','message'=>'促销名不能为空'),
			array('promotion_type', 'required','message'=>'促销类型不能为空'),
			array('discount', 'numerical', 'min'=>1, 'max'=>10,'message'=>'折扣只能1-10折'),
			array('promotion_start_time', 'required','message'=>'促销类型开始时间'),
			array('promotion_end_time', 'required','message'=>'促销类型结束时间')
		);
	}

}
