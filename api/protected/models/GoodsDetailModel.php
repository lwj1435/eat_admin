<?php
class GoodsDetailModel extends BaseModel{
	private $sTableKey;
	public function __construct(){
		$sTableKey = "goods_detail";
		parent::__construct($sTableKey);
	}
	
	public function addGoodsDetail($aData){
		//TODO这里要做重复panduam
		$aParam = array();
		$aParam['goods_at_num'] = $this->getGoodsNum();
		$aParam['parent_id'] = $aData['parent_id']?$aData['parent_id']:'';
		$aParam['user_id'] = $aData['user_id']?$aData['user_id']:'';
		$aParam['user_name'] = $aData['user_name']?$aData['user_name']:'';
		$aParam['customer_id'] = $aData['customer_id']?$aData['customer_id']:'';
		$aParam['get_time'] = $aData['get_time']?$aData['get_time']:'';
		$aParam['status'] = $aData['status']?$aData['status']:'';
		$aParam['user_time'] = $aData['user_time']?$aData['user_time']:'';
		$aParam['goods_name'] = $aData['goods_name']?$aData['goods_name']:'';
		$aParam['type'] = $aData['type']?$aData['type']:'';
		$aParam['merchant_id'] = $aData['merchant_id']?$aData['merchant_id']:'';
// 		BaseFunctions::writeLog(json_encode($aParam));
		$this->add($aParam,true);
		//$result = Yii::app()->objMySql->add("goods_detail",$aParam,true);
	}
	
	private function getGoodsNum(){
		$sRe = "";
		$s = "1234567890qwertyuiopasdfghjklzxcvbnm";
		for ($i = 0;$i<20;$i++){
			$aTemp = rand(1,35);
			$sRe .= substr($s,$aTemp,1);
		}
		return $sRe;
	}
	
	public function userGoodsDetail($str,$merchant_id){
		//
		$iNow = time();
		$sFind = "*";
		$sWhere = " goods_at_num = '{$str}' and merchant_id = '{$merchant_id}' ";
		$sFind =  Yii::app()->objMySql->findDetail("goods_detail",$sWhere,$sFind,true);
		if (!$sFind['type']||!isset($sFind['msg'][0])||$sFind['msg'][0]['status']==-1) {
			return BaseFunctions::returnResult(false, "无效");
		}
		if (!$sFind['msg'][0]['user_id']) {
			return BaseFunctions::returnResult(false, "不明优惠劵");
		}
		if ($sFind['msg'][0]['status']==3) {
			return BaseFunctions::returnResult(false, "已使用");
		}
		//过期判断 父判断
		$oGood = new GoodsModel();
		$aGood = $oGood->findById($sFind['msg'][0]['parent_id']);
		if(!$aGood['type']||!isset($aGood['msg'][0])||$aGood['msg'][0]['goods_type']!=3){
			return BaseFunctions::returnResult(false, "无   效");
		}
		if($aGood['msg'][0]['status']==-1){
			return BaseFunctions::returnResult(false, "已删除");
		}
		if($aGood['msg'][0]['status']==2){
			return BaseFunctions::returnResult(false, "已过期");
		}
		//短期促销
		if ($sFind['msg'][0]['per_type']==2&&($iNow<$sFind['msg'][0]['varil_begin_time']||$iNow>$sFind['msg'][0]['varil_end_time'])) {
			
			return BaseFunctions::returnResult(false, "不在使用的有效期内");
		}
		
		//判断是否有订单关联，
		$sData = date("Y-m-d");
		//$sql = "select * from book where (cou_list like '%,{$sFind['msg'][0]['parent_id']},%' or pro_list like '%,{$sFind['msg'][0]['parent_id']},%' ) and merchange_id = {$merchant_id} ";
		//$isBook =  Yii::app()->objMySql->findDetail("book"," (cou_list like '%,{$sFind['msg'][0]['parent_id']},%' or pro_list like '%,{$sFind['msg'][0]['parent_id']},%' ) and merchange_id = {$merchant_id} ","*",true);
		$isBook =  Yii::app()->objMySql->findDetail("book"," user_id = {$sFind['msg'][0]['user_id']} and book_date = '{$sData}' and merchange_id = {$merchant_id} ","*",true);
		//有注销
		if ($isBook['type']&&isset($isBook['msg'][0])) {
			$o = new Book();
			$o->updateById($isBook['msg'][0]['id'], array('cou_list'=>",{$sFind['msg'][0]['parent_id']},"),true);
			$this->updateById($sFind['msg'][0]['id'], array('status'=>3,'user_time'=>time()),true);
			$aGood['msg'][0]['use_num']=$aGood['msg'][0]['use_num']?$aGood['msg'][0]['use_num']:0;
			$aGood['msg'][0]['use_num'] += 1;
			$oGood->updateById($sFind['msg'][0]['parent_id'], array('use_num'=>$aGood['msg'][0]['use_num']),true);
			return BaseFunctions::returnResult(true, "使用成功");
		}else{
			return BaseFunctions::returnResult(false, "该用户今天没有任何订座订单");
		}
		/*
		//没有插入订单
		$o = new Book();
		$iAddId = $o->add(array('pro_list'=>",{$sFind['msg'][0]['parent_id']},"));
		//更新订单状态
		$this->updateById($sFind['msg'][0]['id'], array('status'=>3,'user_time'=>time()));
		$useNum = $aGood['msg'][0]['id']['use_num']?$aGood['msg'][0]['id']['use_num']:0;
		$useNum++;
		$aGood->updateById($aGood['msg'][0]['id'],array('use_num'=>$useNum));
		*/
		
	}
	
