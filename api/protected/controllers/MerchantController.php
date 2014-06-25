<?php

class MerchantController extends BaseController
{

	public function filters()
	{
		return array(
//			'AccessControl+login',
			array(
				'application.filters.AdminFilter + login,addmenu'
			),
		);
	}
	
	public function actionIndex()
	{
		
	}
	
	/**
	 * 设置商铺信息
	 */
	public function actionSetMerchant(){
		$oMerchant = new Merchant();
		//TODO
		if ($this->checkData($_REQUEST)) {
			//TODO 要删除，测试数据
			BaseFunctions::writeLog(json_encode($_REQUEST));
			$aData = json_decode($_REQUEST['d'],true);
			$aParam = array();
			$merchant_id =isset($aData['mid']) ? $aData['mid'] : '';
			$merchant_name = isset($aData['merchant_name']) ? $aData['merchant_name'] : '';
			$merchant_othername = isset($aData['merchant_othername']) ? $aData['merchant_othername'] : '';
			$merchant_manager = isset($aData['merchant_manager']) ? $aData['merchant_manager'] : '';
			$merchant_manager_phone = isset($aData['merchant_manager_phone']) ? $aData['merchant_manager_phone'] : '';
			$merchant_logo = isset($aData['merchant_logo']) ? $aData['merchant_logo'] : '';
			$merchant_start_time = isset($aData['merchant_start_time']) ? $aData['merchant_start_time'] : '';
			$merchant_end_time = isset($aData['merchant_end_time']) ? $aData['merchant_end_time'] : '';
			$merchant_service = isset($aData['merchant_ser']) ? $aData['merchant_ser'] : array();
			$merchant_tag = isset($aData['merchant_tag']) ? $aData['merchant_tag'] : array();
			$merchant_call = isset($aData['merchant_call']) ? $aData['merchant_call'] : '';
			$merchant_phone = isset($aData['merchant_phone']) ? $aData['merchant_phone'] : '';
			$address = isset($aData['address']) ? $aData['address'] : '';
			$pro = isset($aData['pro']) ? $aData['pro'] : '';
			$city = isset($aData['city']) ? $aData['city'] : '';
			$area = isset($aData['area']) ? $aData['area'] : '';
			$merchant_per = isset($aData['merchant_per']) ? $aData['merchant_per'] : '';
			$merchant_traffic =isset($aData['merchant_traffic']) ? $aData['merchant_traffic'] : '';
			$free_service =isset($aData['free_service']) ? $aData['free_service'] : array();
			$merchant_desc =isset($aData['merchant_desc']) ? $aData['merchant_desc'] : '';
// 			$merchant_branch = isset($_REQUEST['d']['MerchantAddForm']['merchant_branch']) ? $_REQUEST['d']['MerchantAddForm']['merchant_branch'] : ''; 
// 			$merchant_alias = isset($_REQUEST['d']['MerchantAddForm']['merchant_alias']) ? $_REQUEST['d']['MerchantAddForm']['merchant_alias'] : '';
			
			$aParam['merchant_name'] = $merchant_name;
			$aParam['merchant_othername'] = $merchant_othername;
			$aParam['merchant_manager'] = $merchant_manager;
			$aParam['merchant_manager_phone'] = $merchant_manager_phone;
			$aParam['merchant_logo'] = $merchant_logo;
			$aParam['merchant_start_time'] = $merchant_start_time;
			$aParam['merchant_end_time'] = $merchant_end_time;
			$aParam['merchant_ser'] = $this->stringAndArray($merchant_service,false);
			$aParam['merchant_tag'] = $this->stringAndArray($merchant_tag,false);
			$aParam['merchant_call'] = $merchant_call;
			$aParam['merchant_phone'] = $merchant_phone;
			$aParam['address'] = $address;
			$aParam['pro'] = $pro;
			$aParam['city'] = $city;
			$aParam['area'] = $area;
			$aParam['merchant_per'] = $merchant_per;
			$aParam['merchant_traffic'] = $merchant_traffic;
			$aParam['free_service'] = $this->stringAndArray($free_service,false);
			$aParam['merchant_desc'] = $merchant_desc;
			$aParam['longitude'] = isset($aData['longitude']) ? $aData['longitude'] : '';
			$aParam['latitude'] = isset($aData['latitude']) ? $aData['latitude'] : '';
			//TODO 要更改为false 不打印sql语句
			echo BaseFunctions::ouputToString($oMerchant->updateById($merchant_id,$aParam,true));
		}
	}
	
