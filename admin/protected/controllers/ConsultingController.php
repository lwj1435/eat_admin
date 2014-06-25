<?php

class ConsultingController extends Controller
{
	public function filters()
	{
		return array(
				array(
						'application.filters.AdminFilter'
				),
		);
	}

	public function actionAd()
	{
		global $send_type;
		
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);

		$idlist = isset($_REQUEST['idlist'])?$_REQUEST['idlist']:'';
		$idlist = isset($_REQUEST['idlist2'])?$_REQUEST['idlist2']:$idlist;
		$send_type = isset($_REQUEST['send_type'])?$_REQUEST['send_type']:'';
		$send_content = isset($_REQUEST['send_content'])?$_REQUEST['send_content']:'';
		$send_time = isset($_REQUEST['send_time'])?$_REQUEST['send_time']:'';
		$idlist = is_array($idlist)?$this->stringAndArray($idlist,false):$idlist;
		if ($send_type==1&&(!$idlist||$idlist==",,")) {
			echo "<script>alert('接收人不可以为空!');</script>";
		}else if ($send_type&&$send_content&&$send_time) {
			$info = array(
				'idlist' => $idlist,
				'send_type' => $send_type,
				'send_content' => $send_content,
				'send_time' => $send_time,
				'merchant_id'=>$merid,
				'user_id'=>Yii::app()->user->id
			);
			$aRe = $this->dataChannel("message","addMessage",$info);
			echo "<script>alert('{$aRe['msg']}');</script>";
		}
		$sCount =$this->countNum($idlist);
		$this->render('ad',array(
				'selectCount'=>$sCount,
				'allCount'=>$this->countMer(),
				'idlist'=>$idlist,'send_type'=>$send_type,'send_content'=>$send_content,'send_time'=>$send_time,'allcus'=>$this->getAllCustomer()));
	}
	
	public function actionConsulting2()
	{
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);

	
		
		$start = 0;
		$page = 1;
		$offset = 20;
		$sort = '`user_add_time`';
		$asc = 'desc';
		$total = 0;
		$pagecount = 1;
		

		
		if(isset($_REQUEST['page']))
		{
			$page = intval($_REQUEST['page']);
		}
		if(isset($_REQUEST['offset']))
		{
			$offset = intval($_REQUEST['offset']);
		}
		if(isset($_REQUEST['sort']))
		{
			$sort = htmlspecialchars($_REQUEST['sort']);
		}
		if(isset($_REQUEST['asc']))
		{
			$asc = htmlspecialchars($_REQUEST['asc']);
		}
		if(isset($_REQUEST['start']))
		{
			$start = intval($_REQUEST['start']);
		}
		if(isset($_REQUEST['pagecount']))
		{
			$pagecount = intval($_REQUEST['pagecount']);
		}
		
		$dataModel = new DataModelClass();
		$dataModel->setSKey('consulting_list_'.$merid);
		$orders = array($sort=>$asc);
		
		$start = $start?$start:0;
		$start = ($page - 1)*$offset;
		
		
		$result = $dataModel->PageList("`consulting_list`", $orders, "`merchant_id` = '$merid'",$page,$offset);

		if(isset($result['count']))
		{
			$total = $result['count'];
			$pagecount = ceil($total/$offset);
			$page = $page > $pagecount ? $pagecount:$page;
			$page = $page < 0 ? 1:$page;
		}
		
		$data['start'] = $start;
		$data['offset'] = $offset;
		$data['sort'] = $sort;
		$data['asc'] = $asc;
		$data['nowpage'] = $page;
		$data['pagecount'] = $pagecount;

		$this->render('consulting',array('result'=>$result,'pagedata'=>$data));
	}
	
	private function countNum($str){
		$num = 0;
		$str = $str?$str:'';
		$arr = is_array($str)?$str:$this->stringAndArray($str);
		foreach ($arr as $item){
			if ($item) {
				$num++;
			}
		}
		return $num;
	}
	
	public function actionPush()
	{
				
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$idlist = isset($_REQUEST['idlist'])?$_REQUEST['idlist']:'';
		$idlist = isset($_REQUEST['idlist2'])?$_REQUEST['idlist2']:$idlist;
		$send_type = isset($_REQUEST['send_type'])?$_REQUEST['send_type']:'0';
		$send_content = isset($_REQUEST['send_content'])?$_REQUEST['send_content']:'';
		$send_time = isset($_REQUEST['send_time'])?$_REQUEST['send_time']:'';
		$title = isset($_REQUEST['title'])?$_REQUEST['title']:'';
		$idlist = is_array($idlist)?$this->stringAndArray($idlist,false):$idlist;
		if ($send_type==1&&(!$idlist||$idlist==",,")) {
			echo "<script>alert('接收人不可以为空!');</script>";
		}else if ($send_type&&$send_content&&$send_time&&$title) {
			$info = array(
					'idlist' => $idlist,
					'send_type' => $send_type,
					'send_content' => $send_content,
					'send_time' => $send_time,
					'merchant_id'=>$merid,
					'title'=>$title,
					'user_id'=>Yii::app()->user->id
			);
			$aRe = $this->dataChannel("message","addPush",$info);
			echo "<script>alert('{$aRe['msg']}');</script>";
		}
		$sCount =$this->countNum($idlist);
		$this->render('push',array(
				'selectCount'=>$sCount,
				'allCount'=>$this->countMer(),
				'idlist'=>$idlist,'send_type'=>$send_type,'send_content'=>$send_content,'send_time'=>$send_time,'title'=>$title,'allcus'=>$this->getAllCustomer()));
// 		global $send_type;

// 		$start = 0;
// 		$page = 1;
// 		$offset = 20;
// 		$sort = 'add_time';
// 		$asc = 'desc';
// 		$total = 0;
// 		$pagecount = 1;
		
		
// 		if(isset($_REQUEST['page']))
// 		{
// 			$page = intval($_REQUEST['page']);
// 		}
// 		if(isset($_REQUEST['offset']))
// 		{
// 			$offset = intval($_REQUEST['offset']);
// 		}
// 		if(isset($_REQUEST['sort']))
// 		{
// 			$sort = htmlspecialchars($_REQUEST['sort']);
// 		}
// 		if(isset($_REQUEST['asc']))
// 		{
// 			$asc = htmlspecialchars($_REQUEST['asc']);
// 		}
// 		if(isset($_REQUEST['start']))
// 		{
// 			$start = intval($_REQUEST['start']);
// 		}
// 		if(isset($_REQUEST['pagecount']))
// 		{
// 			$pagecount = intval($_REQUEST['pagecount']);
// 		}
		
// 		$dataModel = new DataModelClass();
// 		$dataModel->setSKey('merchant_send_msg_1_'.$merid);
// 		$orders = array($sort=>$asc);
		
// 		$start = $start?$start:0;
// 		$start = ($page - 1)*$offset;
		
		
// 		$result = $dataModel->PageList("`merchant_send_msg`", $orders, "`merchant_id` = '$merid' and `type`=1",$page,$offset);

// 		if(isset($result['count']))
// 		{
// 			$total = $result['count'];
// 			$pagecount = ceil($total/$offset);
// 			$page = $page > $pagecount ? $pagecount:$page;
// 			$page = $page < 0 ? 1:$page;
// 		}
		
// 		$data['start'] = $start;
// 		$data['offset'] = $offset;
// 		$data['sort'] = $sort;
// 		$data['asc'] = $asc;
// 		$data['nowpage'] = $page;
// 		$data['pagecount'] = $pagecount;

// 		$this->render('push',array('result'=>$result,'pagedata'=>$data,'send_type'=>$send_type));
	}
	
	private function countMer(){
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$criteria2 = new CDbCriteria();
		$criteria2->order = 'id DESC';
		$criteria2->condition = ' mrchant_id = '.$merid;
		
		$count2 = CustomerMsg::model()->count($criteria2);
		return $count2;
	}
	
	public function actionSendMessage(){
		$this->render('sendMessage');
	}
	
	public function actionConsulting(){
		$merId = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$iData =strtotime(date("Y-m-d"))-1;//今天开始
		$iDayTime= 24*60*60;
		$iBeforeDay = $iData-$iDayTime;//昨天 开始
		$iYesBeforeDay = $iBeforeDay - $iDayTime;//前天 开始
		
		$deFoultCondition = ' first_id <> 0 and to_merchant_id = '.$merId;
		//所有
		$allcriteria = new CDbCriteria();
		
		$allcriteria->order = 'id DESC';
		
		$allcriteria->condition = $deFoultCondition;
		
		$allcount = TalkLog::model()->count($allcriteria);
		
		$allpages = new CPagination($allcount);
		
		$allpages->pageSize = 10;
		
		$allpages->applyLimit($allcriteria);
		
		$alllist = TalkLog::model()->findAll($allcriteria);
		//今天
		$criteria = new CDbCriteria();
		
		$criteria->order = 'id DESC';
		
		$criteria->condition = $deFoultCondition." and send_time > $iData ";
		
		$count = TalkLog::model()->count($criteria);
		
		$pages = new CPagination($count);
		
		$pages->pageSize = 10;
		
		$pages->applyLimit($criteria);
		
		$list = TalkLog::model()->findAll($criteria);
		//昨天
		$yescriteria = new CDbCriteria();
		
		$yescriteria->order = 'id DESC';
		
		$yescriteria->condition = $deFoultCondition." and send_time > $iBeforeDay and send_time <= $iDayTime ";
		
		$yescount = TalkLog::model()->count($yescriteria);
		
		$yespages = new CPagination($yescount);
		
		$yespages->pageSize = 10;
		
		$yespages->applyLimit($yescriteria);
		
		$yeslist = TalkLog::model()->findAll($yescriteria);		
		//前天
		$befcriteria = new CDbCriteria();
		
		$befcriteria->order = 'id DESC';
		
		$befcriteria->condition = $deFoultCondition." and send_time > $iYesBeforeDay and send_time <= $iBeforeDay ";
		
		$befcount = TalkLog::model()->count($befcriteria);
		
		$befpages = new CPagination($befcount);
		
		$befpages->pageSize = 10;
		
		$befpages->applyLimit($befcriteria);
		
		$beflist = TalkLog::model()->findAll($befcriteria);
		//更早
		$oldcriteria = new CDbCriteria();
		
		$oldcriteria->order = 'id DESC';
		
		$oldcriteria->condition = $deFoultCondition." and send_time <= $iYesBeforeDay ";
		
		$oldcount = TalkLog::model()->count($oldcriteria);
		
		$oldpages = new CPagination($oldcount);
		
		$oldpages->pageSize = 10;
		
		$oldpages->applyLimit($oldcriteria);
		
		$oldlist = TalkLog::model()->findAll($oldcriteria);
		
		$this->render(	'talkList', array(
						'alllist' => $alllist,
						'allpages'=>$allpages,
						'list' => $list,
						'pages' => $pages,
						'yeslist' => $yeslist,
						'yespages' => $yespages,
						'beflist' => $beflist,
						'befpages' => $befpages,
						'oldlist' => $oldlist,
						'oldpages' => $oldpages,
				'todayCount'=>$count,
				'allcount'=>$allcount,
						"oModer"=>new TalkLog()
						)
					 );
	}
	
	public function actionReplyMsg(){
		$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
		$content = isset($_REQUEST['content'])?$_REQUEST['content']:'';
		$merId = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		if(!$id){
			echo "请选择回复的记录";
			return;
		}
		if(!$content){
			echo "请填写内容 ";
			return;
		}
		$info = array(
				'reply_id'=>$id,
				'merchant_id'=>$merId,
				'user_id'=>Yii::app()->user->id,
				'content'=>$content
		);
		$aRe = $this->dataChannel("msg","replayMsg",$info);
		echo json_encode($aRe);
		//echo isset($aRe['msg'])?$aRe['msg']:'error';
	}
	
	public function actionRelyDetail(){
		//获取主id
		$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
		$sName = isset($_REQUEST['name'])?$_REQUEST['name']:'';
		$merId = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$deFoultCondition = ' first_id = '.$id.' or id =  '.$id;
		$allcriteria = new CDbCriteria();
		
		$allcriteria->order = ' send_time ASC ';
		
		$allcriteria->condition = $deFoultCondition;
		
		$allcount = TalkLog::model()->count($allcriteria);
		
		$allpages = new CPagination($allcount);
		
		$allpages->pageSize = 1000;
		
		$allpages->applyLimit($allcriteria);
		
		$alllist = TalkLog::model()->findAll($allcriteria);
		
		$this->render('reDetail',array('list'=>$alllist,'sName'=>$sName,'count'=>$allpages->pageCount,'iId'=>$id));
	}
}