	/**
	 * 
	 * @param unknown $str
	 * @param string $iMer merchant_id 如果传递那么就要查找供应商的id
	 */
	public function getCoupMsg($str,$iMer=""){
		$sWhere = " goods_at_num = '{$str}'  ";
		$sWhere .= $iMer?" and coupon.merchant_id = {$iMer}":" ";
		$aAllCoup = $this->yiiPageWithJoin("GoodsDetailList", "coupon", "*",$sWhere);
		$aRe = array();
		foreach ($aAllCoup as $o){
			$aRe['id'] = $o->id;
			$aRe['goods_at_num'] = $o->goods_at_num;
			$aRe['parent_id'] = $o->parent_id;
			$aRe['user_id'] = $o->user_id;
			$aRe['user_name'] = $o->user_name;
			$aRe['customer_id'] = $o->customer_id;
			$aRe['get_time'] = $o->get_time;
			$aRe['status'] = $o->status;
			$aRe['user_time'] = $o->user_time;
			$aRe['goods_name'] = $o->goods_name;
			$aRe['type'] = $o->type;
			$aRe['merchant_id'] = $o->merchant_id;
			$aRe['get_type'] = $o->get_type;
			$aRe['order_type'] = $o->order_type;
			$aRe['order_num'] = $o->order_num;
			$aRe['order_id'] = $o->order_id;
			
			$aReParnt = array();
			$aReParnt['id'] = $o->coupon->id;
			$aReParnt['goods_id'] = $o->coupon->goods_id;
			$aReParnt['goods_name'] = $o->coupon->goods_name;
			$aReParnt['goods_pice'] = $o->coupon->goods_pice;
			$aReParnt['goods_real_pice'] = $o->coupon->goods_real_pice;
			$aReParnt['goods_style'] = $o->coupon->goods_style;
			$aReParnt['goods_taste'] = $o->coupon->goods_taste;
			$aReParnt['goods_evaluation'] = $o->coupon->goods_evaluation;
			$aReParnt['goods_desc'] = $o->coupon->goods_desc;
			$aReParnt['goods_image'] = $o->coupon->goods_image;
			$aReParnt['goods_up_time'] = $o->coupon->goods_up_time;
			$aReParnt['goods_modify_time'] = $o->coupon->goods_modify_time;
			$aReParnt['goods_comment_num'] = $o->coupon->goods_comment_num;
			$aReParnt['goods_marketing_num'] = $o->coupon->goods_marketing_num;
			$aReParnt['goods_visit_times'] = $o->coupon->goods_visit_times;
			$aReParnt['good_num'] = $o->coupon->good_num;
			$aReParnt['share_times'] = $o->coupon->share_times;
			$aReParnt['sound_times'] = $o->coupon->sound_times;
			$aReParnt['goods_remain'] = $o->coupon->goods_remain;
			$aReParnt['goods_image_list'] = $o->coupon->goods_image_list;
			$aReParnt['goods_over_time'] = $o->coupon->goods_over_time;
			$aReParnt['goods_type'] = $o->coupon->goods_type;
			$aReParnt['goods_virtual_gold'] = $o->coupon->goods_virtual_gold;
			$aReParnt['goods_real_virtual_gold'] = $o->coupon->goods_real_virtual_gold;
			$aReParnt['goods_cat'] = $o->coupon->goods_cat;
			$aReParnt['goods_tag'] = $o->coupon->goods_tag;
			$aReParnt['goods_sounds'] = $o->coupon->goods_sounds;
			$aReParnt['recommend'] = $o->coupon->recommend;
			$aReParnt['merchant_id'] = $o->coupon->merchant_id;
			$aReParnt['status'] = $o->coupon->status;
			$aReParnt['goods_taste_tag'] = $o->coupon->goods_taste_tag;
			$aReParnt['goods_sale_type'] = $o->coupon->goods_sale_type;
			$aReParnt['goods_correlate'] = $o->coupon->goods_correlate;
			$aReParnt['add_user_id'] = $o->coupon->add_user_id;
			$aReParnt['goods_v_type'] = $o->coupon->goods_v_type;
			$aReParnt['t_begin_time'] = $o->coupon->t_begin_time;
			$aReParnt['t_end_time'] = $o->coupon->t_end_time;
			$aReParnt['pri_time_per'] = $o->coupon->pri_time_per;
			$aReParnt['pri_goods_list'] = $o->coupon->pri_goods_list;
			$aReParnt['pri_goods_per'] = $o->coupon->pri_goods_per;
			$aReParnt['vip_per'] = $o->coupon->vip_per;
			$aReParnt['per_type'] = $o->coupon->per_type;
			$aReParnt['varil_begin_time'] = $o->coupon->varil_begin_time;
			$aReParnt['varil_end_time'] = $o->coupon->varil_end_time;
			$aReParnt['add_time'] = $o->coupon->add_time;
			$aReParnt['goods_or_num'] = $o->coupon->goods_or_num;
			$aReParnt['pri_money'] = $o->coupon->pri_money;
			$aReParnt['pro_list'] = $o->coupon->pro_list;
			$aReParnt['cou_list'] = $o->coupon->cou_list;
			$aReParnt['goods_share_num'] = $o->coupon->goods_share_num;
			$aReParnt['translate_type'] = $o->coupon->translate_type;
			$aReParnt['sendout_num'] = $o->coupon->sendout_num;
			$aReParnt['use_num'] = $o->coupon->use_num;
			$aReParnt['view_num'] = $o->coupon->view_num;
			$aReParnt['translation_num'] = $o->coupon->translation_num;
			$aReParnt['be_good_num'] = $o->coupon->be_good_num;
			$aReParnt['be_book_num'] = $o->coupon->be_book_num;
			$aRe['parent_arr'] = $aReParnt;
		}
		return $aRe;
	}
}