	public function actionTest(){
		$arr = "";
		echo "<xmp>";
		print_r($this->stringAndArray($arr,false));
		echo "</xmp>";
	}
	
	/**
	 * 设置营业时间
	 */
	public function actionSetBusinessHours(){
		
	}
	
	/**
	 * 设置商店状�?
	 */
	public function actionSetMerchantStatus(){
		
	}
	
	/**
	 * 获取商店信息
	 */
	public function actionGetMerchant(){
		$oMerchant = new Merchant();
		$aData = json_decode($_REQUEST['d'],true);
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		//获取展示列表
		$re = $oMerchant->getMerchantMsg($iMerchantId);
		if($re['type']&&isset($re['msg'][0]['id'])){
			$oImage = new ImageModel();
			$sStr = $re['msg'][0]['merchant_image'];
			$aImageList = $oImage->getImageList($sStr);
			$re['msg'][0]['merchant_image_arr'] = $aImageList['msg'];
		}
		//获取菜品列表
		BaseFunctions::ouputToString($re);
	}
	
	/**
	 * 设置桌面的数�?
	 */
	public function actionSetDesktop(){
		
	}
	
	/**
	 * 设置桌面的状�?
	 */
	public function actionSetDesktopStatus(){
		
	}
	
	/**
	 * add goods
	 */
	public function actionAddGoods(){
		
	}
	
	/**
	 * update goods
	 */
	public function actionUpdateGoods(){
		
	}
	
	/**
	 * change goods
	 */
	public function actionChangeGoods(){
		
	}
	
	/**
	 * get total desktop status
	 */
	public function actionTotalDesktopSta(){
		
	}
	
	/**
	 * get desktop list
	 */
	public function actionDesktopList(){
		
	}
	
	/**
	 * add book 
	 */
	public function actionAddBook(){
		
	}
	
	/**
	 * update book status
	 */
	public function actionChangeBookSta(){
		
	}
	
	/**
	 * get order list 
	 */
	public function actionOrderList(){
		
	}
	
	/**
	 * get message list
	 */
	public function actionMsgList(){
		
	}
	
	/**
	 * reply message
	 */
	public function actionReplyMsg(){
		
	}
	
	/**
	 * get message detail
	 */
	public function actionGetMsg(){
		
	}
	
	/**
	 * get coustomer list
	 */
	public function actionCustomerList(){
		
	}
	
	/**
	 * get customer detail message
	 */
	public function actionGetCustomer(){
		
	}
	
	/**
	 * merchant login
	 */
	public function actionModelLogin(){
		$oMer = new Merchant();
		$aResult = array();
// 		if ($this->checkData($_REQUEST)) {
			$aData = json_decode($_REQUEST['d'],true);
			$userName =isset($aData['accountName']) ? $aData['accountName'] : 'test';
			$password =isset($aData['password']) ? $aData['password'] : '123456';
			$aMerchantResult = $oMer->login($userName,$password);
			if ($aMerchantResult['type']) {
				$aModelArr =array();
// 				print_r($aMerchantResult['msg']);
				$aModelArr['user_name'] = $aMerchantResult['msg']['username'];
				$aModelArr['merchant_id'] = $aMerchantResult['msg']['merchant_id'];
				$aModelArr['id'] = $aMerchantResult['msg']['id'];
				echo BaseFunctions::ouputToString(BaseFunctions::returnResult(true, json_encode($aModelArr)));
			}else{
				echo BaseFunctions::ouputToString(BaseFunctions::returnResult(false, "数据库异常，请稍后"));
			}
// 		}else{
// 			echo BaseFunctions::ouputToString(BaseFunctions::returnResult(false, "错误验证"));
// 		}
	}
	
