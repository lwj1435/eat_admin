<?php
class Customer extends BaseModel{
	private $sTableKey;
	public function __construct(){
		$sTableKey = "customer_msg";
		parent::__construct($sTableKey);
	}
	
	public function getTableKey(){
		return $this->sTableKey;
	}
	
	public function getCustomer($iCid,$iMerId){
		$re = $this->findById($iCid);
		/*
		 * 	绑定手机： 	13800138000
			绑定邮箱： 	l188707758@126.com
			常用联系人： 	李先生
			
			个性标签： 	粤菜 爱辣 IT男 多喝汤 多喝汤 多喝汤 多喝汤
			最后上线时间： 	2014-04-30 18:00
			最后定位地址： 	广州市天河区体育西路189号城建大厦
			
		 */
		if(!$re['type']||!isset($re['msg'][0]['id'])){
			return BaseFunctions::returnResult(false, "没有该记录");
		}
		$aRe = array();
		if ($re['msg'][0]['user_id']) {
			$o = new UserModel();
			$useObj = $o->findById($re['msg'][0]['user_id']);
			if (!$useObj['type']||!isset($useObj['msg'][0]['id'])) {
				return BaseFunctions::returnResult(false, "记录异常");
			}
			$sSex = ($useObj['msg'][0]['sex']==1)?"男士":"女士";
			$aRe['phone'] = $useObj['msg'][0]['iphone'];
			$aRe['email'] = $useObj['msg'][0]['email'];
			$aRe['username'] = $useObj['msg'][0]['username'].$sSex;
			$aRe['add'] = "";
			$aRe['tag'] = "";
			$aRe['last_login_time'] = $useObj['msg'][0]['last_login_time'];
			$aRe['com_add'] = "";
			$aRe['user_id'] = $re['msg'][0]['user_id'];
		}else{
			$aRe['phone'] = "";
			$aRe['email'] = "";
			$aRe['username'] = $re['msg'][0]['c_name'];
			$aRe['add'] = "";
			$aRe['tag'] = "";
			$aRe['last_login_time'] = "";
			$aRe['com_add'] = "";
			$aRe['username'] = $re['msg'][0]['c_name'];
			$aRe['user_id'] = "";
		}
		//常用联系方式： 	13800138000
		//常用地址： 	广州市天河区燕岭路244号503
		//是否关注商家：
// 		最后预订时间： 	2014-04-30 18:00
// 		最后外卖时间： 	无
// 		最后点评时间： 	2014-04-30 18:00
// 		最后获取优惠卷时间： 	2014-04-30 18:00
// 		最后浏览餐厅信息时间：
		$aRe['nor_add'] = "";
		$aRe['nor_name'] = $re['msg'][0]['c_name'];
		$aRe['nor_phone'] = $re['msg'][0]['phone'];//SELECT COUNT(*) FROM `goods_detail` `t` WHERE user_id = 63
		$aRe['last_book_time'] = isset($re['msg'][0]['last_book_time'])?$re['msg'][0]['last_book_time']:0;
		$aRe['last_take_out_time'] = isset($re['msg'][0]['last_take_out_time'])?$re['msg'][0]['last_take_out_time']:0;
		$aRe['last_comment_time'] = isset($re['msg'][0]['last_comment_time'])?$re['msg'][0]['last_comment_time']:0;
		$aRe['last_coupon_time'] = isset($re['msg'][0]['last_coupon_time'])?$re['msg'][0]['last_coupon_time']:0;
		$aRe['last_brow_time'] = isset($re['msg'][0]['last_brow_time'])?$re['msg'][0]['last_brow_time']:0;
		$aRe['view_num'] = isset($re['msg'][0]['view_num'])?$re['msg'][0]['view_num']:"";
		$aRe['coupon_num'] = isset($re['msg'][0]['coupon_num'])?$re['msg'][0]['coupon_num']:"";
		$aRe['comment_num'] = isset($re['msg'][0]['comment_num'])?$re['msg'][0]['comment_num']:"";
		$aRe['share_num'] = isset($re['msg'][0]['share_num'])?$re['msg'][0]['share_num']:"";
		$aRe['like'] = "";
		return BaseFunctions::returnResult(true, $aRe);
	}
	
} 