<?php

class TakeOutController extends BaseController{
	public function actionTakeOutList(){
		//类型,分页列表
		$oTO = new TakeOut;
		$select = "*";
		$where = "1";
		$startPage=1;
		$pageNum=10;
		$group = "";
		$order = "";
		$arr = $oTO->pageGet($select, $where,$startPage, $pageNum,$group,$order);
		echo BaseFunctions::ouputToString($arr);
	}
	
	public function actionChangetSta(){
		$o = new TakeOutModel();
		$aData = json_decode($_REQUEST['d'],true);
		$iAddUser = isset($aData['user_id'])?$aData['user_id']:'';
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$sStatus = isset($aData['status'])?$aData['status']:'';
		$id = isset($aData['takeOutId'])?$aData['takeOutId']:'';
		$o->changeStatus($iAddUser,$id,$sStatus,$iMerchantId);
		BaseFunctions::outputResult(true, "修改成功");
	}
	
	public function actionUserTakeOutList(){
		$aData = json_decode($_REQUEST['d'],true);
		$iAddUser = isset($aData['user_id'])?$aData['user_id']:'0';
		$iType = isset($aData['type'])?$aData['type']:'';

		$pageVar = isset($aData['pageNum'])?$aData['pageNum']:1;
		$iCount = isset($aData['count'])?$aData['count']:1;
		$iPageNum = 10;
		$iCount = $iCount<1?1:$iCount;
		$pageVar= $pageVar<1?1:$pageVar;
		$pageVar = $iCount>1?1:$pageVar;
		$ilimit = $iPageNum * $iCount;
		
		//所有的列表
		$sDefoutCondition = " t.user_id = $iAddUser ";
		
		$criteria = new CDbCriteria();
		$criteria->with = array('merchantTOwer');
		$criteria->order = ' t.take_out_date DESC ';
		if ($iType==1) { 
			$criteria->condition = $sDefoutCondition.'  and ( t.status = 1 or t.status = 2) ';
		}else if ($iType==2) {
			$criteria->condition = $sDefoutCondition.' and t.status = 3  and t.common_id = 0 ';
		}else if ($iType==3) {
			$criteria->condition = $sDefoutCondition.' and ( t.status = 0 or t.status = 1 or t.status = 2 or t.status = 3 or t.status = 4) ';
		}else{
			$criteria->condition = $sDefoutCondition.'  and (t.status = 1 or t.status = 2) ';
		}
		$criteria->limit =$ilimit;
		
		$criteria->offset =$iPageNum*($pageVar-1);
		
		// $count = TakeOut::model()->count($criteria);
		
		$list = TakeOut::model()->findAll($criteria);
		
		$aRe = array();
		foreach ($list as $oo){
			$rRe = array();
			$rRe['id'] = $oo->id;
			$rRe['take_out_num'] = $oo->take_out_num;
			$rRe['user_id'] = $oo->user_id;
			$rRe['account_name'] = $oo->account_name;
			$rRe['user_name'] = $oo->user_name;
			$rRe['user_phone'] = $oo->user_phone;
			$rRe['order_num'] = $oo->order_num;
			$rRe['price_count'] = $oo->price_count;
			$rRe['take_num_count'] = $oo->take_num_count;
			$rRe['take_outcol'] = $oo->take_outcol;
			$rRe['take_time'] = $oo->take_time;
			$rRe['pro_time'] = $oo->pro_time;
			$rRe['out_time'] = $oo->out_time;
			$rRe['get_time'] = $oo->get_time;
			$rRe['merchant_id'] = $oo->merchant_id;
			$rRe['status'] = $oo->status;
			$rRe['add_time'] = $oo->add_time;
			$rRe['take_out_name'] = $oo->take_out_name;
			$rRe['take_out_type'] = $oo->take_out_type;
			$rRe['favorable_id'] = $oo->favorable_id;
			$rRe['pay_type'] = $oo->pay_type;
			$rRe['pay_status'] = $oo->pay_status;
			$rRe['add'] = $oo->add;
			$rRe['take_out_status'] = $oo->take_out_status;
			$rRe['super_need'] = $oo->super_need;
			$rRe['take_num'] = $oo->take_num;
			$rRe['take_out_date'] = $oo->take_out_date;
    		$rRe['take_out_time'] = $oo->take_out_time;
    		$rRe['take_out_phone'] = $oo->take_out_phone;
    		$rRe['common_id'] = $oo->common_id;
    		$rRe['order_id'] = $oo->order_id;

			$rRe['merchant_name'] = $oo->merchantTOwer->merchant_name?$oo->merchantTOwer->merchant_name:'';
			$aRe[] = $rRe;
		}
		BaseFunctions::ouputToString(array('records'=>$aRe));
		// BaseFunctions::outputResult(true, $aRe);
	}

