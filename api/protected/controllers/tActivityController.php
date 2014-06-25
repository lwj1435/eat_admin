<?php
class ActivityController extends BaseController{
	//试吃列表
	public function actionAcList(){
		$o =  new Activity();
		$re = $o->getReferrals("*");
		$aRe = array();
		foreach ($re as $item){
			$aTemp = array();
		      $aTemp['id']= $item->id;
		      $aTemp['user_id']= $item->user_id;
		      $aTemp['user_name']= $item->user_name;
		      $aTemp['activity_type']= $item->activity_type;
		      $aTemp['activity_name']= $item->activity_name;
		      $aTemp['activity_content']= $item->activity_content;
		      $aTemp['start_time']= $item->start_time;
		      $aTemp['end_time']= $item->end_time;
		      $aTemp['join_num']= $item->join_num;
		      $aTemp['real_join']= $item->real_join;
		      $aTemp['desc']= $item->desc;
		      $aTemp['logo']= $item->logo;
		      $aTemp['merchant_id']= $item->merchant_id;
		      $aTemp['at_object']= $item->at_object;
		      $aTemp['address']= $item->address;
		      $aTemp['long']= $item->long;
		      $aTemp['lat']= $item->lat;
		      $aTemp['status']= $item->status;
		      $aTemp['join_time_start']= $item->join_time_start;
		      $aTemp['join_end_time']= $item->join_end_time;
		      $aTemp['image_list']= $item->image_list;
		      $aTemp['phone']= $item->phone;
		      $aTemp['num']= $item->num;

		      //TODO 添加用户
		      $aTemp['add_user_id']= '1';
		      $aTemp['add_user_name']= 'test';
		      $aTemp['add_user_logo']= '';
		      //喜爱数量
		      $aTemp['like_num']= 10;
		      //浏览数量
		      $aTemp['view_num']= 20;
		      if ($item->actiMerMsg) {
		      	$aTemp['merchant_name'] = $item->actiMerMsg->merchant_name;
		      }
			 $aRe[] =$aTemp;
		}
		BaseFunctions::outputResult(true, $aRe);
	}
	
	//加入活动
	public function actionJoinAc(){
		$o = new ActivityJoinUserModel();
		$aData = json_decode($_REQUEST['d'],true);
		$iAddUserId = $aData['user_id']?$aData['user_id']:'';
		$iAtId = $aData['ac_id']?$aData['at_id']:'';
		if (!$oAtId) {
			BaseFunctions::outputResult(false, array("ER00031","请选择一个活动"));
			return ;
		}
		$re = $o->addActivityJoinUser($iAtId,$iAddUserId);
		BaseFunctions::outputResult(true, $re);
	}
	
	//添加日子，活试吃大会的评论
	public function actionAddNote(){
		$aData = json_decode($_REQUEST['d'],true);
		$iMerId =  isset($aData['merchant_id'])?$aData['merchant_id']:'';
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'1';
		
		$sContext =  isset($aData['context'])?$aData['context']:'test';//点评内容
		$fEvaluate = isset($aData['evaluate'])?$aData['evaluate']:'5';//评分
		$fPer = isset($aData['per'])?$aData['per']:'10.0';
		$aImageList = isset($aData['image_list'])?$aData['image_list']:'';
		$sTitle = isset($aData['title'])?$aData['title']:'好味道';//标题
		$sMerName = isset($aData['mer_name'])?$aData['mer_name']:'广州分店';//店名字
		$sMerFeel = isset($aData['mer_feel'])?$aData['mer_feel']:'很好';//店第一感觉
		$sArea = isset($aData['area'])?$aData['area']:'001';//店所在的地区
		$sCity = isset($aData['city'])?$aData['city']:'002';//店所在的城市
		$sPro = isset($aData['pro'])?$aData['pro']:'001';//店所在的省份
		$sAddress = isset($aData['address'])?$aData['address']:'广州大道';//店所在地址
		$iActivityId = isset($aData['at_id'])?$aData['at_id']:'1';//活动id
		$iper_status_id = isset($aData['per_status_id'])?$aData['per_status_id']:'1';//per的id
		$iper_status = isset($aData['per_status'])?$aData['per_status']:'1';//更改为的状态
		//更改状态
		$oDetail = new ActivityJoinUserModel();
		$oDetail->updateActivityJoinUser($iper_status_id,$iActivityId,$iUserId,$iper_status);
		$o = new ArticleModel();
		$re = $o->addEssay($iMerId,$sTitle,$sContext,$fEvaluate,$fPer,$aImageList,$iUserId,$sMerName,$sMerFeel,$sArea,$sCity,$sPro,$iActivityId,$sAddress);
		BaseFunctions::outputResult(true, $re);
	}
	
