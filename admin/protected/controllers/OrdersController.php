<?php

class OrdersController extends Controller
{
	public function filters()
	{
		return array(
				array(
						'application.filters.AdminFilter'
				),
		);
	}

	public function actionReservation()
	{
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		
		$dBookData = isset($_REQUEST['bookData'])?$_REQUEST['bookData']:date("Y-m-d");
		$bookType = isset($_REQUEST['bookType'])?$_REQUEST['bookType']:'';
		if ($bookType) {
			$sDefoutCondition = " `book_date` = '$dBookData' and merchange_id = '$merid' and book_type = '{$bookType}'";
		}else{
			$sDefoutCondition = " `book_date` = '$dBookData' and merchange_id = '$merid' ";
		}
		//所有的已确认的订单
		$criteria = new CDbCriteria();
		
		$criteria->order = ' `status` = 2 desc,book_type asc,book_time asc ';
		
		$criteria->condition = $sDefoutCondition.'  and (`status` = 2 or `status` = 1 )  ';
		
		$count = BookList::model()->count($criteria);
		
		$pages = new CPagination($count);
		
		$pages->pageSize = 10;
		
		$pages->applyLimit($criteria);
		
		$list = BookList::model()->findAll($criteria);
		
		//所有未确认的单
		$uncriteria = new CDbCriteria();
		
		$uncriteria->order = 'id DESC';
		
		$uncriteria->condition = $sDefoutCondition.' and status = 0 ';
		
		$uncount = BookList::model()->count($uncriteria);
		
		$unpages = new CPagination($uncount);
		
		$unpages->pageSize = 10;
		
		$unpages->applyLimit($uncriteria);
		
		$unlist = BookList::model()->findAll($uncriteria);
		
		
		//所有完成或取消的单
		$delcriteria = new CDbCriteria();
		
		$delcriteria->order = ' id DESC ';
		
		$delcriteria->condition = $sDefoutCondition.' and (status =3 or status =4 or status =5 )  ';
		
		$delcount = BookList::model()->count($delcriteria);
		
		$delpages = new CPagination($delcount);
		
		$delpages->pageSize = 10;
		
		$delpages->applyLimit($delcriteria);
		
		$dellist = BookList::model()->findAll($delcriteria);
		
		//获取所有的空余的座位
		$seatcriteria = new CDbCriteria();
		
		$seatcriteria->order = 'id DESC';
		
		$seatcriteria->condition = '  merchant_id = "'.$merid.'" and status =1  ';
		
		$seatcount = OrMerchantSeat::model()->count($seatcriteria);
		
		$seatpages = new CPagination($seatcount);
		
		$seatpages->pageSize = 1000;
		
		$seatpages->applyLimit($seatcriteria);
		
		$seatllist = OrMerchantSeat::model()->findAll($seatcriteria);
		$seatReArr = array();
		foreach ($seatllist as $iSLKey => $aSLval){
			if ($aSLval->seat_type) 
				$seatReArr[$aSLval->seat_type][] = $aSLval;
		}
		//reservationList
		//获取到号
		$info = array('user_id'=>Yii::app()->user->id,'merchant_id'=>Yii::app()->cache->get('merchant_'.Yii::app()->user->id));
		$aReachDetailArr = array();
		$rechArr = $this->dataChannel("book","getRech",$info);
		
		if ($rechArr['type']) {
			$aReachDetailArr =$rechArr['msg'];
			foreach ($aReachDetailArr as $sTempKey => $sTempVal){
				$aReachDetailArr[$sTempKey] = $this->dealReachSeat($sTempKey,$sTempVal,$merid);
			}
		}
		
		//获取所有位置的统计
		$acount = $this->getBookCount($dBookData, $merid, "A");
		$bcount = $this->getBookCount($dBookData, $merid, "B");
		$ccount = $this->getBookCount($dBookData, $merid, "C");
		$dcount = $this->getBookCount($dBookData, $merid, "D");
		$allcount = $this->getBookCount($dBookData, $merid, "");
		$this->render('reservationList', array('bookData'=>$dBookData,'seatList'=>$seatReArr,
				'acount' =>$acount,
				'bcount' =>$bcount,
				'ccount' =>$ccount,
				'dcount' =>$dcount,
				'uncount'=>$uncount,'reachArr'=>$aReachDetailArr,'list' => $list, 
				'pages' => $pages,'unlist'=>$unlist,'unpages'=>$unpages,
				'dellist'=>$dellist,'delpages'=>$delpages,'count'=> $allcount,
				"oModer"=>new BookList()));
		
	}
	
