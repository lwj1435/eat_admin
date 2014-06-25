<?php
	class ConData extends BaseController{
		public function actionIndex()
		{
			
		}
		
		/**
		 * user type
		 */
		public function actionUserType(){
			$aResult = array(
					'1' => '普通用户',
					'2' => '商家用户'
			);
			return BaseFunctions::returnResult(true, $aResult);
		}
	}
?>