	//用户note列表
	public function actionNoteList(){
		$aData = json_decode($_REQUEST['d'],true);
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'1';
		$select = "*";
		$where=" 1 ";
		$pro='';
		$area='';
		$city='';
		$startPage=isset($aData['page'])?$aData['page']:1;
		$pageNum=isset($aData['num'])?$aData['num']:10;;
		$count=isset($aData['count'])?$aData['count']:1;
		$group='';
		$order='';
		$o = new ArticleModel();
		$aArticleArr = $o->getUserNoteList($select, $iUserId,$where, $pro,$area,$city,$startPage, $pageNum, $count,$group, $order);
		$reArr = array();
		foreach ($aArticleArr as $o){
			$re = array();
			$re['id'] = $o->id;
			$re['parent_id'] = $o->parent_id;
			$re['conment'] = $o->conment;
			$re['type'] = $o->type;
			$re['article_time'] = $o->article_time;
			$re['modify_time'] = $o->modify_time;
			$re['user_id'] = $o->user_id;
			$re['user_name'] = $o->user_name;
			$re['account_name'] = $o->account_name;
			$re['follow_num'] = $o->follow_num;
			$re['status'] = $o->status;
			$re['evaluate'] = $o->evaluate;
			$re['merchant_id'] = $o->merchant_id;
			$re['per'] = $o->per;
			$re['image_list'] = $o->image_list;
			$re['view_num'] = $o->view_num;
			$re['love_num'] = $o->love_num;
			$re['merchant_name'] = $o->merchant_name;
			$re['merchant_feel'] = $o->merchant_feel;
			$re['pro'] = $o->pro;
			$re['city'] = $o->city;
			$re['area'] = $o->area;
			$re['activity_id'] = $o->activity_id;
			$re['address'] = $o->address;
			$reArr[] = $re;
		}
		BaseFunctions::outputResult(true, $reArr);
// 		echo "<xmp>";
// 		print_r($re);
// 		echo "</xmp>";
// 		return;
	}
	
	//个人试吃列表
	public function actionPersonList(){
		$aData = json_decode($_REQUEST['d'],true);
		$iUserId = isset($aData['user_id'])?$aData['user_id']:'1';
		$o =  new ActivityListModel();
		$sWhere = " joinList.user_id = {$iUserId} ";
		$re = $o->getUserJoinAc("*",$sWhere);

		foreach ($re as $item){

			$aTemp = array();
			$aTemp['id']= $item->id;
			$aTemp['user_id']= $item->user_id;
			$aTemp['user_name']= $item->user_name;
			$aTemp['activity_type']= $item->activity_type;
			$aTemp['activity_name']= $item->activity_name;
			$aTemp['activity_content']= $item->activity_content;
			$aTemp['start_time']= $item->start_time;
			$aTemp['end_time']= $item->end_time;
			$aTemp['join_num']= $item->join_num;
			$aTemp['real_join']= $item->real_join;
			$aTemp['desc']= $item->desc;
			$aTemp['logo']= $item->logo;
			$aTemp['merchant_id']= $item->merchant_id;
			$aTemp['at_object']= $item->at_object;
			$aTemp['address']= $item->address;
			$aTemp['long']= $item->long;
			$aTemp['lat']= $item->lat;
			$aTemp['status']= $item->status;
			$aTemp['join_time_start']= $item->join_time_start;
			$aTemp['join_end_time']= $item->join_end_time;
			$aTemp['image_list']= $item->image_list;
			$aTemp['phone']= $item->phone;
			$aTemp['num']= $item->num;
			$aRRss = $item->joinList;
			$aTemp['per_status']= $aRRss[0]->status;
			$aTemp['per_status_id']= $aRRss[0]->id;
// 			if ($item->actiMerMsg) {
// 				$aTemp['merchant_name'] = $item->actiMerMsg->merchant_name;
// 			}
			$aRe[] =$aTemp;
		}
		BaseFunctions::outputResult(true, $aRe);
	}
	
