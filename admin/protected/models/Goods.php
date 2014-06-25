<?php

/**
 * This is the model class for table "goods".
 *
 * The followings are the available columns in table 'goods':
 * @property integer $id
 * @property string $goods_id
 * @property string $goods_name
 * @property double $goods_pice
 * @property double $goods_real_pice
 * @property integer $goods_style
 * @property integer $goods_taste
 * @property double $goods_evaluation
 * @property string $goods_desc
 * @property string $goods_image
 * @property integer $goods_up_time
 * @property integer $goods_modify_time
 * @property integer $goods_comment_num
 * @property integer $goods_marketing_num
 * @property integer $goods_visit_times
 * @property integer $good_num
 * @property integer $share_times
 * @property integer $sound_times
 * @property integer $goods_remain
 * @property string $goods_image_list
 * @property integer $goods_over_time
 * @property integer $goods_type
 * @property double $goods_virtual_gold
 * @property double $goods_real_virtual_gold
 * @property string $goods_cat
 * @property string $goods_tag
 * @property string $goods_sounds
 * @property integer $recommend
 * @property integer $merchant_id
 * @property integer $status
 * @property string $goods_taste_tag
 * @property string $goods_sale_type
 * @property string $goods_correlate
 * @property integer $add_user_id
 * @property integer $goods_v_type
 * @property string $t_begin_time
 * @property string $t_end_time
 * @property integer $pri_time_per
 * @property string $pri_goods_list
 * @property integer $pri_goods_per
 * @property integer $vip_per
 * @property integer $per_type
 * @property integer $varil_begin_time
 * @property integer $varil_end_time
 * @property integer $add_time
 * @property string $goods_or_num
 * @property double $pri_money
 * @property string $pro_list
 * @property string $cou_list
 * @property integer $goods_share_num
 * @property integer $translate_type
 * @property integer $sendout_num
 * @property integer $use_num
 * @property integer $view_num
 * @property integer $translation_num
 * @property integer $be_good_num
 * @property integer $be_book_num
 */
