<?php
class PromotionFrom extends CFormModel
{
	public $goods_name;
	public $goods_v_type;
	public $t_begin_time;
	public $t_end_time;
	public $pri_time_per;
	
	public $pri_goods_list;
	public $pri_goods_per;
	public $vip_per;
	public $per_type;
	public $varil_begin_time;
	
	public $varil_end_time;
	public $goods_desc;
	public $goods_comment_num;
	public $goods_visit_times;
	public $goods_share_num;
	
	public function rules()
	{
		return array(
// 				array('merchant_name', 'required','message'=>'商店名称不能为空！')
				array('goods_name', 'required','message'=>'促销名称不能为空！'),
				array('pri_goods_per',  'match', 'allowEmpty'=>true, 'pattern'=>'/^([1-9]{1}([0-9]{1})?)|0$/','message'=>'优惠率必须为数字'),
				array('pri_goods_per', 'length', 'max'=>2,'message'=>'优惠率最高99'),
				array('vip_per',  'match', 'allowEmpty'=>true, 'pattern'=>'/^([1-9]{1}([0-9]{1})?)|0$/','message'=>'会员优惠率必须为数字'),
				array('vip_per', 'length', 'max'=>2,'message'=>'会员优惠率最高99'),
				array('pri_time_per',  'match', 'allowEmpty'=>true, 'pattern'=>'/^([1-9]{1}([0-9]{1})?)|0$/','message'=>'限时优惠率必须为数字'),
				array('pri_time_per', 'length', 'max'=>2,'message'=>'限时会员优惠率最高99'),
				
		);
	}
}