	private function dealReachSeat($sType,$sVal,$iMer){
		$iSafeTime = 60*60*2;
		$sCacheKey = $sType."_site_cache_".$iMer;
		$sOldSite = Yii::app()->cache->get($sCacheKey);;
		if ($sOldSite==$sVal) {
			yii::app()->cache->set($sCacheKey, $sOldSite, $iSafeTime);
			return $sVal;
		}else if(!$sOldSite&&$sVal){
			yii::app()->cache->set($sCacheKey, $sVal, $iSafeTime);
			return $sVal;
		}else if(!$sVal&&$sOldSite){
			yii::app()->cache->set($sCacheKey, $sOldSite, $iSafeTime);
			return $sOldSite;
		}else {
			//yii::app()->cache->set($sCacheKey, $sOldSite, $iSafeTime);
			return $sVal;
		}
		
	}
	
	private function getBookCount($dBookData,$merid,$sBookType){
		$acriteria = new CDbCriteria();
		
		$acriteria->order = 'id DESC';
		
		if ($sBookType) {
			$acriteria->condition = " `book_date` = '$dBookData' and merchange_id = '$merid'  and status > -1 and book_type = '{$sBookType}' ";
		}else{
			$acriteria->condition = " `book_date` = '$dBookData' and merchange_id = '$merid'  and status > -1  ";
		}
		
		$tcount = BookList::model()->count($acriteria);
		return $tcount;
	}
	
	public function actionTakeaway()
	{
		$dBookData = isset($_REQUEST['bookData'])?$_REQUEST['bookData']:date("Y-m-d");
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		//所有的列表
		$sDefoutCondition = " merchant_id = $merid and take_out_date = '{$dBookData}' ";
		
		$criteria = new CDbCriteria();
		
		$criteria->order = 'take_out_time,id DESC';
		
		$criteria->condition = $sDefoutCondition.'  and (status = 1 or status = 2) ';
		
		$count = TakeOutList::model()->count($criteria);
		
		$pages = new CPagination($count);
		
		$pages->pageSize = 10;
		
		$pages->applyLimit($criteria);
		
		$list = TakeOutList::model()->findAll($criteria);
		
		//未确认的订单
		
		$uncriteria = new CDbCriteria();
		
		$uncriteria->order = 'take_out_time,id DESC';
		
		$uncriteria->condition = $sDefoutCondition.' and status = 0 ';
		
		$uncount = TakeOutList::model()->count($uncriteria);
		
		$unpages = new CPagination($uncount);
		
		$unpages->pageSize = 10;
		
		$unpages->applyLimit($uncriteria);
		
		$unlist = TakeOutList::model()->findAll($uncriteria);
		
		//已取消的订单
		
		$delcriteria = new CDbCriteria();
		
		$delcriteria->order = 'take_out_time,id DESC';
		
		$delcriteria->condition = $sDefoutCondition.' and ( status = 3 or status = 4) ';
		
		$delcount = TakeOutList::model()->count($delcriteria);
		
		$delpages = new CPagination($delcount);
		
		$delpages->pageSize = 10;
		
		$delpages->applyLimit($delcriteria);
		
		$dellist = TakeOutList::model()->findAll($delcriteria);
		$allToday = $count+$uncount+$delcount;
		$this->render('takeaway',array('allToday'=>$allToday,
				'bookData'=>$dBookData,'list' => $list, 'pages' => $pages,
				'unlist'=>$unlist,'unpages'=>$unpages, 'uncount'=>$uncount,
				'dellist'=>$dellist,'delpages'=>$delpages, "oModer"=>new TakeOutList()));
	
	}
	
