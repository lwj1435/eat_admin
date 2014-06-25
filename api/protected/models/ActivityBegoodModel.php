<?php
class ActivityBegoodModel extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$this->sTableKey = "activity_begood";
		parent::__construct($this->sTableKey);
	}

	public function getTableKey(){
		return $this->sTableKey;
	}
	
	public function addActivityBegood($at_id,$user_id){
		$aParam = array();
		$aParam["at_id"]=$at_id;
		$aParam["user_id"]=$user_id;
		$aParam["add_time"]=time();
		return $this->add($aParam,true);
	}

	public function updateActivityBegood($id,$at_id,$user_id,$add_time){
		$aParam = array();
		$aParam["id"]=$id;
		$aParam["at_id"]=$at_id;
		$aParam["user_id"]=$user_id;
		$aParam["add_time"]=$add_time;
		return $this->updateById($id,$aParam,true);
	}

}
?>

