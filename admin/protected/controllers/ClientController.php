<?php

class ClientController extends Controller
{
	public function filters()
	{
		return array(
				array(
						'application.filters.AdminFilter'
				),
		);
	}

	public function actionList()
	{
		global $sex_arr;
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		
		$start = 0;
		$page = 1;
		$offset = 20;
//		$sort = 'add_time';
//		$asc = 'desc';
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
		$dataModel->setSKey('merchant_user_address_'.$merid);
		
//		$orders = array($sort=>$asc);
		
		$start = $start?$start:0;
		$start = ($page - 1)*$offset;
		
		
		$result = $dataModel->PageList("`user_merchant` m left join `user` u on m.`user_id`=u.`id` left join `user_address` a On a.`user_id`=m.`user_id` ", '', "m.`merchant_id` = '$merid'",$page,$offset);

		if(isset($result['count']))
		{
			$total = $result['count'];
			$pagecount = ceil($total/$offset);
			$page = $page > $pagecount ? $pagecount:$page;
			$page = $page < 0 ? 1:$page;
		}
		

		$data['start'] = $start;
		$data['offset'] = $offset;
		$data['sort'] = '';
		$data['asc'] = '';
		$data['nowpage'] = $page;
		$data['pagecount'] = $pagecount;
		
		$this->render('list',array('result'=>$result,'pagedata'=>$data,'sex_arr'=>$sex_arr));
	}
	
	public function actionCuList(){
		$iTime= time(date("Y-m-d"));
		$criteria = new CDbCriteria();
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$criteria->order = 'id DESC ';
		$criteria->condition = ' mrchant_id = '.$merid;
		
		$count = CustomerMsg::model()->count($criteria);
		
		$pages = new CPagination($count);
		
		$pages->pageSize = 10;
		
		$pages->applyLimit($criteria);
		
		$list = CustomerMsg::model()->findAll($criteria);
		
		$criteria2 = new CDbCriteria();
		
		$criteria2->order = 'id DESC';
		$criteria2->condition = ' mrchant_id = '.$merid." and add_time > $iTime ";
		
		$count2 = CustomerMsg::model()->count($criteria2);
		
		$pages2 = new CPagination($count2);
		
		$pages2->pageSize = 10;
		
		$pages2->applyLimit($criteria2);
		$list2 = CustomerMsg::model()->findAll($criteria2);
		
		//统计外卖  $takeoutcount
		$takeoutcriteria = new CDbCriteria();
		$takeoutcriteria->order = 'id DESC ';
		$takeoutcriteria->condition = ' merchange_id = '.$merid." and add_time > $iTime ";;
		
		$takeoutcount = BookList::model()->count($takeoutcriteria);
		//统计订座  $bookcount
		$bookcriteria = new CDbCriteria();
		$bookcriteria->order = 'id DESC ';
		$bookcriteria->condition = ' merchant_id = '.$merid." and add_time > $iTime ";;
		
		$bookcount = TakeOutList::model()->count($bookcriteria);
		//新增关注 $count
		$newcount = 0;
		
		//新增客户
		$this->render('cuList', array('newcount'=>$count2,
				'count'=>$newcount,'bookcount'=>$bookcount,'takeoutcount'=>$takeoutcount,
				'culcount'=>$count,'list' => $list,'list2' => $list2,
				 'pages' => $pages,'pages2' => $pages2,"oModer"=>new CustomerMsg()));
	}
	
	public function actionCusPost(){
		$idlist = isset($_REQUEST['idlist'])?$_REQUEST['idlist']:'';
		$this->render('cusPost',array('idlist'=>$idlist));
	}
	
	public function actionCusSNS(){
		$idlist = isset($_REQUEST['idlist'])?$_REQUEST['idlist']:'';
		$this->render('cusSNS',array('idlist'=>$idlist));
	}
	
	public function actionCustomerDetail(){
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$cusId = isset($_REQUEST['id'])?$_REQUEST['id']:'0';
		if (!$cusId) {
			echo "<script>alert('无效记录');</script>";
			return;
		}
		$info = array(
				'cus_id' => $cusId,
				'merchant_id' => $merid
		);
		$aRe = $this->dataChannel("customerMsg","getCus",$info);
		if (!$aRe['type']) {
			echo "<script>alert('{$aRe['msg']}');</script>";
			return;
		}
		$cusMsg = $aRe['msg'];
		//客户预约历史记录   
		$sDefoutCondition = " merchange_id = '$merid' and customer_id = {$cusId} ";
		//所有的已确认的订单
		$criteria = new CDbCriteria();
		
		$criteria->order = ' id DESC ';
		
		$criteria->condition = $sDefoutCondition.'  ';
		
		$count = BookList::model()->count($criteria);
		
		$bookpages = new CPagination($count);
		
		$bookpages->pageSize = 10;
		
		$bookpages->applyLimit($criteria);
		
		$bookList = BookList::model()->findAll($criteria);
		//客户外卖历史记录    
		$sDefoutCondition = " merchant_id = '$merid' and customer_id = {$cusId} ";
		$takeOutcriteria = new CDbCriteria();
		
		$takeOutcriteria->order = ' id DESC ';
		
		$takeOutcriteria->condition = $sDefoutCondition.'  ';
		
		$takeOutcount = TakeOutList::model()->count($takeOutcriteria);
		
		$takeOutpages = new CPagination($takeOutcount);
		
		$takeOutpages->pageSize = 10;
		
		$takeOutpages->applyLimit($takeOutcriteria);
		
		$takeoutList = TakeOutList::model()->findAll($takeOutcriteria);
		//$takeoutList = array();
		//优惠卷历史记录   
		if (isset($cusMsg['user_id'])&&$cusMsg['user_id']) {
			$coupcriteria = new CDbCriteria();
			
			$coupcriteria->order = ' id DESC ';
			
			$coupcriteria->condition = " user_id = {$cusMsg['user_id']}  ";
			
			$coupcount = GoodsDetailList::model()->count($coupcriteria);
			
			$couppages = new CPagination($coupcount);
			
			$couppages->pageSize = 10;
			
			$couppages->applyLimit($coupcriteria);
			
			$couponList = GoodsDetailList::model()->findAll($coupcriteria);
			
		}else{
			$couponList = array();
		}
		//客户点评记录
		$commentList = array();
		$this->render('cusDetail',array('cusMsg'=>$cusMsg,
				'bookList'=>$bookList,'bookpages'=>$bookpages,
				'takeoutList'=>$takeoutList,'takeoutpages'=>$takeOutpages,
				'bookcount'=>$count,
				'takeoutcount'=>$takeOutcount,
				'couponList'=>$couponList,'couponpages'=>$bookpages,
				'commentList'=>$commentList,'commentpages'=>$bookpages));
	}
}