	/**
	 * 添加预约订单
	 */
	public function actionAddReservation(){
		$model=new BookForm();
		$info = array();
		$isOk = "3";
		if(isset($_POST['BookForm']))
		{
// 		$this->tempA($_POST['BookForm']);
			$model->attributes=$_POST['BookForm'];
			if($model->validate())
			{
		
				// form inputs are valid, do something here
				//TODO user id and merchant id
				//$_POST['StoreAddForm']['add_user_id'] = "1";
				//$_POST['GoodsForm']['merchant_id'] = "1";
				$info = $_POST['BookForm'];
				$info['merchant_id'] = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
				$this->dataChannel("book","merAddBook",$info);
				$isOk = "1";
			}else{
				$info = $_POST['BookForm'];
				$isOk = "2";
			}
			$info = $_POST['BookForm'];
		}
		$this->render('addReservation',array('model'=>$model,'info'=>$info,'isOk'=>$isOk));
	}
	
	public function actionChangeOrderSta(){
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
		$sStatus = isset($_REQUEST['sta'])?$_REQUEST['sta']:'';
		$info = array("bookId"=>$id,'status'=>$sStatus,'merchant_id'=>$merid);
		//echo $id.":".$sStatus;
		$aRe = $this->dataChannel("book","changeBookStatus",$info);
		echo isset($aRe['msg'])?$aRe['msg']:'error!';
	}
	
	public function actionEditOrder(){
		$iBookId = isset($_REQUEST['ii'])?$_REQUEST['ii']:'';
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		//获取详细的信息
		$info = array("bookId"=>$iBookId,'merchant_id'=>$merid);
		$aRe = $this->dataChannel("book","getBook",$info);
		$aBook = isset($aRe['msg'][0])?$aRe['msg'][0]:array();
		
		//获取所有的空余的座位
		$seatcriteria = new CDbCriteria();
		
		$seatcriteria->order = 'id DESC';
		
		$seatcriteria->condition = '  merchant_id = "'.$merid.'" and status =1  ';
		
		$seatcount = OrMerchantSeat::model()->count($seatcriteria);
		
		$seatpages = new CPagination($seatcount);
		
		$seatpages->pageSize = 1000;
		
		$seatpages->applyLimit($seatcriteria);
		
		$seatllist = OrMerchantSeat::model()->findAll($seatcriteria);
		$seatReArr = array();
		foreach ($seatllist as $iSLKey => $aSLval){
			if ($aSLval->seat_type)
				$seatReArr[$aSLval->seat_type][] = $aSLval;
		}
		
		$this->render('detail',array('abookArr'=>$aBook,'seatList'=>$seatReArr));
	}
	
	public function actionChangeOrderStatus(){
		/*
		 * 		id:oId,
	  			toStatus:toSta,
	  			seatType:seatType,
	  			seatNum:seatNum,
	  			seatId:seatId,
	  			nowStatus:nowSta,
	  			clType:clickType
		 */
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
        $toStatus = isset($_REQUEST['toStatus'])?$_REQUEST['toStatus']:'';
        $seatType = isset($_REQUEST['seatType'])?$_REQUEST['seatType']:'';
        $seatNum = isset($_REQUEST['seatNum'])?$_REQUEST['seatNum']:'';
        $seatId = isset($_REQUEST['seatId'])?$_REQUEST['seatId']:'';
        $nowStatus = isset($_REQUEST['nowStatus'])?$_REQUEST['nowStatus']:'';
        $clType = isset($_REQUEST['clType'])?$_REQUEST['clType']:'';
        if (!$id) {
        	echo "请选择一条记录";
        	return;
        }
        //添加座位
        //$aRe = $this->dataChannel("book","setBookSeat",$info);
        $info = array(
        		'id' =>$id,
				'toStatus' =>$toStatus,
        		'seatType' =>$seatType,
				'seatNum' =>$seatNum,
        		'seatId' =>$seatId,
				'nowStatus' =>$nowStatus,
        		'clType' =>$clType,
        		'merchant_id'=>$merid,
        		'user_id'=>Yii::app()->user->id
        );
        //修改状态
        //$info = array("bookId"=>$id,'status'=>$toStatus,'merchant_id'=>$merid);
        $aRe = $this->dataChannel("book","setBookSeat",$info);
        echo isset($aRe['msg'])?$aRe['msg']:'error';
	}
	
