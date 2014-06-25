<?php
class OrderingControlle  extends BaseController{
	public function actionBookList(){
		$oBook = new Book();
		$select = " * ";
		$where = "1"; 
		$startPage=1 ;
		$pageNum=10; 
		$aParam = $oBook->pageGet($select, $where, $startPage=1, $pageNum=10, $group='', $order='');
		BaseFunctions::ouputToString($aParam);
	}
	
	public function actionIndex(){
		echo "aaa";
	}
}

?>