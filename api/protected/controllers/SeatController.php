<?php

class SeatController extends BaseController{
	
	/**
	 * 添加区域
	 */
	public function actionAddArea(){
		$oSeatArea = new SeatArea();
		$aData = json_decode($_REQUEST['d'],true);
		$merchant_id = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$area_name = isset($aData['area_name'])?$aData['area_name']:'';
		BaseFunctions::ouputToString($oSeatArea->addArea($merchant_id,$area_name));
	}
	
	/**
	 * 删除区域
	 */
	public function actionDelArea(){
		
	}
	
	/**
	 * 添加楼面座位
	 */
	public function actionUpdateSeat(){
		$oSeat = new Seat();
		$aData = json_decode($_REQUEST['d'],true);
		$aParam = array();
		$id = isset($aData['seat_id'])?$aData['seat_id']:'';
		$aParam['merchant_id'] = isset($aData['merchant_id'])?$aData['merchant_id']:'';// NOT NULL,
		$aParam['seat_type'] = isset($aData['seat_type'])?$aData['seat_type']:'';// NOT NULL,
		$aParam['min_num'] = isset($aData['min_num'])?$aData['min_num']:'';// NOT NULL COMMENT '最小人数',
		$aParam['max_num'] = isset($aData['max_num'])?$aData['max_num']:'';// NOT NULL COMMENT '最大人数',
		$aParam['status'] = isset($aData['status'])?$aData['status']:'';// NOT NULL,
		$aParam['desc'] = isset($aData['desc'])?$aData['desc']:'';// '描述',
		$aParam['at_area'] = isset($aData['at_area'])?$aData['at_area']:'';//
		$oSeat->updateById($id, $aParam);
		//ok
	}
	
	/**
	 * 更新楼面座位
	 */
	public function actionAddSeat(){
		$oSeat = new Seat();
		$aData = json_decode($_REQUEST['d'],true);
		$aParam = array();
		$aParam['merchant_id'] = isset($aData['merchant_id'])?$aData['merchant_id']:'';// NOT NULL,
		$aParam['seat_type'] = isset($aData['seat_type'])?$aData['seat_type']:'';// NOT NULL,
		$aParam['min_num'] = isset($aData['min_num'])?$aData['min_num']:'';// NOT NULL COMMENT '最小人数',
		$aParam['max_num'] = isset($aData['max_num'])?$aData['max_num']:'';// NOT NULL COMMENT '最大人数',
		$aParam['status'] = isset($aData['status'])?$aData['status']:'';// NOT NULL,
		$aParam['desc'] = isset($aData['desc'])?$aData['desc']:'';// '描述',
		$aParam['at_area'] = isset($aData['at_area'])?$aData['at_area']:'';//seat_num
		$aParam['seat_num'] = isset($aData['seat_num'])?$aData['seat_num']:'';
		$oSeat->add($aParam);
		//ok
	}
	
	/**
	 * 获取楼面区域
	 */
	public function actionGetSeatArea(){
		$oSeatArea = new SeatArea();
		$aData = json_decode($_REQUEST['d'],true);
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$aSeatArea = $oSeatArea->getMerchantSeatArea($iMerchantId);
		$aResult = array();
		if (is_array($aSeatArea['msg'])) {
			foreach ($aSeatArea['msg'] as $iK => $sV){
				$aResult[$sV['id']] = $sV['area_name'];
			}
		}
		BaseFunctions::outputResult(true, $aResult);
	}
	
	public function actionChangeSeatStatus(){
		$oSeatArea = new Seat();
		$aData = json_decode($_REQUEST['d'],true);
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$iStatus = isset($aData['status'])?$aData['status']:'';
		$id = isset($aData['changeId'])?$aData['changeId']:'';
		$aRR = $oSeatArea->changeSeatStatus($iMerchantId,$id,$iStatus);
		BaseFunctions::ouputToString($aRR);
		
	}
	
	public function actionChangeAreaStatus(){
		$oSeatArea = new SeatArea();
		$aData = json_decode($_REQUEST['d'],true);
		$iMerchantId = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$iStatus = isset($aData['status'])?$aData['status']:'';
		$id = isset($aData['changeId'])?$aData['changeId']:'';
		$aRR = $oSeatArea->changeAreaStatus($iMerchantId,$id,$iStatus,true);
		if ($aRR['type']) {
			BaseFunctions::outputResult(true, "修改成功!");
		}else{
			BaseFunctions::outputResult(false, "错误!");
		}
	}
	
	private function dealModelOutput($o){
		$re = array();
		$re['id'] =$o->id;
		$re['merchant_id'] =$o->merchant_id;
		$re['seat_type'] =$o->seat_type;
		$re['min_num'] =$o->min_num;
		$re['max_num'] =$o->max_num;
		$re['status'] =$o->status;
		$re['desc'] =$o->desc;
		$re['at_area'] =$o->at_area;
		$re['seat_num'] = $o->seat_num;
		return $re;
	}
	
