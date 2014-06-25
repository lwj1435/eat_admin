<?php

class ColumnController extends Controller
{
	public function filters()
	{
		return array(
				array(
						'application.filters.AdminFilter'
				),
		);
	}

	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionAddColumn()
	{
		
		$this->render('addcolumn');
	}

	
	public function actionEditColumn()
	{
		
	}
	
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}