<?php
	$aSQLCon = array (
		"promotion_goods"=>array(
			"tableName"=>"promotion_goods",
			"element"=>array(
				"id"=>array(
					"type"=>"bigint",
					"rule"=>"",
					"rType"=>"list"
				),
				"promotion_id"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"good_id"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"good_name"=>array(
					"type"=>"varchar",
					"rule"=>"",
					"rType"=>"string"
				),
			),
			"priKey"=>"id",
			"abre"=>"promotion_goods"
		),
	);
?>

