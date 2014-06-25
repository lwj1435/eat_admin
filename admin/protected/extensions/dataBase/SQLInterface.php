<?php
interface SQLInterface {
	public function add($sTable, $aParam,$bShow);
	public function update($sTable,$sWhere,$aParam,$bShow);
	public function find($sTable,$aParam,$bShow);
	public function del($sTable,$sWhere,$bShow);
}
?>