<?php
class ActivityJoinUserModel extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$this->sTableKey = "activity_join_user";
		parent::__construct($this->sTableKey);
	}

	public function getTableKey(){
		return $this->sTableKey;
	}
	
	public function addActivityJoinUser($at_id,$user_id){
		$aParam = array();
		$aParam["at_id"]=$at_id;
		$aParam["user_id"]=$user_id;
		$aParam["add_time"]=time();
		$aParam["status"]=0;
		return $this->add($aParam,true);
	}

	public function updateActivityJoinUser($id,$at_id,$user_id,$status){
		$aParam = array();
		$aParam["id"]=$id;
		$aParam["at_id"]=$at_id;
		$aParam["user_id"]=$user_id;
		$aParam["status"]=$status;
		$aParam["up_time"]=time();
		return $this->updateById($id,$aParam,true);
	}

}
?>

