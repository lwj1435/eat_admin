<?php

class FeedbackController extends Controller
{

	public function filters()
	{
		return array(
				array(
						'application.filters.AdminFilter'
				),
		);
	}
	public function actionFeedback()
	{
		
		$merid = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		
		$sDefoutCondition = " from_merchant_id = {$merid} ";
		
		$criteria = new CDbCriteria();
		
		$criteria->order = ' id DESC ';
		
		$criteria->condition = $sDefoutCondition.'  ';
		
		$count = ServerMsg::model()->count($criteria);
		
		$pages = new CPagination($count);
		
		$pages->pageSize = 10;
		
		$pages->applyLimit($criteria);
		
		$list = ServerMsg::model()->findAll($criteria);
		
		$this->render('feedback',array('model'=>new ServerMsg(),'list'=>$list,'page'=>$pages));
		
	}
	
	public function actionNew()
	{
		$model=new SerMsgForm;
		
		// uncomment the following code to enable ajax-based validation
		/*
		 if(isset($_POST['ajax']) && $_POST['ajax']==='goods-form-addGoods-form')
		 {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
		
		$info = array();
		if(isset($_POST['SerMsgForm']))
		{
			$model->attributes=$_POST['SerMsgForm'];
			if($model->validate())
			{
				// form inputs are valid, do something here
				//TODO user id and merchant id
				//$_POST['GoodsForm']['merchant_id'] = "1";
				$info = $_POST['SerMsgForm'];
				$info['merchant_id'] = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
				$info['user_id'] = Yii::app()->user->id;
				$re = $this->dataChannel("msg","addServerMsg",$info);
				if ($re['type']) {
					$this->redirect($this->createUrl("feedback/feedback"));
					return;
				}else{
					echo "<script>alert('{$re['msg']}');</script>";
				}
			}else{
				$info = $_POST['SerMsgForm'];
			}
			$info = $_POST['SerMsgForm'];
		}
		$this->render('new',array('model'=>$model,'info'=>$info));
		//$this->render('new');
	}
}