class Goods extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'goods';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('goods_id, goods_visit_times, good_num, share_times, sound_times, status, goods_taste_tag, goods_sale_type, goods_correlate, add_user_id, goods_v_type, t_begin_time, t_end_time, pri_time_per, pri_goods_list, pri_goods_per, vip_per, per_type, varil_begin_time, varil_end_time, add_time, goods_or_num, pri_money, pro_list, cou_list, goods_share_num, translate_type, sendout_num, use_num, view_num, translation_num, be_good_num, be_book_num', 'required'),
			array('goods_style, goods_taste, goods_up_time, goods_modify_time, goods_comment_num, goods_marketing_num, goods_visit_times, good_num, share_times, sound_times, goods_remain, goods_over_time, goods_type, recommend, merchant_id, status, add_user_id, goods_v_type, pri_time_per, pri_goods_per, vip_per, per_type, varil_begin_time, varil_end_time, add_time, goods_share_num, translate_type, sendout_num, use_num, view_num, translation_num, be_good_num, be_book_num', 'numerical', 'integerOnly'=>true),
			array('goods_pice, goods_real_pice, goods_evaluation, goods_virtual_gold, goods_real_virtual_gold, pri_money', 'numerical'),
			array('goods_id, goods_name, goods_image', 'length', 'max'=>45),
			array('goods_cat, goods_tag, goods_sounds, goods_taste_tag, goods_sale_type, t_begin_time, t_end_time, pro_list, cou_list', 'length', 'max'=>255),
			array('goods_or_num', 'length', 'max'=>30),
			array('goods_desc, goods_image_list', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, goods_id, goods_name, goods_pice, goods_real_pice, goods_style, goods_taste, goods_evaluation, goods_desc, goods_image, goods_up_time, goods_modify_time, goods_comment_num, goods_marketing_num, goods_visit_times, good_num, share_times, sound_times, goods_remain, goods_image_list, goods_over_time, goods_type, goods_virtual_gold, goods_real_virtual_gold, goods_cat, goods_tag, goods_sounds, recommend, merchant_id, status, goods_taste_tag, goods_sale_type, goods_correlate, add_user_id, goods_v_type, t_begin_time, t_end_time, pri_time_per, pri_goods_list, pri_goods_per, vip_per, per_type, varil_begin_time, varil_end_time, add_time, goods_or_num, pri_money, pro_list, cou_list, goods_share_num, translate_type, sendout_num, use_num, view_num, translation_num, be_good_num, be_book_num', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'greensView'=>array(self::HAS_MANY, 'ViewLog', 'be_id','condition'=>'type = 1'),
				'greensOrder'=>array(self::HAS_MANY, 'Order', 'goods_id'),
				'Pros' => array(self::MANY_MANY, 'Goods', 'pro_goods(goods_id, pro_id)','condition'=>'goods_type = 2 and status <> -1'),
				'Greens' => array(self::MANY_MANY, 'Goods', 'pro_goods(goods_id, pro_id)','condition'=>'goods_type = 1 and status <> -1'),
				'Coups' => array(self::MANY_MANY, 'Goods', 'coupon_goods(goods_id, pro_id)','condition'=>'goods_type = 3 and status <> -1'),
				'greensViewNum'=>array(self::STAT, 'ViewLog', 'be_id','condition'=>'type = 1'),
				'proCount'=>array(self::STAT, 'Goods', 'pro_goods(goods_id,pro_id)','condition'=>' pro_goods.status <> -1 '),
				'coupCount'=>array(self::STAT, 'Goods', 'coupon_goods(goods_id,coupon_id)','condition'=>' coupon_goods.status <> -1 '),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'goods_id' => '货物的唯一标示key,不可以为空',
			'goods_name' => 'Goods Name',
			'goods_pice' => 'Goods Pice',
			'goods_real_pice' => 'Goods Real Pice',
			'goods_style' => 'Goods Style',
			'goods_taste' => 'Goods Taste',
			'goods_evaluation' => 'Goods Evaluation',
			'goods_desc' => 'Goods Desc',
			'goods_image' => '主图片 ',
			'goods_up_time' => 'Goods Up Time',
			'goods_modify_time' => 'Goods Modify Time',
			'goods_comment_num' => '被评论数目',
			'goods_marketing_num' => '总共销售数量',
			'goods_visit_times' => 'Goods Visit Times',
			'good_num' => 'Good Num',
			'share_times' => 'Share Times',
			'sound_times' => 'Sound Times',
			'goods_remain' => '货物剩余数量',
			'goods_image_list' => '支持多个图片',
			'goods_over_time' => '下架时间',
			'goods_type' => '货物类型',
			'goods_virtual_gold' => 'Goods Virtual Gold',
			'goods_real_virtual_gold' => 'Goods Real Virtual Gold',
			'goods_cat' => '分类',
			'goods_tag' => 'Goods Tag',
			'goods_sounds' => 'Goods Sounds',
			'recommend' => 'Recommend',
			'merchant_id' => 'Merchant',
			'status' => 'Status',
			'goods_taste_tag' => 'å£å‘³',
			'goods_sale_type' => 'è´©å–ç±»åž‹',
			'goods_correlate' => 'ç›¸å…³èœå¼',
			'add_user_id' => 'æ·»åŠ äººid',
			'goods_v_type' => 'ä¿ƒé”€ç±»åž‹',
			't_begin_time' => 'é™æ—¶ä¼˜æƒ å¼€å§‹æ—¶é—´',
			't_end_time' => 'é™æ—¶ä¼˜æƒ ç»“æŸæ—¶é—´',
			'pri_time_per' => 'ä¼˜æƒ çŽ‡',
			'pri_goods_list' => 'èœå“åˆ—è¡¨',
			'pri_goods_per' => 'ä¼˜æƒ ç»¿',
			'vip_per' => 'ä¼šå‘˜ä¼˜æƒ ',
			'per_type' => 'ä¿ƒé”€ç±»åž‹',
			'varil_begin_time' => 'ä¿ƒé”€ä¼˜æƒ å¼€å§‹æ—¶é—´',
			'varil_end_time' => 'ç»“æŸæ—¥æœŸ',
			'add_time' => 'æ·»åŠ çš„æ—¶é—´',
			'goods_or_num' => 'ç‰©å“æŽ’åˆ—å·ç ',
			'pri_money' => 'ä¼˜æƒ çš„é‡‘é¢',
			'pro_list' => '促销列表',
			'cou_list' => '优惠',
			'goods_share_num' => '给分享的次数',
			'translate_type' => 'Translate Type',
			'sendout_num' => '发放了的数量',
			'use_num' => '使用了的数量',
			'view_num' => '浏览次数',
			'translation_num' => '给翻译使用次数',
			'be_good_num' => '被点好次数',
			'be_book_num' => '被点次数',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('goods_id',$this->goods_id,true);
		$criteria->compare('goods_name',$this->goods_name,true);
		$criteria->compare('goods_pice',$this->goods_pice);
		$criteria->compare('goods_real_pice',$this->goods_real_pice);
		$criteria->compare('goods_style',$this->goods_style);
		$criteria->compare('goods_taste',$this->goods_taste);
		$criteria->compare('goods_evaluation',$this->goods_evaluation);
		$criteria->compare('goods_desc',$this->goods_desc,true);
		$criteria->compare('goods_image',$this->goods_image,true);
		$criteria->compare('goods_up_time',$this->goods_up_time);
		$criteria->compare('goods_modify_time',$this->goods_modify_time);
		$criteria->compare('goods_comment_num',$this->goods_comment_num);
		$criteria->compare('goods_marketing_num',$this->goods_marketing_num);
		$criteria->compare('goods_visit_times',$this->goods_visit_times);
		$criteria->compare('good_num',$this->good_num);
		$criteria->compare('share_times',$this->share_times);
		$criteria->compare('sound_times',$this->sound_times);
		$criteria->compare('goods_remain',$this->goods_remain);
		$criteria->compare('goods_image_list',$this->goods_image_list,true);
		$criteria->compare('goods_over_time',$this->goods_over_time);
		$criteria->compare('goods_type',$this->goods_type);
		$criteria->compare('goods_virtual_gold',$this->goods_virtual_gold);
		$criteria->compare('goods_real_virtual_gold',$this->goods_real_virtual_gold);
		$criteria->compare('goods_cat',$this->goods_cat,true);
		$criteria->compare('goods_tag',$this->goods_tag,true);
		$criteria->compare('goods_sounds',$this->goods_sounds,true);
		$criteria->compare('recommend',$this->recommend);
		$criteria->compare('merchant_id',$this->merchant_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('goods_taste_tag',$this->goods_taste_tag,true);
		$criteria->compare('goods_sale_type',$this->goods_sale_type,true);
		$criteria->compare('goods_correlate',$this->goods_correlate,true);
		$criteria->compare('add_user_id',$this->add_user_id);
		$criteria->compare('goods_v_type',$this->goods_v_type);
		$criteria->compare('t_begin_time',$this->t_begin_time,true);
		$criteria->compare('t_end_time',$this->t_end_time,true);
		$criteria->compare('pri_time_per',$this->pri_time_per);
		$criteria->compare('pri_goods_list',$this->pri_goods_list,true);
		$criteria->compare('pri_goods_per',$this->pri_goods_per);
		$criteria->compare('vip_per',$this->vip_per);
		$criteria->compare('per_type',$this->per_type);
		$criteria->compare('varil_begin_time',$this->varil_begin_time);
		$criteria->compare('varil_end_time',$this->varil_end_time);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('goods_or_num',$this->goods_or_num,true);
		$criteria->compare('pri_money',$this->pri_money);
		$criteria->compare('pro_list',$this->pro_list,true);
		$criteria->compare('cou_list',$this->cou_list,true);
		$criteria->compare('goods_share_num',$this->goods_share_num);
		$criteria->compare('translate_type',$this->translate_type);
		$criteria->compare('sendout_num',$this->sendout_num);
		$criteria->compare('use_num',$this->use_num);
		$criteria->compare('view_num',$this->view_num);
		$criteria->compare('translation_num',$this->translation_num);
		$criteria->compare('be_good_num',$this->be_good_num);
		$criteria->compare('be_book_num',$this->be_book_num);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Goods the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