	public function actionMoTakeOutList(){
		$aData = json_decode($_REQUEST['d'],true);
		$iAddUser = isset($aData['user_id'])?$aData['user_id']:'';
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$iType = isset($aData['type'])?$aData['type']:'';
		$dBookData = isset($aData['bookDate'])?$aData['bookDate']:"";
		
		$pageVar = isset($aData['pageNum'])?$aData['pageNum']:1;
		$iCount = isset($aData['count'])?$aData['count']:1;
		$iPageNum = 10;
		$iCount = $iCount<1?1:$iCount;
		$pageVar= $pageVar<1?1:$pageVar;
		$pageVar = $iCount>1?1:$pageVar;
		$ilimit = $iPageNum * $iCount;
		
		//所有的列表
		$sDefoutCondition = " merchant_id = $iMerchantId ";
		if ($dBookData) {
			$sDefoutCondition = $sDefoutCondition." and `take_out_date` = '$dBookData'  ";
		}
		$criteria = new CDbCriteria();
		
		$criteria->order = 'id DESC';
		if ($iType==1) {
			$criteria->condition = $sDefoutCondition.'  and (status = 1 or status = 2) ';
		}else if ($iType==2) {
			$criteria->condition = $sDefoutCondition.' and status = 0 ';
		}else if ($iType==3) {
			$criteria->condition = $sDefoutCondition.' and ( status = 3 or status = 4) ';
		}else{
			
		}
		$criteria->limit =$ilimit;
		
		$criteria->offset =$iPageNum*($pageVar-1);
		
		$count = TakeOutList::model()->count($criteria);
		
		$list = TakeOutList::model()->findAll($criteria);
		
		$aRe = array();
		foreach ($list as $oo){
			$rRe = array();
			$rRe['id'] = $oo->id;
			$rRe['take_out_num'] = $oo->take_out_num;
			$rRe['user_id'] = $oo->user_id;
			$rRe['account_name'] = $oo->account_name;
			$rRe['user_name'] = $oo->user_name;
			$rRe['user_phone'] = $oo->user_phone;
			$rRe['order_num'] = $oo->order_num;
			$rRe['price_count'] = $oo->price_count;
			$rRe['take_num_count'] = $oo->take_num_count;
			$rRe['take_outcol'] = $oo->take_outcol;
			$rRe['take_time'] = $oo->take_time;
			$rRe['pro_time'] = $oo->pro_time;
			$rRe['out_time'] = $oo->out_time;
			$rRe['get_time'] = $oo->get_time;
			$rRe['merchant_id'] = $oo->merchant_id;
			$rRe['status'] = $oo->status;
			$rRe['add_time'] = $oo->add_time;
			$rRe['take_out_name'] = $oo->take_out_name;
			$rRe['take_out_type'] = $oo->take_out_type;
			$rRe['favorable_id'] = $oo->favorable_id;
			$rRe['pay_type'] = $oo->pay_type;
			$rRe['pay_status'] = $oo->pay_status;
			$rRe['add'] = $oo->add;
			$rRe['take_out_status'] = $oo->take_out_status;
			$rRe['super_need'] = $oo->super_need;
			$rRe['take_num'] = $oo->take_num;
			$aRe[] = $rRe;
		}
		BaseFunctions::outputResult(true, $aRe);
	}
	
	public function actionGetTakeOut(){
		$aData = json_decode($_REQUEST['d'],true);
		$iAddUser = isset($aData['user_id'])?$aData['user_id']:'';
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$iTId = isset($aData['take_out_id'])?$aData['take_out_id']:'';
		$o = new TakeOutModel();
		$re = $o->findById($iTId);
		if (isset($re['msg'][0])) {
			BaseFunctions::outputResult(true, $re['msg'][0]);
		}else {
			BaseFunctions::outputResult(false, array());
		}
	}
	
	public function actionAddTakeOutCli(){
			$aData = json_decode($_REQUEST['d'],true);
		$iAddUserId = isset($aData['user_id'])?$aData['user_id']:'64';//用户id
		$iMerId  = isset($aData['merchant_id'])?$aData['merchant_id']:'1';//商家id
		$bookDate  = isset($aData['take_out_date'])?$aData['take_out_date']:'2015-05-28';//订单日期
		$bookTime = isset($aData['take_out_time'])?$aData['take_out_time']:'15:30';//订单时间
		$bookSeatType = isset($aData['book_seat_type'])?$aData['book_seat_type']:'';//是否4人座
		$bookName = isset($aData['take_out_name'])?$aData['take_out_name']:'李坤定';//订餐的用户的名字
		$bookPhone = isset($aData['take_out_phone'])?$aData['take_out_phone']:'13790022418';//订餐手机
		$bookDesc = isset($aData['take_out_desc'])?$aData['take_out_desc']:'';
		$bookMenArr = isset($aData['book_menu_arr'])?$aData['book_menu_arr']:array(
				array('id'=>94,'name'=>'聪哥叉烧饭1','pice'=>120),
				array('id'=>93,'name'=>'知斯蛋糕','pice'=>120),
				array('id'=>93,'name'=>'知斯蛋糕','pice'=>120),
		);
		$aCoupon = isset($aData['coupon_list'])?$aData['coupon_list']:array();
		$sAdd = isset($aData['add'])?$aData['add']:"";//送餐地址
		$o = new TakeOutModel();
		$re = $o->addTakeOutCli($iAddUserId,$iMerId,$sAdd,$bookDate,$bookTime,$bookSeatType,$bookName,$bookPhone,$bookDesc,$bookMenArr,$aCoupon);
		BaseFunctions::ouputToString($re);
	}
}