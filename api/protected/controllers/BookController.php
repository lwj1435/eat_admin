<?php
class BookController extends BaseController{
	
	public function actionBookList(){
		//类型,分页列表
		$oBook = new Book();
		$select = "*";
		$where = "1";
		$startPage=1;
		$pageNum=10;
		$group = "";
		$order = "book_type";
		$arr = $oBook->pageGet($select, $where,$startPage, $pageNum,$group,$order);
		echo BaseFunctions::ouputToString($arr);
	}

	public function actionUserBookList(){
		BaseFunctions::writeLog($_REQUEST['d']);
		$aData = json_decode($_REQUEST['d'],true);
// 		$aData = $_REQUEST;
		$iAddUser = isset($aData['user_id'])?$aData['user_id']:'64';
		$sStr =  isset($aData['search'])?$aData['search']:'';;
		$pageVar = isset($aData['pageNum'])?$aData['pageNum']:1;
		$iSeatType = isset($aData['status'])?$aData['status']:0;
		$iCount = isset($aData['count'])?$aData['count']:1;
		$iPageNum = 10;
		$iCount = $iCount<1?1:$iCount;
		$pageVar= $pageVar<1?1:$pageVar;
		$pageVar = $iCount>1?1:$pageVar;
		$ilimit = $iPageNum * $iCount;
		$dBookData = isset($aData['bookDate'])?$aData['bookDate']:"";
		//;
		$sDefoutCondition = "   t.user_id = '$iAddUser' ";
		if ($dBookData) {
			 $sDefoutCondition = $sDefoutCondition." and t.`book_date` = '$dBookData'  ";
		}
		
		$iType = isset($aData['type'])?$aData['type']:1;
		//所有的已确认的订单
		$criteria = new CDbCriteria();
		
		$criteria->order = ' t.add_time DESC ';
		$criteria->with = array('merchantOwer');
		if ($iType==1) {
			//未完成的
			$criteria->condition = $sDefoutCondition.'  and (t.`status` = 2 or t.`status` = 1 or t.`status` = 0)  ';
		}else if ($iType==2) {
			//待评价的
			$criteria->condition = $sDefoutCondition.'  and (t.`status` = 0 )  ';
		}else if ($iType==3) {
			//全部的
			$criteria->condition = $sDefoutCondition.'  and (t.`status` = 2 or t.`status` = 1 or t.`status` = 0 or t.`status` =3 or t.`status` =4 or t.`status` =5 )  ';
		}else if ($iType==4) {
			$criteria->condition = $sDefoutCondition.'  and ( t.`status` = 4 or t.`status` =5 ) ';
		}else{
			$criteria->condition = $sDefoutCondition.'   and (t.`status` = 2 or t.`status` = 1 or t.`status` = 0 )  ';
		}
		if ($iSeatType==1) {
			$criteria->condition .= '  and t.`book_type` = "A"  ';
		}else if ($iSeatType==2) {
			$criteria->condition .= '  and t.`book_type` = "B"  ';
		}else if ($iSeatType==3) {
			$criteria->condition .= '  and t.`book_type` = "C" ';
		}else if ($iSeatType==4) {
			$criteria->condition .= '  and t.`book_type` = "D"  ';
		}else{
			
		}
		
		if ($sStr) {
			$criteria->condition .= '  and t.`book_name` like "%'.$sStr.'%"  ';
		}
		
		$criteria->limit =$ilimit;
		
		$criteria->offset =$iPageNum*($pageVar-1);
		
		$count = BookList::model()->count($criteria);
		
		$list = BookList::model()->findAll($criteria);
		
		$aReAll = array();
		foreach ($list as $i => $o){
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

			$aRe['merchant_name'] = $o->merchantOwer->merchant_name;
			$aReAll[]=$aRe;
		}
		BaseFunctions::ouputToString(array('records'=>$aReAll));
		//BaseFunctions::outputResult(true, array('records'=>$aReAll));
	}
	
