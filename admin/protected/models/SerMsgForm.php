<?php
class SerMsgForm extends CFormModel
{
	public $from_user_id;
	public $to_user_id;
	public $from_merchant_id;
	public $add_time;
	public $status;
	public $parent_id;
	public $first_id;
	public $from_user_name;
	public $to_name;
	public $content;
	public $get_time;
	public $reply_time;
	public $send_time;
	public $reply_content;
	public $detail_content;

	public function rules()
	{
		return array(
				array('content', 'required','message'=>'内容 不能为空'),
				array('detail_content','required','message'=>'详细内容 不能为空')
		);
	}
}
?>