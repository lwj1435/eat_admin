<?php

class StatisticsController extends Controller
{
	public function filters()
	{
		return array(
				array(
						'application.filters.AdminFilter'
				),
		);
	}

	public function actionClient()
	{
		$this->render('client');
	}
	
	public function actionReservation()
	{
		$this->render('reservation');
	}
	
	public function actionTakeaway()
	{
		$this->render('takeaway');
	}
	
	public function actionVisitors()
	{
		$this->render('visitors');
	}
}