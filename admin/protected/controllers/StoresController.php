<?php

class StoresController extends Controller
{
	public function filters()
	{
		return array(
				array(
						'application.filters.AdminFilter'
				),
		);
	}

	public function actionSeat()
	{
		//区域处理
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$SeatAreacriteria = new CDbCriteria();
		
		$SeatAreacriteria->order = ' id DESC ';
		
		$SeatAreacriteria->condition = ' merchant_id = "'.$merid.'" ';
		
		$SeatAreacount = SeatArea::model()->count($SeatAreacriteria);
		
		$Seatpages = new CPagination($SeatAreacount);
		
		$Seatpages->pageSize = 1000;
		
		$Seatpages->applyLimit($SeatAreacriteria);
		
		$Seatlist = SeatArea::model()->findAll($SeatAreacriteria);
		$arrSeatList =array();
		foreach ($Seatlist as $iSeatList => $aSeatList){
			$arrSeatList[$aSeatList->id] = $aSeatList->area_name;
		}
		
		//在用的
		$criteria = new CDbCriteria();
		
		$criteria->order = 'id DESC';
		
		$criteria->condition = ' status <> 2  and merchant_id = "'.$merid.'" ';
		
		$count = OrMerchantSeat::model()->count($criteria);
		
		$pages = new CPagination($count);
		
		$pages->pageSize = 1000;
		
		$pages->applyLimit($criteria);
		
		$list = OrMerchantSeat::model()->findAll($criteria);
		//重构
		$arrListResult = array();
		foreach ($list as $iList => $arrList){
			$arrListResult[$arrList->at_area][] = $arrList;
		}
		
		//停用的
		$criteria2 = new CDbCriteria();
		
		$criteria2->order = 'id DESC';
		
		$criteria2->condition = ' status = 2  and merchant_id = "'.$merid.'" ';
		
		$count2 = OrMerchantSeat::model()->count($criteria2);
		
		$pages2 = new CPagination($count2);
		
		$pages2->pageSize = 1000;
		
		$pages2->applyLimit($criteria2);
		
		$list2 = OrMerchantSeat::model()->findAll($criteria2);
		$arrListResult2 = array();
		foreach ($list2 as $iList2 => $arrList2){
			$arrListResult2[$arrList2->at_area][] = $arrList2;
		}
		//找出所有的区域
		
		
		$criteriaNull = new CDbCriteria();
		
		$criteriaNull->order = 'id DESC';
		
		$criteriaNull->condition = ' status = 1  and merchant_id = "'.$merid.'" ';
		
		$countNull = OrMerchantSeat::model()->count($criteriaNull);
		
		$criteriaAll = new CDbCriteria();
		
		$criteriaAll->order = 'id DESC';
		
		$criteriaAll->condition = '  merchant_id = "'.$merid.'" ';
		
		$countAll = OrMerchantSeat::model()->count($criteriaAll);
		
		$fullCout = $countAll-$countNull-$count2;
		$allCout = $countAll;// + $count2;
		$this->render('seat', array('uncout'=>$count2,
				'nocout' =>  $countNull,
				'fullcout' => $fullCout,
				'cout' => $allCout,
				'areaList'=>$arrSeatList,'list' => $arrListResult, 'pages' => $pages,
				'list2' => $arrListResult2, 'pages2' => $pages2,"oModer"=>new OrMerchantSeat()));
	}
	
	public function actionTime()
	{
		
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$isOk = "2";
		//$dataModel = new DataModelClass();
		$merchant_start_time = isset($_REQUEST["merchant_start_time"])?$_REQUEST["merchant_start_time"]:'';
		$merchant_end_time = isset($_REQUEST["merchant_end_time"])?$_REQUEST["merchant_end_time"]:'';
		$business_type = isset($_REQUEST["business_type"])?$_REQUEST["business_type"]:0;
		$status = isset($_REQUEST["status"])?$_REQUEST["status"]:0;
		$set = isset($_REQUEST["set"])?$_REQUEST["set"]:0;
		
		$info['merchant_start_time'] = $merchant_start_time;
		$info['merchant_end_time'] = $merchant_end_time;
		$info['business_type'] = $business_type;
		$info['status'] = $status;
		$sErrMsg='';
		if ($set>0) {
			if ($merchant_start_time&&$merchant_end_time){
				//更新商店的信息
				$info1 = array('merchant_id'=>$merid,'status'=>$status,'merchant_start_time'=>$merchant_start_time,'merchant_end_time'=>$merchant_end_time,'business_type'=>$business_type);
				$this->dataChannel("merchant","updateBusinessTime",$info1);
				$info['merchant_start_time'] = $merchant_start_time;
				$info['merchant_end_time'] = $merchant_end_time;
				$info['business_type'] = $business_type;
				$info['status'] = $status;
				$isOk = "1";
			}else if(!$merchant_start_time){
				$isOk = "3";
				$sErrMsg = "营业开始时间不能为空";
			}else if(!$merchant_end_time){
				$isOk = "3";
				$sErrMsg = "营业结束时间不能为空";
			}
		}else{
			//获取商户的
			$info1 = array('merchant_id'=>$merid);
			$re = $this->dataChannel("merchant","getBusinessTime",$info1);
			if ( $re['type']) {
				$info['merchant_start_time'] = $re['msg']['merchant_start_time'];
				$info['merchant_end_time'] = $re['msg']['merchant_end_time'];
				$info['status'] = $re['msg']['status'];
				$info['business_type']= $re['msg']['business_type'];
				//
				//return;
			}
		}
		$this->render('time',array('info'=>$info,"isOk"=>$isOk,'sErrMsg'=>$sErrMsg));
	}
	
