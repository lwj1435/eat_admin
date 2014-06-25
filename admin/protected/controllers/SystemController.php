<?php

class SystemController extends Controller
{
	public function filters()
	{
		return array(
// 				array(
// 						'application.filters.AdminFilter'
// 				),
		);
	}
	
	public function actionChangeUrlGroupSta(){
		$urlId = isset($_REQUEST['urlId'])?$_REQUEST['urlId']:'';
		$status = isset($_REQUEST['status'])?$_REQUEST['status']:'';
		$groupId = isset($_REQUEST['groupId'])?$_REQUEST['groupId']:'';
		$connectionId = isset($_REQUEST['conId'])?$_REQUEST['conId']:'';
		if ($status==1) {
			$model=new SyAccess;
			$model->attributes=array(
					'group_id'=>$groupId,
					'url_id'=>$urlId
			);
			$model->save();
		}else{
			$model = new SyAccess();
			$model->find("group_id=$groupId and url_id = $urlId")->delete();
// 			$this->loadModel($connectionId)->delete();
		}
	}

	public function actionCompetence()
	{
		$iMer = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$criteria = new CDbCriteria();
		
		$criteria->order = 'id asc';
			
		$criteria->condition = ' mer_id = '.$iMer;
			
		$list = SyGroup::model()->findAll($criteria);
		$this->render('competence',array('list'=>$list));
	}
	
	public function actionChangeAccess(){
		//group_id

		$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
		if ($id) {
			$model=SyGroup::model()->findByPk($id);
			if ($model==null) {
				$this->redirect($this->createUrl("site/404"));
			}else{
				
				$iMer = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
				
				$criteria = new CDbCriteria();
				
				$criteria->order = ' t.order asc';
				//$criteria->condition = ' groups.id =  '.$id;
				
				$criteria->with = array('groups');
					
				$list = SyUrl::model()->findAll($criteria);
				$this->render('changeAccess',array('list'=>$list,'model'=>$model,'group_id'=>$id));
			}
		}else{
			$this->redirect($this->createUrl("site/404"));
		}
	}
	
	public function actionChangeUser(){
		
	}
	
	public function actionManage()
	{
		$iMer = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		$criteria = new CDbCriteria();
		
		$criteria->order = 't.id asc';
		
		$criteria->with = array("groups");
		
		$criteria->condition = ' merchant_id = '.$iMer;
			
		$list = User::model()->findAll($criteria);
		$this->render('manage',array('list'=>$list));
	}
	
	public function actionGroupUser(){
		$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
		if ($id) {
			$model=SyGroup::model()->findByPk($id);
			if ($model==null) {
				$this->redirect($this->createUrl("site/404"));
			}else{
				$criteria = new CDbCriteria();
				
				$criteria->order = ' t.id asc';
					
				$criteria->condition = ' groups.id = '.$id;
				
				$criteria->with = array("groups");
				
				$list = User::model()->findAll($criteria);
				$this->render('groupUser',array('list'=>$list,'model'=>$model));
			}
		}else{
			$this->redirect($this->createUrl("site/404"));
		}
	}
	
	public function actionChangeUserGroup(){
		$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
		$groupId = isset($_REQUEST['groupId'])?$_REQUEST['groupId']:'';
		$iMer = Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
		if ($id) {
			$model = User::model()->findByPk($id);
			if ($model==null) {
				$this->redirect($this->createUrl("site/404"));
			}else{
				$criteria = new CDbCriteria();
				
				$criteria->order = 'id asc';
				
				$criteria->condition = ' mer_id = '.$iMer;
				
				$list = SyGroup::model()->findAll($criteria);
				
				$this->render('changeUserGroup',array('list'=>$list,'id'=>$id,'group_id'=>$groupId,'model'=>$model));
			}
		}else{
			$this->redirect($this->createUrl("site/404"));
		}
	}
	
	public function actionAddGroupUserRelation(){
		//id
		//group_id
		//old_group
		$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
		$group_id = isset($_REQUEST['group_id'])?$_REQUEST['group_id']:'';
		$old_group = isset($_REQUEST['old_group'])?$_REQUEST['old_group']:'';
		if($group_id==$old_group){
			$this->redirect($this->createUrl("system/manage"));
		}
		if ($id) {
			$model = new SyUserGroup();
			$tempModel = $model->find("user_id = $id");
			if ($tempModel) {
				$tempModel->delete();
			}
			$model->attributes=array(
					'group_id'=>$group_id,
					'user_id'=>$id
			);
			$model->save();
			$this->redirect($this->createUrl("system/manage"));
		}else{
			$this->redirect($this->createUrl("site/404"));
		}
	}
	
	public function actionAddManageUer(){
		//AddManageUse
		$model=new AddManageUse;
		
		// uncomment the following code to enable ajax-based validation
		/*
		 if(isset($_POST['ajax']) && $_POST['ajax']==='add-manage-use-AddManageUse-form')
		 {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
		
		if(isset($_POST['AddManageUse']))
		{
			$aArr = $_POST['AddManageUse'];
			$aArr['merchant_id'] =  Yii::app()->cache->get('merchant_'.Yii::app()->user->id);
			$aArr['type'] = 2;
			$aArr['create_time'] = time();
			$aArr['sex'] = 1;
			$aArr['account_name'] = str_replace("",'',$aArr['account_name']);
			$model->attributes=$aArr;
			if($model->validate())
			{
				//判断电话号码是否 重复
				$iCheck = $model->find("account_name='{$aArr['account_name']}' or iphone = '{$aArr['iphone']}' ");
				$isExit = 0;
				$isExit = isset($iCheck->id)?($iCheck->account_name==$aArr['account_name']?1:2):0;

				//判断登录名字是否 重复
				if ($isExit) {
					$sTemp = $isExit==1?"存在重复的登录名字": "存在重复的电话号码";
					$model->addError("type",$sTemp);
				}else if($model->save()){
					$this->redirect($this->createUrl("system/manage"));
				}
			}
		}
		$this->render('AddManageUse',array('model'=>$model));
	}
}