	public function actionSeatList(){
		//区域处理
		$aData = json_decode($_REQUEST['d'],true);
		
		$merid = isset($aData['merchant_id'])?$aData['merchant_id']:'1';
		
		$iStatus = isset($aData['status'])?$aData['status']:'1';
		//$merid = 1;
		$SeatAreacriteria = new CDbCriteria();
		
		$SeatAreacriteria->order = ' id DESC ';
		
		$SeatAreacriteria->condition = ' merchant_id = "'.$merid.'" ';
		
		$SeatAreacount = SeatAreaModel::model()->count($SeatAreacriteria);
		
		$Seatpages = new CPagination($SeatAreacount);
		
		$Seatpages->pageSize = 1000;
		
		$Seatpages->applyLimit($SeatAreacriteria);

		$Seatlist = SeatAreaModel::model()->findAll($SeatAreacriteria);
		$arrSeatList =array();
		foreach ($Seatlist as $iSeatList => $aSeatList){
			$arrSeatList[$aSeatList->id] = $aSeatList->area_name;
		}
		
		//在用的
		$criteria = new CDbCriteria();
		
		$criteria->order = 'id DESC';
		
		$criteria->condition = $iStatus == 1?' status <> 2  and merchant_id = "'.$merid.'" ':' status = 2  and merchant_id = "'.$merid.'" ';
		
		$count = OrMerchantSeatModel::model()->count($criteria);
		
		$pages = new CPagination($count);
		
		$pages->pageSize = 1000;
		
		$pages->applyLimit($criteria);
		
		$list = OrMerchantSeatModel::model()->findAll($criteria);
		//重构
		$aOutResult = array();
		$arrListResult = array();
		foreach ($list as $iList => $arrList){
			$arrListResult[$arrList->at_area][] = $this->dealModelOutput($arrList);
		}
		foreach ($Seatlist as $iSeatList => $aSeatList){
			$aTempArr = array();
			$aTempArr['id']= $aSeatList->id;
			$aTempArr['name']= $aSeatList->area_name;
			$aTempArr['seat']= $arrListResult[$aSeatList->id]?$arrListResult[$aSeatList->id]:array();
			if (!$aTempArr['seat']) {
				//;
			}else{
				$aOutResult[]=$aTempArr;
			}
		}
		
		
		//找出所有的区域
		BaseFunctions::outputResult(true, $aOutResult);
		//$this->render('seat', array('areaList'=>$arrSeatList,'list' => $arrListResult, 'pages' => $pages,'list2' => $arrListResult2, 'pages2' => $pages2,"oModer"=>new OrMerchantSeat()));
	}
	
	public function actionGetFreeSeatList(){
		
		$aData = json_decode($_REQUEST['d'],true);
// 		$aData = $_REQUEST;
		$merid = isset($aData['merchant_id'])?$aData['merchant_id']:'1';
		
		$iStatus = isset($aData['type'])?$aData['type']:'A';
		
		$criteria = new CDbCriteria();
		
		$criteria->order = " seat_type = '$iStatus' desc ";
		
		//所有状态为1的
		$criteria->condition = ' status = 1  and merchant_id = "'.$merid.'" ';
		
		$count = OrMerchantSeatModel::model()->count($criteria);
		
		$pages = new CPagination($count);
		
		$pages->pageSize = 1000;
		
		$pages->applyLimit($criteria);
		
		$list = OrMerchantSeatModel::model()->findAll($criteria);
		$aRe = array();
		foreach ($list as $oo){
			$rRe = array();
			$rRe['id'] = isset($oo->id)?$oo->id:'';
			$rRe['merchant_id'] = isset($oo->merchant_id)?$oo->merchant_id:'';
			$rRe['seat_type'] = isset($oo->seat_type)?$oo->seat_type:'';
			$rRe['min_num'] = isset($oo->min_num)?$oo->min_num:'';
			$rRe['max_num'] = isset($oo->max_num)?$oo->max_num:'';
			$rRe['status'] = isset($oo->status)?$oo->status:'';
			$rRe['desc'] = isset($oo->desc)?$oo->desc:'';
			$rRe['at_area'] = isset($oo->at_area)?$oo->at_area:'';
			$rRe['seat_num'] = isset($oo->seat_num)?$oo->seat_num:'';
			$aRe[] = $rRe;
		}
		BaseFunctions::outputResult(true, $aRe);
	}
	
	public function actionCheckSeat(){
		$aData = json_decode($_REQUEST['d'],true);
		
		$merid = isset($aData['merchant_id'])?$aData['merchant_id']:'';
		
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'';
		$iSeatId = isset($aData['id'])?$aData['id']:'';
		$oBook = new Book();
		$o = new Seat();
		// 判断是否够时间
		$sFindStr = "*";
		$sWhereStr = " `book_seat_id` = {$iSeatId} and `status` = 3 ";
		$aIsAtUse = $oBook->find ( $sFindStr, $sWhereStr ,true);
		$iNowTime = time();
		$iRelyTime = 30 * 60;
		BaseFunctions::writeLog(json_encode($aIsAtUse));
		if (isset ( $aIsAtUse ['msg'] [0] )) {
			$reach_time = $aIsAtUse ['msg'] [0] ['begin_time'] ? $aIsAtUse ['msg'] [0] ['begin_time'] : 0;
			BaseFunctions::writeLog("iNowTime22222222222:$iNowTime  iAddTime :$iAddTime + reach_time : $reach_time + iRelyTime: $iRelyTime");
			if ($iNowTime > $reach_time + $iRelyTime) {
				BaseFunctions::outputResult(true, '');
				return;
			}
			BaseFunctions::outputResult(false, '');
				return;
		}else{
			BaseFunctions::outputResult(true, '');
				return;
		}
	}
}

?>