	/**
	 * 获取首页数据
	 */
	public function actionModelIndex(){
		$aData = json_decode($_REQUEST['d'],true);
		//BaseFunctions::writeLog(json_encode($aData));
// 		$aData = $_REQUEST;
		$iAddUser = isset($aData['user_id'])?$aData['user_id']:'';
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$o = new Book();
		$seatre = $o->getReach($iMerchantId);
		$sort = array();
		foreach ($seatre['msg'] as $sKey => $seat){
			
			$tempArr = array(
					'type' => '1',
					'status' => '1',
					'id'=>'1',
			);
			if ($seat>0) {
				$tempArr['name'] = "{$sKey}{$seat}";
			}else{
				$tempArr['name'] = "无";
			}
			$sort[] = $tempArr;
		}
		$sToday = date("Y-m-d");
		$sDefoutCondition = " merchange_id = {$iMerchantId} ";
		
		$criteria = new CDbCriteria();
		
		$criteria->condition = $sDefoutCondition.'  and (`status` = 0  ) and book_date = "'.$sToday.'"  ';
		
		$count = BookList::model()->count($criteria);
		
		
		$criteria->condition = $sDefoutCondition.'  and (`status` > 0  )  and book_date = "'.$sToday.'"   ';
		
		$count2 = BookList::model()->count($criteria);
		
		
		$criteria = new CDbCriteria();
		$criteria->condition = $sDefoutCondition.'  and (`status` <> -1  )  ';
		
		$allBook = BookList::model()->count($criteria);
		
		

		$criteria->condition = $sDefoutCondition.'  and (`status` = 3  )   and book_date = "'.$sToday.'"  ';// and take_out_date = "'.$sToday.'"
		
		$allTodayFinishSort = BookList::model()->count($criteria);
		
		$criteria->condition = $sDefoutCondition.'  and (`status` in (0,1,2)  )   and book_date = "'.$sToday.'"  ';// and take_out_date = "'.$sToday.'"
		
		$allTodayUnFinshSort = BookList::model()->count($criteria);
		
		//外卖开始
		$sDefoutCondition = " merchant_id = {$iMerchantId} ";
		
		$criteria->condition = $sDefoutCondition.'  and (`status` = 0  ) and take_out_date = "'.$sToday.'"    ';// and take_out_date = "'.$sToday.'" 
		
		$count3 = TakeOutList::model()->count($criteria);


		$criteria->condition = $sDefoutCondition.'  and (`status` > 0  ) and take_out_date = "'.$sToday.'"   ';// and take_out_date = "'.$sToday.'"  
		
		$count4 = TakeOutList::model()->count($criteria);
		
		$criteria->condition = $sDefoutCondition.'  and (`status` <> -1  )  ';// and take_out_date = "'.$sToday.'"
		
		$allTakeOut = TakeOutList::model()->count($criteria);
		
		$criteria->condition = $sDefoutCondition.'  and (`status` in (0,1,2,3)  )  ';// and take_out_date = "'.$sToday.'"
		
		$allSort = TakeOutList::model()->count($criteria);
		//判断状态座位信息
// 		$criteria->condition = $sDefoutCondition.'  and (`status` > 0  )  and book_date = "'.$sToday.'"   ';
		
// 		$count4 = TakeOutList::model()->count($criteria);
		
		$sDefoutCondition = " merchant_id = {$iMerchantId} ";
		$criteria->condition = $sDefoutCondition.' S and status = 1 and seat_type = "A"  ';
		
// 		$countA = OrMerchantSeat::model()->count($criteria);
// // 		$countA = $countA>0?0:1;
		
// 		$criteria->condition = $sDefoutCondition.' and status = 1 and seat_type = "B"  ';
		
// 		$countB = OrMerchantSeat::model()->count($criteria);
// // 		$countB = $countB>0?0:1;
// 		$criteria->condition = $sDefoutCondition.' and status = 1 and seat_type = "C"  ';
		
// 		$countC = OrMerchantSeat::model()->count($criteria);
// // 		$countC = $countC>0?0:1;
// 		$criteria->condition = $sDefoutCondition.' and status = 1 and seat_type = "D"  ';
		
// 		$countD = OrMerchantSeat::model()->count($criteria);
// // 		$countD = $countD>0?0:1;
		//所有客户的总数
		$sDefoutCondition = " mrchant_id = {$iMerchantId} ";
		$criteria->condition = $sDefoutCondition.'   ';// and take_out_date = "'.$sToday.'"
		
		
		$countcl = CustomerMsgList::model()->count($criteria);
		
		$oBook = new Book();
		$aBookArr = $oBook->getReach($iMerchantId);
		$aBookArr['msg']['A'] = $aBookArr['msg']['A']?$aBookArr['msg']['A']:'0';
		$aBookArr['msg']['B'] = $aBookArr['msg']['B']?$aBookArr['msg']['B']:'0';
		$aBookArr['msg']['C'] = $aBookArr['msg']['C']?$aBookArr['msg']['C']:'0';
		$aBookArr['msg']['D'] = $aBookArr['msg']['D']?$aBookArr['msg']['D']:'0';
		$uResult = array(
			'sort'=>$sort,
			'count'=>array(
               'book'=> array(
               		  'finish'=>$count2,
                      'waiting'=>$count ,
                      'bcount'=>$count2+$count
                      ),
              'takeout' => array(
              		  'finish'=>$count4,
                      'waiting'=>$count3  ,
                      'bcount'=>$count4+$count3   ,
                      ),
				 'sort' => array(
				 	  'finish'=>$allTodayFinishSort   ,
                      'waiting'=>$allTodayUnFinshSort   ,
                      'bcount'=>$allTodayFinishSort+$allTodayUnFinshSort    ,
                      	)),
          'seat'=> array('0'=>array(
          			'id'=>$aBookArr['msg']['A'],
          			'status'=>$countA    ,
					'type'=>'A'		 ,
                 	'name'=>"2"    ,
           ),'1'=>array(
          			'id'=>$aBookArr['msg']['B'],
          			'status'=>$countB    ,
					'type'=>'B'		 ,
                 	'name'=>"4"    ,
           ),'2'=>array(
          			'id'=>$aBookArr['msg']['C'],
          			'status'=>$countC    ,
					'type'=>'C'		 ,
                 	'name'=>"5-8"	    ,
           ),'3'=>array(
          			'id'=>$aBookArr['msg']['D'],
          			'status'=>$countD    ,
					'type'=>'D'		 ,
                 	'name'=>"包厢"	    ,
           ),
          ),
           'account'=> array(
           			'book'=>$allBook,
           			'takeout'=>$allTakeOut,
           			'sort'=>$allSort,
           			'client'=>$countcl
//                  'book'=>$count2+$count,
//                  'takeout'=>$count4+$count3,
//                  'sort'=>$count4+$count3+$count2+$count,
//                  'client'=>$countcl
           )

);
		$iMerchantId = isset($_REQUEST['d']['merchantId'])?$_REQUEST['d']['merchantId']:'';
		$oBook = new Book();
		$oMerSeat = new MerchantSeat();
		$oTakeOut = new TakeOutModel();
		
		//排队到号 A=>2�?B=>2�?人，C=>5-8�?D=>包厢
		$aReachArr = $oBook->getBookReachNum(0, $iMerchantId);
		//预约统计
		$iDaystar=strtotime("today");//今日零点的时间戳
		$iDayend=$daystar+"86400";//明日零点(今日24点）的时间戳
		$aTotal = $oBook->getBookTotal($iDaystar, $iDayend, $iMerchantId);
		//外卖统计 
		$aTakeOutTotal = $oTakeOut->getTotal($iDaystar, $iDayend, $iMerchantId);
		
		//排队统计 看预�?
		//楼面桌位统计 
		$aSeatTotal = $oMerSeat->getTotal($iMerchantId);
		//累计汇�?
		
		//订单走势 TODO 暂时不用�?
		
		//外卖统计
		
		//总共累计
		BaseFunctions::outputResult(true, $uResult);
	}
	
