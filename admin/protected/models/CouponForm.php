<?php
/**
 * BookForm class.
 * BookForm is the data structure for keeping
 * BookFormdata.
 */
class CouponForm extends CFormModel{

	public $goods_name;//优惠劵名称
	public $goods_v_type;//优惠劵类型
	public $pri_money;//代金金额
	public $pri_goods_per;//优惠折扣
	public $pri_goods_list;//兑换菜品
	public $good_num;//发放数量
	public $per_type;//促销类型
	public $varil_begin_time;//开始日期
	public $varil_end_time;//结束日期
	public $goods_desc;//物品的描述
	
	public function rules()
	{
		return array(
				array('goods_name', 'required','message'=>'优惠劵名称不能为空！'),
// 				array('pri_goods_per', 'length', 'max'=>2,'message'=>'优惠折扣必须为99内的数字'),
				array('pri_money',  'match', 'allowEmpty'=>true, 'pattern'=>'/^((([1-9]\d*)|0)\.\d*|(([1-9]\d*)|0))$/','message'=>'代金卷必须为数字'),
				array('pri_goods_per',  'match', 'allowEmpty'=>true, 'pattern'=>'/^([1-9]{1}([0-9]{1})?)|0$/','message'=>'优惠折扣必须为数字'),
				array('good_num',  'match', 'allowEmpty'=>false, 'pattern'=>'/^([1-9]+([0-9]*)?)|0$/','message'=>'发放数量必须为数字'),
				array('varil_begin_time', 'required','message'=>'优惠劵开始日期不能为空！'),
				array('varil_end_time', 'required','message'=>'优惠劵结束日期不能为空！'),
				array('goods_desc', 'required','message'=>'描述不能为空！'),
		);
	}
	
	
}
?>