<?php
class MySqlClass implements SQLInterface {

	public function init(){

	}

	/*
	 * (non-PHPdoc) @see SQLInterface::add()
	 */
	public function add($sTable, $aParam, $bShow = 0) {
		// TODO Auto-generated method stub
		if (! $sTable)
		return BaseFunctions::returnResult(false, "table is null!");
		$connection = ConnecToDB::Connect();
		$sCondition = "";

		$col = '';
		$colVal = '';
		foreach ( $aParam as $sKey => $aValue ) {
			$col .= "`$sKey`,";
			$value = $this->manageElement($aValue['type'],$aValue['val']);
			$colVal .= $value;
		}
		$col = substr ( $col, 0, - 1 );
		$colVal = substr ( $colVal, 0, - 1 );
		$sSql = " Insert into $sTable($col) values($colVal)";
		if ($bShow){
			BaseFunctions::writeLog($sSql);
		}

		$command=$connection->createCommand($sSql);
		$aDataReader=$command->execute();
		return $post_id = Yii::app()->db->getLastInsertID()?BaseFunctions::returnResult(true,Yii::app()->db->getLastInsertID()):BaseFunctions::returnResult(false, $aDataReader);
	}

	/*
	 * (non-PHPdoc) @see SQLInterface::update()
	 */
	public function update($sTable,$sWhere, $aParam, $bShow = 0) {
		// TODO Auto-generated method stub
		$connection = ConnecToDB::Connect();
		$sSql = "";
		$sCols = "";
		if (! $sTable)
		return BaseFunctions::returnResult(false, "table is null!") ;

		$sWhere = $sWhere ? $sWhere : '1 <> 1';
		foreach ( $aParam as $sKey => $aVal ) {
			$sV = $this->manageElement($aVal['type'], $aVal['val']);
			$sCols .= "`" . $sKey . "`=" . $sV ;
		}
		$sCols = $sCols?substr ( $sCols, 0, - 1 ):"";
		$sSql = "update $sTable set $sCols WHERE $sWhere ";

		if ($bShow){
			BaseFunctions::writeLog($sSql);
		}
		$command=$connection->createCommand($sSql);   // ִ��һ�� SQL ��ѯ
		$aDataReader=$command->execute();
		return BaseFunctions::returnResult(true, $aDataReader) ;
	}

	/*
	 * (non-PHPdoc) @see SQLInterface::find()
	 */
	public function find($sTable, $sWhere, $bShow = 0) {
		// TODO Auto-generated method stub
		$connection = ConnecToDB::Connect();
		$sSql = "Select * From $sTable Where {$sWhere} ";
		if ($bShow){
			BaseFunctions::writeLog($sSql);
		}
		$command = $connection->createCommand($sSql);
		$aData = $command->queryAll();
		return BaseFunctions::returnResult(true, $aData);
	}

