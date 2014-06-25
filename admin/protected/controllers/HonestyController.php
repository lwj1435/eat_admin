<?php

class HonestyController extends Controller
{
	public function filters()
	{
		return array(
				array(
						'application.filters.AdminFilter'
				),
		);
	}

	public function actionEvaluate()
	{
		global $comment_type;
		
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		
		$start = 0;
		$page = 1;
		$offset = 20;
		$sort = 'add_time';
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
		$dataModel->setSKey('merchant_comment_'.$merid);
		
		$orders = array($sort=>$asc);
		
		$start = $start?$start:0;
		$start = ($page - 1)*$offset;
		
		
		$result = $dataModel->PageList("`merchant_comment`", $orders, "`merchant_id` = '$merid'",$page,$offset);

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

		$this->render('evaluate',array('result'=>$result,'pagedata'=>$data,'comment_type'=>$comment_type));
	}
	
	public function actionHonesty()
	{
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$criteria = new CDbCriteria();
		
		$count = CustomerMsg::model()->count($criteria);
		
		$pages = new CPagination($count);
		
		$pages->pageSize = 10;
		
		$pages->applyLimit($criteria);
		
		$list = EvaHistory::model()->findAll($criteria);
		//$dataModel = new DataModelClass();
		//$dataModel->setSKey('merchant_'.$merid);
		//$result = $dataModel->getInfo($merid, '`merchant_msg`', "id='$merid'");
		
		//,array('result'=>$result)
		$this->render('honesty',array('list'=>$list,'pages'=>$pages));
	}
	

}