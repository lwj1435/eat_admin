<?php

class AdminController extends BaseController
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
	
//	public function filterAccessControl($filterChain)  
//    {         
//            echo "--->filterAccessControl";  
//            $filterChain->run();  
//    } 

	public function actionLogin()
	{
        $model=new LoginForm;  
  
        // if it is ajax validation request  
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')  
        {  
            echo CActiveForm::validate($model);  
            Yii::app()->end();  
        }  
  
        if(isset($_POST['LoginForm']))  
        {  
            $model->attributes=$_POST['LoginForm'];  
            // validate user input and redirect to the previous page if valid  
            if($model->validate() && $model->login())  
            {  
                //ucenter  
//                Yii::import('application.vendors.ucenter');  
//                include_once 'ucenter.php';  
                $script = uc_user_synlogin(Yii::app()->user->id);  
                $this->render('loginsuc', array(  
                    'script' => $script,  
                ));  
                Yii::app()->end();  
            }  
        }  
        // display the login form  
        $this->render('login',array('model'=>$model));  
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
        Yii::app()->user->logout();  
  
        $script = uc_user_synlogout();  
        $this->render('logoutsuc', array('script' => $script));  
        Yii::app()->end(); 
	}
	
	
	public function actionAddMenu()
	{
		Yii::import('ext.dao.*');
		$menu = new MenuClass();
	}
}