	public function actionAddTime(){
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
		if (!$id) {
			echo "请选择一条记录";
			return;
		}
		$info = array('user_id'=>Yii::app()->user->id,'merchant_id'=>$merid,'id'=>$id);
		$aRe = $this->dataChannel("book","addTimeOut",$info);
		echo isset($aRe['msg'])?$aRe['msg']:'error';
	}
	
	public function actionQueueList(){
		
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		
		$dBookData = isset($_REQUEST['bookData'])?$_REQUEST['bookData']:date("Y-m-d");
		$sDefoutCondition = " `book_date` = '$dBookData' and merchange_id = '$merid' ";
		//所有的已确认的订单
		$criteria = new CDbCriteria();
		
		$criteria->order = ' id DESC ';
		
		$criteria->condition = $sDefoutCondition.'  and (`status` = 4 or `status` = 5 )  ';
		
		$count = BookList::model()->count($criteria);
		
		$pages = new CPagination($count);
		
		$pages->pageSize = 10;
		
		$pages->applyLimit($criteria);
		
		$list = BookList::model()->findAll($criteria);
		//reservationList
		//获取到号
		$info = array('user_id'=>Yii::app()->user->id,'merchant_id'=>Yii::app()->cache->get('merchant_'.Yii::app()->user->id));
		$aReachDetailArr = array();
		$rechArr = $this->dataChannel("book","getRech",$info);
		
		if ($rechArr['type']) {
			$aReachDetailArr =$rechArr['msg'];
			foreach ($aReachDetailArr as $sTempKey => $sTempVal){
				$aReachDetailArr[$sTempKey] = $this->dealReachSeat($sTempKey,$sTempVal,$merid);
			}
		}
		
		$this->render('queueList',array('list'=>$list,'pages'=>$pages,'reachArr'=>$aReachDetailArr));
	}
	
	public function actionTakeAwayDetail(){
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$user = Yii::app()->user->id;
		$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
		if (!$id) {
			return;
		}
		$info = array('take_out_id'=>$id,'merchant_id'=>$merid,"user_id"=>$user);
		$aRe = $this->dataChannel("takeOut","GetTakeOut",$info);
		$orderList = array();
		if (isset($aRe['msg']['order_id'])&&$aRe['msg']['order_id']) {
			$criteria = new CDbCriteria();
		
			$criteria->order = ' t.id DESC ';
			
			$criteria->condition = '  parent_order_id =  '.$aRe['msg']['order_id'];
			$criteria->with=array('greens');
			
			$orderList = Order::model()->findAll($criteria);
// 			$this->tempA($orderList);
		}
		$this->render('takeAwayDetail',array('info'=>$aRe['msg'],'favorable'=>array(),"orderList"=>$orderList,'totalMoney'=>0,'replyMoney'=>0,'realMoney'=>0));
	}
	
	public function actionChangeTakeOutSta(){
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
		$sStatus = isset($_REQUEST['sta'])?$_REQUEST['sta']:'';
		$info = array("takeOutId"=>$id,'status'=>$sStatus,'merchant_id'=>$merid);
		//echo $id.":".$sStatus;
		$aRe = $this->dataChannel("takeOut","changetSta",$info);
		echo isset($aRe['msg'])?$aRe['msg']:'error!';
	}
}