	/**
	 * 添加试食活动
	 */
	public function actionAddFreeFoodActivity(){
		$aData = json_decode($_REQUEST['d'],true);
		$iAddUserId = $aData['user_id']?$aData['user_id']:'';
		$sActivityName = $aData['activity_name']?$aData['activity_name']:'';
		$iStartTime = $aData['start_time']?$aData['start_time']:'';
		$iEndTime = $aData['end_time']?$aData['end_time']:'';
		$iMerchantId = $aData['merchant_id']?$aData['merchant_id']:'';
		$sContent = $aData['content']?$aData['content']:'';
		$sDesc = $aData['desc']?$aData['desc']:'';
		$sName=$sActivityName;
		$o = new Activity();
		$iType = 1;
		$re = $o->addActivity($iAddUserId,$sName,$sContent,$iMerchantId,$iType,$sActivityName,$sDesc,'');
		//TODO 添加免费试食具体表的内容
	}
	
	/**
	 * 添加搭食
	 */
	public function actionTakeTheFood(){
		$aData = json_decode($_REQUEST['d'],true);
		$iAddUserId = $aData['user_id']?$aData['user_id']:'';
		$sActivityName = $aData['activity_name']?$aData['activity_name']:'';
		$iStartTime = $aData['start_time']?$aData['start_time']:'';
		$iEndTime = $aData['end_time']?$aData['end_time']:'';
		$iMerchantId = $aData['merchant_id']?$aData['merchant_id']:'';
		$sContent = $aData['content']?$aData['content']:'';
		$sDesc = $aData['desc']?$aData['desc']:'';
		$sName=$sActivityName;
		$o = new Activity();
		$iType = 1;
		$re = $o->addActivity($iAddUserId,$sName,$sContent,$iMerchantId,$iType,$sActivityName,$sDesc,'');
		//添加搭食的记录
	}

	public function actionList(){
		$aData = json_decode($_REQUEST['d'],true);
		$iAddUserId = $aData['user_id']?$aData['user_id']:'';
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
		
		$criteria->condition .= '  and `status` = "0"  ';
		
		$criteria->limit =$ilimit;
		
		$criteria->offset =$iPageNum*($pageVar-1);

		$list = ActivityList::model()->findAll($criteria);
		$aRe = array();
		foreach ($list as $key => $item) {
			$re = array();
			$re['id'] = $item->id;
			$re['user_id'] = $item->user_id;
			$re['user_name'] = $item->user_name;
			$re['activity_type'] = $item->activity_type;
			$re['activity_name'] = $item->activity_name;
			$re['activity_content'] = $item->activity_content;
			$re['start_time'] = $item->start_time;
			$re['end_time'] = $item->end_time;
			$re['join_num'] = $item->join_num;
			$re['real_join'] = $item->real_join;
			$re['desc'] = $item->desc;
			$re['logo'] = $item->logo;
			$re['merchant_id'] = $item->merchant_id;
			$aRe[] = $re;
		}
		
		BaseFunctions::outputResult(true, $aRe);
	}
	
}