<?php
class ImageModel extends BaseModel{
	private $sTableKey;
	public function __construct(){
		$sTableKey = "image";
		parent::__construct($sTableKey);
	}
	
	public function getTableKey(){
		return $this->sTableKey;
	}
	public function getImageList($sStr){
		$sStr = ",".$sStr.",";
		$sStr = str_replace(",,", ",", $sStr);
		$sStr = str_replace(" ", "", $sStr);
		$sFind = "*";
		$sWhere = " id in (0".$sStr."0) ";
		return $this->find($sFind,$sWhere);
	}
}
?>