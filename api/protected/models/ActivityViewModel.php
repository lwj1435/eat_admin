<?php
class ActivityViewModel extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$this->sTableKey = "activity_view";
		parent::__construct($this->sTableKey);
	}

	public function getTableKey(){
		return $this->sTableKey;
	}
	public function addActivityView($user_id,$at_id){
		$aParam = array();
		$aParam["user_id"]=$user_id;
		$aParam["add_time"]=time();
		$aParam["at_id"]=$at_id;
		return $this->add($aParam,true);
	}

	public function updateActivityView($id,$user_id,$add_time,$at_id){
		$aParam = array();
		$aParam["id"]=$id;
		$aParam["user_id"]=$user_id;
		$aParam["add_time"]=$add_time;
		$aParam["at_id"]=$at_id;
		return $this->updateById($id,$aParam,true);
	}

}
?>

