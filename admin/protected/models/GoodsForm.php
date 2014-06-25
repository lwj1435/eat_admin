<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class GoodsForm extends CFormModel
{
	public $goods_name;
	public $goods_pice;
	public $status;
	public $goods_tag;
	public $goods_taste_tag;
	
	public $goods_sale_type;
	public $goods_desc;
	public $goods_image_list;
	public $goods_image;
	public $goods_sounds;
	public $recommend;

	public $goods_real_pice;
	public $goods_correlate;
	public $pri_goods_list;
	public $translate_type;
	
	public function rules()
	{
		return array(
			array('goods_name', 'required','message'=>'菜品名称不能为空！'),
			array('goods_tag', 'required','message'=>'菜品类型不能为空！'),
			array('goods_taste_tag', 'required','message'=>'菜品口味不能为空！'),
			array('goods_pice', 'match', 'allowEmpty'=>false, 'pattern'=>'/^[0-9]+(.[0-9]{1,2})?$/','message'=>'菜品销售价格为金额数字'),
			array('translate_type', 'required','message'=>'发音类型不能为空！'),
			array('status', 'required','message'=>'菜品售卖状态不能为空！'),
			array('goods_sale_type', 'required','message'=>'售卖方式不能为空！'),
			array('goods_image', 'match', 'allowEmpty'=>false, 'pattern'=>'/^.*[^a][^b][^c]\.(?:png|jpg|bmp|gif|jpeg)$/i','message'=>'图片要是png jpg bmp gif jpeg的其中一种'),
			//array('translate_type', 'required','message'=>'发音类型不能为空！'),
		);
	}
	
}
