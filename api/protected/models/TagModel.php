<?php
class TagModel extends BaseModel{
	private $sTableKey;
	public function __construct(){
		$sTableKey = "tag";
		parent::__construct($sTableKey);
	}

	public function getTableKey(){
		return $this->sTableKey;
	}
}

?>