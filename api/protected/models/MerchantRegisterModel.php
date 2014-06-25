<?php
class MerchantRegisterModel extends BaseModel {
	private $sTableKey;
	public function __construct(){
		$this->sTableKey = "merchant_register";
		parent::__construct($this->sTableKey);
	}

	public function getTableKey(){
		return $this->sTableKey;
	}
	public function addMerchantRegister($id,$account_name,$password,$mer_name,$mer_company,$city,$pro,$area,$business_area,$address,$lat,$long,$hasWiff,$wiff_name,$wiff_psw,$connection_user,$connection_user_position,$connection_call,$connection_phone,$ID_card,$ID_card_before_image,$ID_card_after_image,$business_license_No,$business_license_No_image,$tax_registry_No,$tax_registry_No_image,$status,$type,$add_time,$add_user_id,$up_time){
		$aParam = array();
		$aParam["id"]=$id;
		$aParam["account_name"]=$account_name;
		$aParam["password"]=$password;
		$aParam["mer_name"]=$mer_name;
		$aParam["mer_company"]=$mer_company;
		$aParam["city"]=$city;
		$aParam["pro"]=$pro;
		$aParam["area"]=$area;
		$aParam["business_area"]=$business_area;
		$aParam["address"]=$address;
		$aParam["lat"]=$lat;
		$aParam["long"]=$long;
		$aParam["hasWiff"]=$hasWiff;
		$aParam["wiff_name"]=$wiff_name;
		$aParam["wiff_psw"]=$wiff_psw;
		$aParam["connection_user"]=$connection_user;
		$aParam["connection_user_position"]=$connection_user_position;
		$aParam["connection_call"]=$connection_call;
		$aParam["connection_phone"]=$connection_phone;
		$aParam["ID_card"]=$ID_card;
		$aParam["ID_card_before_image"]=$ID_card_before_image;
		$aParam["ID_card_after_image"]=$ID_card_after_image;
		$aParam["business_license_No"]=$business_license_No;
		$aParam["business_license_No_image"]=$business_license_No_image;
		$aParam["tax_registry_No"]=$tax_registry_No;
		$aParam["tax_registry_No_image"]=$tax_registry_No_image;
		$aParam["status"]=$status;
		$aParam["type"]=$type;
		$aParam["add_time"]=$add_time;
		$aParam["add_user_id"]=$add_user_id;
		$aParam["up_time"]=$up_time;
		return $this->add($aParam,true);
	}

	public function updateMerchantRegister($id,$account_name,$password,$mer_name,$mer_company,$city,$pro,$area,$business_area,$address,$lat,$long,$hasWiff,$wiff_name,$wiff_psw,$connection_user,$connection_user_position,$connection_call,$connection_phone,$ID_card,$ID_card_before_image,$ID_card_after_image,$business_license_No,$business_license_No_image,$tax_registry_No,$tax_registry_No_image,$status,$type,$add_time,$add_user_id,$up_time){
		$aParam = array();
		$aParam["id"]=$id;
		$aParam["account_name"]=$account_name;
		$aParam["password"]=$password;
		$aParam["mer_name"]=$mer_name;
		$aParam["mer_company"]=$mer_company;
		$aParam["city"]=$city;
		$aParam["pro"]=$pro;
		$aParam["area"]=$area;
		$aParam["business_area"]=$business_area;
		$aParam["address"]=$address;
		$aParam["lat"]=$lat;
		$aParam["long"]=$long;
		$aParam["hasWiff"]=$hasWiff;
		$aParam["wiff_name"]=$wiff_name;
		$aParam["wiff_psw"]=$wiff_psw;
		$aParam["connection_user"]=$connection_user;
		$aParam["connection_user_position"]=$connection_user_position;
		$aParam["connection_call"]=$connection_call;
		$aParam["connection_phone"]=$connection_phone;
		$aParam["ID_card"]=$ID_card;
		$aParam["ID_card_before_image"]=$ID_card_before_image;
		$aParam["ID_card_after_image"]=$ID_card_after_image;
		$aParam["business_license_No"]=$business_license_No;
		$aParam["business_license_No_image"]=$business_license_No_image;
		$aParam["tax_registry_No"]=$tax_registry_No;
		$aParam["tax_registry_No_image"]=$tax_registry_No_image;
		$aParam["status"]=$status;
		$aParam["type"]=$type;
		$aParam["add_time"]=$add_time;
		$aParam["add_user_id"]=$add_user_id;
		$aParam["up_time"]=$up_time;
		return $this->updateById($id,$aParam,true);
	}

}
?>