	public function actionUpVideo(){
		$aData = json_decode($_REQUEST['d'],true);
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$sVideo = isset($aData['merchant_video'])?$aData['merchant_video']:'';
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';
		$o = new Merchant();
		$re = $o->updateVideo($sVideo,$iMerchantId);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionDelVideo(){
		$aData = json_decode($_REQUEST['d'],true);
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';
		$o = new Merchant();
		$re = $o->delVideo($iMerchantId);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionUpSound(){
		$aData = json_decode($_REQUEST['d'],true);
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';
		$sSound = isset($aData['merchant_musice'])?$aData['merchant_musice']:'';
		$o = new Merchant();
		$re = $o->updateSound($sSound,$iMerchantId);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionDelSound(){
		$aData = json_decode($_REQUEST['d'],true);
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';
		$o = new Merchant();
		$re = $o->delSound($iMerchantId);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionUpImg(){
		$aData = json_decode($_REQUEST['d'],true);
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';
		$sImg = isset($aData['image'])?$aData['image']:"";
		$o = new Merchant();
		$re = $o->updateImage($sImg,$iMerchantId);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionDelImg(){
		$aData = json_decode($_REQUEST['d'],true);
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';
		$iImgId = isset($aData['imageId'])?$aData['imageId']:"";
		$o = new Merchant();
		$re = $o->delImage($iImgId,$iMerchantId);
		BaseFunctions::ouputToString($re);
	}
	
	public function actionGetBusinessTime(){
		$aData = json_decode($_REQUEST['d'],true);
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';
		$o = new Merchant();
		BaseFunctions::ouputToString($o->getBusinessTime($iMerchantId));
	}
	
	public function actionUpdateBusinessTime(){
		$aData = json_decode($_REQUEST['d'],true);
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';
		$sStartTime = isset($aData["merchant_start_time"])?$aData["merchant_start_time"]:'';
		$sEndTime = isset($aData["merchant_end_time"])?$aData["merchant_end_time"]:'';
		$business_type = isset($aData["business_type"])?$aData["business_type"]:'';
		$status = isset($aData["status"])?$aData["status"]:'0';
		$o = new Merchant();
		BaseFunctions::ouputToString($o->upBusinessTime($iMerchantId,$sStartTime,$sEndTime,$business_type,$status));
	}
	
	public function actionMerchantList(){
		$aData = json_decode($_REQUEST['d'],true);
		$lat = isset($aData['lat'])?$aData['lat']:'';
		$long = isset($aData['long'])?$aData['long']:'';
		$o = new Merchant();
		$re = $o->getReferralsList("*");
		$rRe = array();
		$aServer = $this->getConfigArr("freeSer");
		foreach ($re as $o){
			$aTemp = array();
			$aTemp['merchant_name'] = $o->merchant_name;
			$aTemp['merchant_branch'] = $o->merchant_branch;
			$aTemp['merchant_alias'] = $o->merchant_alias;
			$aTemp['merchant_logo'] = $o->merchant_logo;
			$aTemp['merchant_image'] = $o->merchant_image;
			$aTemp['merchant_sounds'] = $o->merchant_sounds;
			$aTemp['merchant_video'] = $o->merchant_video;
			$aTemp['merchant_desc'] = $o->merchant_desc;
			$aTemp['taste_sec'] = $o->taste_sec;
			$aTemp['environmental_sec'] = $o->environmental_sec;
			$aTemp['service_sec'] = $o->service_sec;
			$aTemp['longitude'] = $o->longitude;
			$aTemp['latitude'] = $o->latitude;
			$aTemp['altitude'] = $o->altitude;
			$aTemp['address'] = $o->address;
			$aTemp['merchant_call'] = $o->merchant_call;
			$aTemp['merchant_traffic'] = $o->merchant_traffic;
			$aTemp['merchant_wifi'] = $o->merchant_wifi;
			$aTemp['merchant_marketing_num'] = $o->merchant_marketing_num;
			$aTemp['merchant_per'] = $o->merchant_per;
			$aTemp['merchant_star'] = $o->merchant_star;
			$aTemp['merchant_start_time'] = $o->merchant_start_time;
			$aTemp['merchant_end_time'] = $o->merchant_end_time;
			$aTemp['score'] = $o->score;
			$aTemp['score_taste'] = $o->score_taste;
			$aTemp['score_envirement'] = $o->score_envirement;
			$aTemp['score_service'] = $o->score_service;
			$aTemp['good_num'] = $o->good_num;
			$aTemp['user_id'] = $o->user_id;
			$aTemp['status'] = $o->status;
			$aTemp['merchant_othername'] = $o->merchant_othername;
			$aTemp['merchant_manager'] = $o->merchant_manager;
			$aTemp['merchant_manager_phone'] = $o->merchant_manager_phone;
			$aTemp['merchant_phone'] = $o->merchant_phone;
			$aTemp['pro'] = $o->pro;
			$aTemp['city'] = $o->city;
			$aTemp['area'] = $o->area;
			$aTemp['free_service'] = $o->free_service;
			$aTemp['merchant_tag'] = $o->merchant_tag;
			$aTemp['merchant_ser'] = $o->merchant_ser;
			$aTemp['business_type'] = $o->business_type;
			$aTemp['referrals'] = $o->referrals;
			$aTemp['id'] = $o->id;
			//名字
			$aTemp['merchant_name'] = $o->merchant_name;
			//平均
			$aTemp['merchant_per'] = $o->merchant_per;
			//手机
			$aTemp['merchant_phone'] = $o->merchant_phone;
			//服务列表
			$aTemp['free_service'] = $this->changeToAr($o->free_service,$aServer);
			//评分
			$aTemp['score'] = $o->score;
			//
			$aTemp['merchant_logo'] = $this->changeUrl($o->merchant_logo);
			$rRe[] = $aTemp;
		}
		BaseFunctions::outputResult(true, $rRe);
	}
	
	public function actionGetNearMerchant(){
		$aData = json_decode($_REQUEST['d'],true);
		$lat = isset($aData['lat'])?$aData['lat']:'';
		$long = isset($aData['long'])?$aData['long']:'';
		$o = new Merchant();
		$re = $o->getNearbyMerchant("*");
		$rRe = array();
		$aServer = $this->getConfigArr("freeSer");
		foreach ($re as $o){
			$aTemp = array();
			$aTemp['merchant_name'] = $o->merchant_name;
			$aTemp['merchant_branch'] = $o->merchant_branch;
			$aTemp['merchant_alias'] = $o->merchant_alias;
			$aTemp['merchant_logo'] = $o->merchant_logo;
			$aTemp['merchant_image'] = $o->merchant_image;
			$aTemp['merchant_sounds'] = $o->merchant_sounds;
			$aTemp['merchant_video'] = $o->merchant_video;
			$aTemp['merchant_desc'] = $o->merchant_desc;
			$aTemp['taste_sec'] = $o->taste_sec;
			$aTemp['environmental_sec'] = $o->environmental_sec;
			$aTemp['service_sec'] = $o->service_sec;
			$aTemp['longitude'] = $o->longitude;
			$aTemp['latitude'] = $o->latitude;
			$aTemp['altitude'] = $o->altitude;
			$aTemp['address'] = $o->address;
			$aTemp['merchant_call'] = $o->merchant_call;
			$aTemp['merchant_traffic'] = $o->merchant_traffic;
			$aTemp['merchant_wifi'] = $o->merchant_wifi;
			$aTemp['merchant_marketing_num'] = $o->merchant_marketing_num;
			$aTemp['merchant_per'] = $o->merchant_per;
			$aTemp['merchant_star'] = $o->merchant_star;
			$aTemp['merchant_start_time'] = $o->merchant_start_time;
			$aTemp['merchant_end_time'] = $o->merchant_end_time;
			$aTemp['score'] = $o->score;
			$aTemp['score_taste'] = $o->score_taste;
			$aTemp['score_envirement'] = $o->score_envirement;
			$aTemp['score_service'] = $o->score_service;
			$aTemp['good_num'] = $o->good_num;
			$aTemp['user_id'] = $o->user_id;
			$aTemp['status'] = $o->status;
			$aTemp['merchant_othername'] = $o->merchant_othername;
			$aTemp['merchant_manager'] = $o->merchant_manager;
			$aTemp['merchant_manager_phone'] = $o->merchant_manager_phone;
			$aTemp['merchant_phone'] = $o->merchant_phone;
			$aTemp['pro'] = $o->pro;
			$aTemp['city'] = $o->city;
			$aTemp['area'] = $o->area;
			$aTemp['free_service'] = $o->free_service;
			$aTemp['merchant_tag'] = $o->merchant_tag;
			$aTemp['merchant_ser'] = $o->merchant_ser;
			$aTemp['business_type'] = $o->business_type;
			$aTemp['referrals'] = $o->referrals;
			$aTemp['id'] = $o->id;
			//名字
			$aTemp['merchant_name'] = $o->merchant_name;
			//平均
			$aTemp['merchant_per'] = $o->merchant_per;
			//手机
			$aTemp['merchant_phone'] = $o->merchant_phone;
			//服务列表
			$aTemp['free_service'] = $this->changeToAr($o->free_service,$aServer);
			//评分
			$aTemp['score'] = $o->score;
			//
			$aTemp['merchant_logo'] = $this->changeUrl($o->merchant_logo);//$o->merchant_logo;
			$rRe[] = $aTemp;
		}
		BaseFunctions::outputResult(true, $rRe);
	}
	
	public function actionGetNearTakeOutMerchant(){
		$aData = json_decode($_REQUEST['d'],true);
		$lat = isset($aData['lat'])?$aData['lat']:'';
		$long = isset($aData['long'])?$aData['long']:'';
		$o = new Merchant();
		$condition = " `merchant_ser` like '%,5,%' ";
		$re = $o->getNearbyMerchant("*",$condition);
		$rRe = array();
		$aServer = $this->getConfigArr("freeSer");
		foreach ($re as $o){
			$aTemp = array();
			$aTemp['id'] = $o->id;
			//名字
			$aTemp['merchant_name'] = $o->merchant_name;
			//平均
			$aTemp['merchant_per'] = $o->merchant_per;
			//手机
			$aTemp['merchant_phone'] = $o->merchant_phone;
			//服务列表
			$aTemp['free_service'] = $this->changeToAr($o->free_service,$aServer);
			//评分
			$aTemp['score'] = $o->score;
			//
			$aTemp['merchant_logo'] = $this->changeUrl($o->merchant_logo);//$o->merchant_logo;
			$rRe[] = $aTemp;
		}
		BaseFunctions::outputResult(true, $rRe);
	}
	
	public function actionGetModelIndex(){
		//获取商家信息
		$aData = json_decode($_REQUEST['d'],true);
// 		$aData = $_REQUEST;
		
		$iMerId =  isset($aData['merchant_id'])?$aData['merchant_id']:'1';
		if (!$iMerId) {
			BaseFunctions::outputResult(false, array());
			return;
		}
		$o = new Merchant();
		$aMerchantMsg = $o->findById($iMerId);
		if (!isset($aMerchantMsg['msg'][0]['id'])) {
			BaseFunctions::outputResult(false, array());
			return;
		}
		$aResultArr =array();
		$aResultArr += $aMerchantMsg['msg'][0];
		//获取环境图片
			$oImage = new ImageModel();
			$sStr = $aResultArr['merchant_image'];
			$aImageList = $oImage->getImageList($sStr);
			foreach ($aImageList['msg'] as $keyImage => $valueImage) {
				$aImageList['msg'][$keyImage]['image_link'] = "http://testadmin.77tng.com/files/".$aImageList['msg'][$keyImage]['image_link'];
			}

			$aResultArr['merchant_image_arr'] = $aImageList['msg'];
		//goods list 
		$oGood = new GoodsModel();
		$aMenuList = $oGood->getMerchantMenuList($iMerId,"*");
		$aResultMenuList = array();
		foreach ($aMenuList as $menu){
			$aTemp = array();
			$aTemp['id'] = $menu->id;
			$aTemp['goods_id'] = $menu->goods_id;
			$aTemp['goods_name'] = $menu->goods_name;
			$aTemp['goods_pice'] = $menu->goods_pice;
			$aTemp['goods_real_pice'] = $menu->goods_real_pice;
			$aTemp['goods_style'] = $menu->goods_style;
			$aTemp['goods_taste'] = $menu->goods_taste;
			$aTemp['goods_evaluation'] = $menu->goods_evaluation;
			$aTemp['goods_desc'] = $menu->goods_desc;
			$aTemp['goods_image'] = "http://testadmin.77tng.com/files/".$menu->goods_image;
			$aTemp['goods_up_time'] = $menu->goods_up_time;
			$aTemp['goods_modify_time'] = $menu->goods_modify_time;
			$aTemp['goods_comment_num'] = $menu->goods_comment_num;
			$aTemp['goods_marketing_num'] = $menu->goods_marketing_num;
			$aTemp['goods_visit_times'] = $menu->goods_visit_times;
			$aTemp['good_num'] = $menu->good_num;
			$aTemp['share_times'] = $menu->share_times;
			$aTemp['sound_times'] = $menu->sound_times;
			$aTemp['goods_remain'] = $menu->goods_remain;
			$aTemp['goods_image_list'] = $menu->goods_image_list;
			
			$sStr = $aResultArr['goods_image_list'];
			$aImageList = $oImage->getImageList($sStr);
			foreach ($aImageList['msg'] as $keyImage => $valueImage) {
				$aImageList['msg'][$keyImage]['image_link'] = "http://testadmin.77tng.com/files/".$aImageList['msg'][$keyImage]['image_link'];
			}
			
			$aTemp['goods_image_arr'] = $aImageList['msg'];

			$aTemp['goods_over_time'] = $menu->goods_over_time;
			$aTemp['goods_type'] = $menu->goods_type;
			$aTemp['goods_virtual_gold'] = $menu->goods_virtual_gold;
			$aTemp['goods_real_virtual_gold'] = $menu->goods_real_virtual_gold;
			$aTemp['goods_cat'] = $menu->goods_cat;
			$aTemp['goods_tag'] = $menu->goods_tag;
			$aTemp['goods_sounds'] = $menu->goods_sounds;
			$aTemp['recommend'] = $menu->recommend;
			$aTemp['merchant_id'] = $menu->merchant_id;
			$aTemp['status'] = $menu->status;
			$aTemp['goods_taste_tag'] = $menu->goods_taste_tag;
			$aTemp['goods_sale_type'] = $menu->goods_sale_type;
			$aTemp['goods_correlate'] = $menu->goods_correlate;
			$aTemp['add_user_id'] = $menu->add_user_id;
			$aTemp['goods_v_type'] = $menu->goods_v_type;
			$aTemp['t_begin_time'] = $menu->t_begin_time;
			$aTemp['t_end_time'] = $menu->t_end_time;
			$aTemp['pri_time_per'] = $menu->pri_time_per;
			$aTemp['pri_goods_list'] = $menu->pri_goods_list;
			$aTemp['pri_goods_per'] = $menu->pri_goods_per;
			$aTemp['vip_per'] = $menu->vip_per;
			$aTemp['per_type'] = $menu->per_type;
			$aTemp['varil_begin_time'] = $menu->varil_begin_time;
			$aTemp['varil_end_time'] = $menu->varil_end_time;
			$aTemp['add_time'] = $menu->add_time;
			$aTemp['goods_or_num'] = $menu->goods_or_num;
			$aTemp['pri_money'] = $menu->pri_money;
			$aTemp['pro_list'] = $menu->pro_list;
			$aTemp['cou_list'] = $menu->cou_list;
			$aTemp['goods_share_num'] = $menu->goods_share_num;
			$aTemp['translate_type'] = $menu->translate_type;
			$aTemp['sendout_num'] = $menu->sendout_num;
			$aTemp['use_num'] = $menu->use_num;
			$aTemp['view_num'] = $menu->view_num;
			$aTemp['translation_num'] = $menu->translation_num;
			$aTemp['be_good_num'] = $menu->be_good_num;
			$aTemp['be_book_num'] = $menu->be_book_num;
			$aResultMenuList[] = $aTemp;
		}
		$aResultArr['menu_list'] = $aResultMenuList;
		//优惠卷统计
		$aResultArr['coupon_count'] = $o->countCounpon($iMerId);
		//优惠信息统计
		$aResultArr['team_activity_count'] = $o->countTeamActivity($iMerId);
		//最新优惠卷
		$oCoup = new Coupon();
		$aCoup = $oCoup->getNewCoup($iMerId);
		$aCoup = $aCoup['msg'];
		$aResultArr['coup'] = $aCoup;
		//最新促销卷
		$oPro = new Promotions();	
		$aPro = $oPro->getNewPro($iMerId);
		$aPro = $aPro['msg'];
		$aResultArr['pro'] = $aPro;
		
		BaseFunctions::outputResult(true, $aResultArr);
	}
	
	/**
	 * 添加订单
	 */
	public function actionAddOrder(){
		
	}
}
?>