	public function actionMoBookList(){
		BaseFunctions::writeLog($_REQUEST['d']);
		$aData = json_decode($_REQUEST['d'],true);
// 		$aData = $_REQUEST;
		$iAddUser = isset($aData['user_id'])?$aData['user_id']:'1';
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'1';
		$sStr =  isset($aData['search'])?$aData['search']:'';;
		$pageVar = isset($aData['pageNum'])?$aData['pageNum']:1;
		$iSeatType = isset($aData['status'])?$aData['status']:0;
		$iCount = isset($aData['count'])?$aData['count']:1;
		$iPageNum = 10;
		$iCount = $iCount<1?1:$iCount;
		$pageVar= $pageVar<1?1:$pageVar;
		$pageVar = $iCount>1?1:$pageVar;
		$ilimit = $iPageNum * $iCount;
		$dBookData = isset($aData['bookDate'])?$aData['bookDate']:"";
		//;
		$sDefoutCondition = "   merchange_id = '$iMerchantId' ";
		if ($dBookData) {
			 $sDefoutCondition = $sDefoutCondition." and `book_date` = '$dBookData'  ";
		}
		
		$iType = isset($aData['type'])?$aData['type']:1;
		//所有的已确认的订单
		$criteria = new CDbCriteria();
		
		$criteria->order = ' id DESC ';
		if ($iType==1) {
			$criteria->condition = $sDefoutCondition.'  and (`status` = 2 or `status` = 1 )  ';
		}else if ($iType==2) {
			$criteria->condition = $sDefoutCondition.'  and (`status` = 0 )  ';
		}else if ($iType==3) {
			$criteria->condition = $sDefoutCondition.'  and (`status` =3 or `status` =4 or `status` =5 )  ';
		}else if ($iType==4) {
			$criteria->condition = $sDefoutCondition.'  and ( `status` = 4 or `status` =5 ) ';
		}else{
			$criteria->condition = $sDefoutCondition.'   and (`status` = 2 or `status` = 1 )  ';
		}
		if ($iSeatType==1) {
			$criteria->condition .= '  and `book_type` = "A"  ';
		}else if ($iSeatType==2) {
			$criteria->condition .= '  and `book_type` = "B"  ';
		}else if ($iSeatType==3) {
			$criteria->condition .= '  and `book_type` = "C" ';
		}else if ($iSeatType==4) {
			$criteria->condition .= '  and `book_type` = "D"  ';
		}else{
			
		}
		
		if ($sStr) {
			$criteria->condition .= '  and `book_name` like "%'.$sStr.'%"  ';
		}
		
		$criteria->limit =$ilimit;
		
		$criteria->offset =$iPageNum*($pageVar-1);
		
		$count = BookList::model()->count($criteria);
		
		$list = BookList::model()->findAll($criteria);
		
		$aReAll = array();
		foreach ($list as $i => $o){
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
		//BaseFunctions::outputResult(true, array('records'=>$aReAll));
	}
	
	public function actionMerAddBook(){
		$oBook = new Book();
		BaseFunctions::writeLog($_REQUEST['d']);
		$aData = json_decode($_REQUEST['d'],true);
		$iAddUser = isset($aData['user_id'])?$aData['user_id']:'';
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		
		$aParam['book_time'] = isset($aData['book_time'])?$aData['book_time']:'';
		$aParam['book_desc'] = isset($aData['book_desc'])?$aData['book_desc']:'';
		$aParam['book_phone'] = isset($aData['book_phone'])?$aData['book_phone']:'';
		$aParam['book_name'] = isset($aData['book_name'])?$aData['book_name']:'';
		$aParam['book_num'] = isset($aData['book_num'])?$aData['book_num']:'';
		$aParam['book_no'] = isset($aData['book_no'])?$aData['book_no']:'';
		$aParam['order_num'] = isset($aData['order_num'])?$aData['order_num']:'';
		$aParam['status'] = isset($aData['status'])?$aData['status']:'';
		$aParam['book_or_num'] = isset($aData['book_or_num'])?$aData['book_or_num']:'';
		$aParam['reserve_time'] = isset($aData['reserve_time'])?$aData['reserve_time']:'';
		$aParam['reach_time'] = isset($aData['reach_time'])?$aData['reach_time']:'';
		$aParam['begin_time'] = isset($aData['begin_time'])?$aData['begin_time']:'';
		$aParam['over_time'] = isset($aData['over_time'])?$aData['over_time']:'';
		$aParam['book_type'] = isset($aData['book_type'])?$aData['book_type']:'';
		$aParam['book_date'] = isset($aData['book_date'])?$aData['book_date']:'';
		$aParam['book_sex'] = isset($aData['book_sex'])?$aData['book_sex']:'';
		
		$oBook->addMerBook($iAddUser, $iMerchantId, $aParam);
	}
	
	public function actionUpdateBook(){
		
	}
	
	public function actionChangeBookStatus(){
		$oBook = new Book();
		$aData = json_decode($_REQUEST['d'],true);
		//$aData=$_REQUEST;
		$iAddUser = isset($aData['user_id'])?$aData['user_id']:'';
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$sStatus = isset($aData['status'])?$aData['status']:'';
		$id = isset($aData['bookId'])?$aData['bookId']:'';
		$re = $oBook->changeBookStatus($iAddUser,$id,$sStatus,$iMerchantId);
		BaseFunctions::ouputToString($re);
		//$info = array("bookId"=>$id,'status'=>$sStatus,'merchant_id'=>$merid);
	}
	
	public function actionGetBook(){
		$oBook = new Book();
		$aData = json_decode($_REQUEST['d'],true);
		$iAddUser = isset($aData['user_id'])?$aData['user_id']:'';
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$id = isset($aData['bookId'])?$aData['bookId']:'';
		$type = isset($aData['type'])?$aData['type']:'1';
		//$id =  isset($_REQUEST['bookId'])?$_REQUEST['bookId']:'';
		$aRe = $oBook->getBookDetail($id,$iMerchantId);
		if ($type==2) {
			$aOutArr = isset($aRe['msg'][0])?$aRe['msg'][0]:array();
			BaseFunctions::outputResult($aRe['type'], $aOutArr);
		}else{
			BaseFunctions::ouputToString($aRe);
		}
		
	}
	
	public function actionSetBookSeat(){
		$oBook = new Book();
		$aData = json_decode($_REQUEST['d'],true);
		BaseFunctions::writeLog(json_encode($aData));
		$iAddUser = isset($aData['user_id'])?$aData['user_id']:'';
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$id = isset($aData['id'])?$aData['id']:'';
		$toStatus = isset($aData['toStatus'])?$aData['toStatus']:'';
		$seatType = isset($aData['seatType'])?$aData['seatType']:'';
		$seatNum = isset($aData['seatNum'])?$aData['seatNum']:'';
		$seatId = isset($aData['seatId'])?$aData['seatId']:'';
		$nowStatus = isset($aData['nowStatus'])?$aData['nowStatus']:'';
		$clType = isset($aData['clType'])?$aData['clType']:'';
		$re = $oBook->setSeat($iAddUser,$id,$iMerchantId,$clType,$seatId,$seatType,$seatNum);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionAddTimeOut(){
		$aData = json_decode($_REQUEST['d'],true);
		BaseFunctions::writeLog(json_encode($aData));
		$iAddUser = isset($aData['user_id'])?$aData['user_id']:'';
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$id = isset($aData['id'])?$aData['id']:'';
		$o = new Book();
		$re = $o->addDelayTime($iAddUser,$iMerchantId,$id);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionGetRech(){
		$o = new Book();
		$aData = json_decode($_REQUEST['d'],true);
// 		$aData = $_REQUEST;
		BaseFunctions::writeLog(json_encode($aData));
		$iAddUser = isset($aData['user_id'])?$aData['user_id']:'';
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		BaseFunctions::ouputToString($o->getReach($iMerchantId));
	}
	

	/**
	 * 客户端添加订单
	 */
	public function actionAddBookCli(){
		$aData = json_decode($_REQUEST['d'],true);
		$iAddUserId = isset($aData['user_id'])?$aData['user_id']:'64';//用户id
		$iMerId  = isset($aData['merchant_id'])?$aData['merchant_id']:'1';//商家id
		$bookDate  = isset($aData['book_date'])?$aData['book_date']:'2014-06-09';//订单日期
		$bookTime = isset($aData['book_time'])?$aData['book_time']:'15:30';//订单时间
		$bookNum = isset($aData['book_num'])?$aData['book_num']:'4';//订餐人数;
		$bookSeatType = isset($aData['book_seat_type'])?$aData['book_seat_type']:'';//是否4人座
		$bookName = isset($aData['book_name'])?$aData['book_name']:'李坤定';//订餐的用户的名字
		$bookPhone = isset($aData['book_phone'])?$aData['book_phone']:'13632342271';//订餐手机
		$bookDesc = isset($aData['book_desc'])?$aData['book_desc']:'';
		$bookMenArr = isset($aData['book_menu_arr'])?$aData['book_menu_arr']:array(
				array('id'=>94,'name'=>'聪哥叉烧饭1','pice'=>120),
				array('id'=>93,'name'=>'知斯蛋糕','pice'=>120),
				array('id'=>93,'name'=>'知斯蛋糕','pice'=>120),
		);
		$o = new Book();
		$re = $o->addBookCli($iAddUserId,$iMerId,$bookDate,$bookTime,$bookNum,$bookSeatType,$bookName,$bookPhone,$bookDesc,$bookMenArr);
		BaseFunctions::ouputToString($re);
	}
}