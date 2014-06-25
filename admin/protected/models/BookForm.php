<?php

/**
 * BookForm class.
 * BookForm is the data structure for keeping
 * BookFormdata.
 */
class BookForm extends CFormModel
{
	public $user_id;
	public $account_name;
	public $user_name;
	public $merchange_id;
	public $book_time;//预约时间
	public $book_desc;
	public $book_phone;//联系电话
	public $book_name;//联系人姓名
	public $book_num;//预约人数
	public $book_no;//获取到的预定号
	public $order_num;//关联订单号
	public $status;
	public $book_or_num;//获取到的预定流水号 eg:or201405100012
	public $reserve_time;
	public $reach_time;
	public $begin_time;
	public $over_time;
	public $book_type;//预约餐桌类型
	public $add_user_id;
	public $book_date;//预订日期
	public $book_sex;//预定人性别
	
	public function rules()
	{
		return array(
				array('book_date', 'required','message'=>'日期不能为空！'),
				array('book_time', 'required','message'=>'时间不能为空！'),
				array('book_name', 'required','message'=>'名字不能为空！'),
				array('book_sex', 'required','message'=>'性别不能为空！'),
				array('book_phone', 'required','message'=>'电话不能为空！'),
				array('book_num', 'required','message'=>'人数不能为空！'),
				array('book_type', 'required','message'=>'餐桌类型不能为空！'),
				array('book_phone',  'match', 'allowEmpty'=>true, 'pattern'=>'/^([1]{1}[0-9]{10})$/','message'=>'联系方式必须为手机号码'),
				array('book_num',  'match', 'allowEmpty'=>true, 'pattern'=>'/^([1-9]{1}[0-9]?)$/','message'=>'人数必须为数字'),
		);
	}

}
