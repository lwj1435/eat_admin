<?php

/**
 *
 * @author jen
 * BlockList model
 */
class BlockList extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$sTableKey = "ff_block_list";
		parent::__construct($sTableKey);
	}

	public function getTableKey(){
		return $this->sTableKey;
	}

}

?>