	/**
	 * (non-PHPdoc)
	 * @see SQLInterface::del()
	 */
	public function del($sTable,$sWhere,$bShow = 0){
		// TODO Auto-generated method stub
		$connection = ConnecToDB::Connect();
		$sSql = "";
		$sCols = "";
		// ִ��һ�� SQL ��ѯ

		if (! $sTable)
		return false;
		//����Ҫ�޸ĵø�����
		$sWhere = $sWhere ? $sWhere : '1 <> 1';

		$sSql = "delete from $sTable WHERE $sWhere ";

		if ($bShow){
			BaseFunctions::writeLog($sSql);
		}
		$command=$connection->createCommand($sSql);   // ִ��һ�� SQL ��ѯ
		$aDataReader=$command->execute();
		//print_r($aDataReader);
		return BaseFunctions::returnResult(true, $aDataReader);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see SQLInterface::findDetail()
	 */
	public function findDetail($sTable,$sWhere,$sFind,$bShow){
		// TODO Auto-generated method stub
		$connection = ConnecToDB::Connect();
		$sSql = "Select {$sFind} From $sTable Where {$sWhere} ";
		if ($bShow){
			BaseFunctions::writeLog($sSql);
		}
		$command = $connection->createCommand($sSql);
		$aData = $command->queryAll();
		return BaseFunctions::returnResult(true, $aData);
	}

	/**
	 *
	 * ��ҳ
	 * @param unknown_type $select
	 * @param unknown_type $table
	 * @param unknown_type $where
	 * @param unknown_type $startPage
	 * @param unknown_type $pageNum
	 * @param unknown_type $group
	 * @param unknown_type $order
	 * @param unknown_type $isEcho
	 * @param unknown_type $isGetLast
	 */
	function pageGet($select, $table, $where, $startPage=1, $pageNum=10, $group='', $order='', $isEcho = false,$isGetLast=true) {
		$connection = ConnecToDB::Connect();
		$select = ' Select ' . trim ( $select );
		$table = ' From ' . trim ( $table ) . ' ';
		$where = ' Where ' . $where;
		$group = $group ? ' Group by ' . $group : ' ';
		$order = $order ? ' Order by ' . $order : ' ';
		$startNum = $startPage > 1 ? ($startPage - 1) * $pageNum : '0';
		$pageNum = $pageNum > 0 ? $pageNum : 1;
		$totalSql = ' Select count(1) as num ' . $table . $where . $group . $order;
		if ($isEcho)
		BaseFunctions::writeLog($totalSql);
		$command=$connection->createCommand($totalSql);
		$totalNum =$command->queryScalar();
		if ($totalNum) {
			 
		} else {
			return false;
		}
		if ($isGetLast){
			$startNum = $startNum > $totalNum?(floor($totalNum/$pageNum)-1)*$pageNum:$startNum;
		}
		$startNum = intval($startNum);

		$startNum = $startNum>0 ?$startNum:'0';
		$startNum = $startNum<0 ? 0: $startNum;
		//echo $startNum;
		$sql = $select . $table . $where . $group . $order . ' Limit ' . $startNum . ' , ' . $pageNum;
		if ($isEcho)
		BaseFunctions::writeLog($sql);
		$command=$connection->createCommand($sql);
		$totalRecord = $command->queryAll();
		$beforPage = $startPage > 1 ? $startPage - 1 : 1;
		$totalPage = ceil ( $totalNum / $pageNum );
		$nextPage = $startPage < $totalPage ? $startPage + 1 : $startPage;
		return array ('records' => $totalRecord, 'totalPage' => $totalPage, 'totalNum'=>$totalNum, 'pageNum' => $pageNum, 'beforPage' => $beforPage, 'perPage' => $startPage, 'nextPage' => $nextPage );
	}



	/**
	 * element manage
	 * @param unknown $sType
	 * @param unknown $sValue
	 */
	private function manageElement($sType,$sValue){
		$sType = strtolower($sType);
		$sType = $sType?$sType:"s";
		switch ($sType){
			case "s":
				return '"'.mysql_escape_string($sValue).'",';
				break;
			case "str":
				return '"'.mysql_escape_string($sValue).'",';
				break;
			case "string":
				return '"'.mysql_escape_string($sValue).'",';
				break;
			case "varchar":
				return '"'.mysql_escape_string($sValue).'",';
				break;
			case "i":
				return intval($sValue).",";
				break;
			case "int":
				return intval($sValue).",";
				break;
			case "test":
				return '"'.mysql_escape_string($sValue).'",';
				break;
			case "t":
				return '"'.mysql_escape_string($sValue).'",';
				break;
			case "float":
				return floatval($sValue).",";
				break;
			case "f":
				return floatval($sValue).",";
				break;
			case "double":
				return doubleval($sValue).",";
				break;
			case "d":
				return doubleval($sValue).",";
				break;
			case "date":
				return is_numeric($sValue)?'"'.date("Y-m-d",$sValue).'",':'"'.$sValue.'",';
				break;
			case "dt":
				return is_numeric($sValue)?'"'.date("Y-m-d",$sValue).'",':'"'.$sValue.'",';
				break;
			case "char":
				return '"'.mysql_escape_string($sValue).'",';
				break;
			case "c":
				return '"'.mysql_escape_string($sValue).'",';
				break;
			default:
				return '"'.mysql_escape_string($sValue).'",';
				break;
		}
	}
}

?>