	public function actionAdd(){
		$model=new StoreAddForm();
		$isOk="3";
		//$this->tempA($_POST['StoreAddForm']);
		$info = array();
		$addarea = isset($_REQUEST['addarea'])?$_REQUEST['addarea']:'0';
		if(isset($_POST['StoreAddForm']))
		{
			$model->attributes=$_POST['StoreAddForm'];
			if($model->validate())
			{
				
				// form inputs are valid, do something here
				//TODO user id and merchant id
				//$_POST['StoreAddForm']['add_user_id'] = "1";
				//$_POST['GoodsForm']['merchant_id'] = "1";
				$info = $_POST['StoreAddForm'];
				$info['merchant_id'] = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
				$this->dataChannel("Seat","addSeat",$info);
				$isOk="1";
			}else{
				$info = $_POST['StoreAddForm'];
				$isOk="2";
			}
			$info = $_POST['StoreAddForm'];
		}
		$areaArr = $this->dataChannel("seat","getSeatArea",array('merchant_id'=>Yii::app()->cache->get('merchant_'.Yii::app()->user->id)));
		$this->render('add',array('addarea'=>$addarea,'model'=>$model,'info'=>$info,"areaArr"=>$areaArr,"isOk"=>$isOk));
	}
	
	public function actionAddArea(){
		if (isset($_POST['addAreaName'])&&$_POST['addAreaName']) {
			//添加
			$info = array();
			$info['area_name'] = $_POST['addAreaName'];
			$info['merchant_id'] = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
			$this->dataChannel("Seat","addArea",$info);
			echo "<script>alert('添加成功');</script>";
		}else{
			echo "<script>alert('添加失败');</script>";
		}
		$this->redirect($this->createUrl("stores/add")."?addarea=1");
	}
	
	public function actionChangeSeatStatus(){
		$iStatus = isset($_REQUEST['status'])?$_REQUEST['status']:'';
		$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
		$type = isset($_REQUEST['type'])?$_REQUEST['type']:'2';
		if (!$iStatus||!$id) {
			echo "请选择正确的桌面!";
			return;
		}
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$userId = Yii::app()->user->id;
		$info = array("user_id"=>$userId,"merchant_id"=>$merid,"status"=>$iStatus,"changeId"=>$id);
		//判断是否能够改
		if ($type == 2&&$iStatus!=3) {
			$aCheckRe = $this->dataChannel("Seat", "CheckSeat",array('id'=>$id,"user_id"=>$userId,"merchant_id"=>$merid));
			if ($aCheckRe['type']) {
				$aRe = $this->dataChannel("Seat","changeSeatStatus",$info);
				echo json_encode($aRe);
			}else{
				echo json_encode($aCheckRe);
			}
		}else{
			$aRe = $this->dataChannel("Seat","changeSeatStatus",$info);
			echo json_encode($aRe);
		}
		
		
	}
	
	public function actionChangeAreaStatus(){
		$iStatus = isset($_REQUEST['status'])?$_REQUEST['status']:'';
		$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
		if (!$iStatus||!$id) {
			echo "请选择正确的区域!";
			return;
		}
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$userId = Yii::app()->user->id;
		$info = array("user_id"=>$userId,"merchant_id"=>$merid,"status"=>$iStatus,"changeId"=>$id);
		$aRe = $this->dataChannel("Seat","changeAreaStatus",$info);
		echo isset($aRe['msg'])?$aRe['msg']:'error!';
	}
}