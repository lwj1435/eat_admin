<?php

class CustomerMsgController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	
	public function actionCustomerMsgList(){
		$aData = json_decode($_REQUEST['d'],true);
		$iUserId = isset($aData['user_id'])?$aData['user_id'] : '';
		$merchant_id = isset($aData['merchant_id'])?$aData['merchant_id'] : '';
		

		$pageVar = isset($aData['pageNum'])?$aData['pageNum']:1;
		$iCount = isset($aData['count'])?$aData['count']:1;
		$iPageNum = 10;
		$iCount = $iCount<1?1:$iCount;
		$pageVar= $pageVar<1?1:$pageVar;
		$pageVar = $iCount>1?1:$pageVar;
		$ilimit = $iPageNum * $iCount;
		
		$criteria = new CDbCriteria();
		
		$criteria->order = 'id DESC';
		
		$criteria->condition = ' `mrchant_id` =  '.$merchant_id;

		$criteria->limit =$ilimit;
		
		$criteria->offset =$iPageNum*($pageVar-1);
		
		
		$list = CustomerMsg::model()->findAll($criteria);
		$aReAll = array();
		foreach ($list as $i => $o){
			$aRe = array();
			//$aTempArr[] = $o->c_name;
			$aRe['id'] = $o->id;
			$aRe['mrchant_id'] = $o->mrchant_id;
			$aRe['c_name'] = $o->c_name;
			$aRe['book_num'] = $o->book_num;
			$aRe['take_out_num'] = $o->take_out_num;
			$aRe['coupon_num'] = $o->coupon_num;
			$aRe['comment_num'] = $o->comment_num;
			$aRe['source_type'] = $o->source_type;
			$aRe['user_id'] = $o->user_id;
			$aRe['status'] = $o->status;
			$aRe['phone'] = $o->phone;
			$aReAll[]=$aRe;
		}
		//$uResult = array('records' => $aReAll, 'totalPage' => $pages->pageCount, 'totalNum'=>$count, 'pageNum' => $pages->pageSize );
		BaseFunctions::outputResult(true, $aReAll);
	}
	
	public function actionGetCus(){
		BaseFunctions::writeLog(json_encode($_REQUEST));
		$aData = json_decode($_REQUEST['d'],true);
		$iCusId = isset($aData['cus_id'])?$aData['cus_id'] : '';
		//$iCusId = isset($_REQUEST['cus_id'])?$_REQUEST['cus_id'] : '';
		$iUserId = isset($aData['user_id'])?$aData['user_id'] : '';
		$merchant_id = isset($aData['merchant_id'])?$aData['merchant_id'] : '';
		$o = new Customer();
		BaseFunctions::ouputToString($o->getCustomer($iCusId, $merchant_id));
	}
	
	public function actionCusBookList(){
		$aData = json_decode($_REQUEST['d'],true);
		$iCusId = isset($aData['cus_id'])?$aData['cus_id'] : '';
		//$iCusId = isset($_REQUEST['cus_id'])?$_REQUEST['cus_id'] : '';
		$iUserId = isset($aData['user_id'])?$aData['user_id'] : '';
		$merchant_id = isset($aData['merchant_id'])?$aData['merchant_id'] : '';
		
		$sDefoutCondition = " merchange_id = '$merchant_id' and customer_id = {$iCusId} ";
		//所有的已确认的订单
		$criteria = new CDbCriteria();
		
		$criteria->order = ' id DESC ';
		
		$criteria->condition = $sDefoutCondition.'  ';
		
		$count = BookList::model()->count($criteria);
		
		$bookpages = new CPagination($count);
		
		$bookpages->pageSize = 10;
		
		$bookpages->applyLimit($criteria);
		
		$bookList = BookList::model()->findAll($criteria);
		$aRe = array();
		foreach ($bookList as $oo){
			$rRe['id'] = isset($oo->id)?$oo->id:'';
			$rRe['user_id'] = isset($oo->user_id)?$oo->user_id:'';
			$rRe['account_name'] = isset($oo->account_name)?$oo->account_name:'';
			$rRe['user_name'] = isset($oo->user_name)?$oo->user_name:'';
			$rRe['merchange_id'] = isset($oo->merchange_id)?$oo->merchange_id:'';
			$rRe['book_time'] = isset($oo->book_time)?$oo->book_time:'';
			$rRe['book_desc'] = isset($oo->book_desc)?$oo->book_desc:'';
			$rRe['book_phone'] = isset($oo->book_phone)?$oo->book_phone:'';
			$rRe['book_name'] = isset($oo->book_name)?$oo->book_name:'';
			$rRe['book_num'] = isset($oo->book_num)?$oo->book_num:'';
			$rRe['book_no'] = isset($oo->book_no)?$oo->book_no:'';
			$rRe['order_num'] = isset($oo->order_num)?$oo->order_num:'';
			$rRe['status'] = isset($oo->status)?$oo->status:'';
			$rRe['book_or_num'] = isset($oo->book_or_num)?$oo->book_or_num:'';
			$rRe['reserve_time'] = isset($oo->reserve_time)?$oo->reserve_time:'';
			$rRe['reach_time'] = isset($oo->reach_time)?$oo->reach_time:'';
			$rRe['begin_time'] = isset($oo->begin_time)?$oo->begin_time:'';
			$rRe['over_time'] = isset($oo->over_time)?$oo->over_time:'';
			$rRe['book_type'] = isset($oo->book_type)?$oo->book_type:'';
			$rRe['add_user_id'] = isset($oo->add_user_id)?$oo->add_user_id:'';
			$rRe['book_date'] = isset($oo->book_date)?$oo->book_date:'';
			$rRe['book_sex'] = isset($oo->book_sex)?$oo->book_sex:'';
			$rRe['commit_time'] = isset($oo->commit_time)?$oo->commit_time:'';
			$rRe['add_time'] = isset($oo->add_time)?$oo->add_time:'';
			$rRe['book_seat_type'] = isset($oo->book_seat_type)?$oo->book_seat_type:'';
			$rRe['book_seat_num'] = isset($oo->book_seat_num)?$oo->book_seat_num:'';
			$rRe['book_source_type'] = isset($oo->book_source_type)?$oo->book_source_type:'';
			$rRe['book_seat_id'] = isset($oo->book_seat_id)?$oo->book_seat_id:'';
			$aRe[] = $rRe;
		}
		BaseFunctions::ouputToString(array('records'=>$aRe));
	}
	
	public function actionBookList(){
		$aData = json_decode($_REQUEST['d'],true);
		$iUserId = isset($aData['user_id'])?$aData['user_id'] : '';
		$merchant_id = isset($aData['merchant_id'])?$aData['merchant_id'] : '';
		$cusId = isset($aData['id'])?$aData['id']:'0';
		//客户预约历史记录
		$sDefoutCondition = " merchange_id = '$merchant_id' and customer_id = {$cusId} ";
		//所有的已确认的订单
		$criteria = new CDbCriteria();
		
		$criteria->order = ' id DESC ';
		
		$criteria->condition = $sDefoutCondition.'  ';
		
		$count = BookList::model()->count($criteria);
		
		$bookList = BookList::model()->findAll($criteria);
		$aReAll = array();
		foreach ($bookList as $i => $o){
			$aRe = array();
			$aRe['id'] = $o->id;
			$aRe['user_id'] = $o->user_id;
			$aRe['account_name'] = $o->account_name;
			$aRe['user_name'] = $o->user_name;
			$aRe['merchange_id'] = $o->merchange_id;
			$aRe['book_time'] = $o->book_time;
			$aRe['book_desc'] = $o->book_desc;
			$aRe['book_phone'] = $o->book_phone;
			$aRe['book_name'] = $o->book_name;
			$aRe['book_num'] = $o->book_num;
			$aRe['book_no'] = $o->book_no;
			$aRe['order_num'] = $o->order_num;
			$aRe['status'] = $o->status;
			$aRe['book_or_num'] = $o->book_or_num;
			$aRe['reserve_time'] = $o->reserve_time;
			$aRe['reach_time'] = $o->reach_time;
			$aRe['begin_time'] = $o->begin_time;
			$aRe['over_time'] = $o->over_time;
			$aRe['book_type'] = $o->book_type;
			$aRe['add_user_id'] = $o->add_user_id;
			$aRe['book_date'] = $o->book_date;
			$aRe['book_sex'] = $o->book_sex;
			$aRe['commit_time'] = $o->commit_time;
			$aRe['add_time'] = $o->add_time;
			$aRe['book_seat_type'] = $o->book_seat_type;
			$aRe['book_seat_num'] = $o->book_seat_num;
			$aRe['book_source_type'] = $o->book_source_type;
			$aReAll[]=$aRe;
		}
		BaseFunctions::ouputToString(array('records'=>$aReAll));
	}
	
	public function actionTakeOutList(){
		$aData = json_decode($_REQUEST['d'],true);
		$iUserId = isset($aData['user_id'])?$aData['user_id'] : '';
		$merchant_id = isset($aData['merchant_id'])?$aData['merchant_id'] : '';
		$cusId = isset($aData['id'])?$aData['id']:'0';
		$sDefoutCondition = " merchant_id = '$merchant_id' and customer_id = {$cusId} ";
		$takeOutcriteria = new CDbCriteria();
		
		$takeOutcriteria->order = ' id DESC ';
		
		$takeOutcriteria->condition = $sDefoutCondition.'  ';
		
		$takeOutcount = TakeOutList::model()->count($takeOutcriteria);
		
		$takeoutList = TakeOutList::model()->findAll($takeOutcriteria);
		
		$aRe = array();
		foreach ($takeoutList as $oo){
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
	
	public function actionFavList(){
		$aData = json_decode($_REQUEST['d'],true);
		$iUserId = isset($aData['user_id'])?$aData['user_id'] : '';
		$merchant_id = isset($aData['merchant_id'])?$aData['merchant_id'] : '';
		$cusId = isset($aData['id'])?$aData['id']:'0';
		$cusUserId = isset($aData['customer_user_id'])?$aData['customer_user_id']:'0';
		if (!$cusUserId) {
			BaseFunctions::outputResult(true, array());
			return;
		}
		$coupcriteria = new CDbCriteria();
			
		$coupcriteria->order = ' id DESC ';
			
		$coupcriteria->condition = " user_id = {$cusUserId}  ";
			
		$coupcount = GoodsDetailList::model()->count($coupcriteria);
			
		$couponList = GoodsDetailList::model()->findAll($coupcriteria);
		$aReAll = array();
		foreach ($couponList as $i => $o){
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
			$aReAll[] =$aRe;
		}
		BaseFunctions::outputResult(true, $aRe);
	}
}