<?php
$aSQLCon = array (
		"user"=>array(
			"tableName"=>"user",
			"element"=>array(
				"id"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"list"
				),
				"account_name"=>array(
					"type"=>"varchar",
					"rule"=>"",
					"rType"=>"string"
				),
				"username"=>array(
					"type"=>"varchar",
					"rule"=>"",
					"rType"=>"string"
				),
				"sex"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"email"=>array(
					"type"=>"varchar",
					"rule"=>"",
					"rType"=>"string"
				),
				"password"=>array(
					"type"=>"varchar",
					"rule"=>"",
					"rType"=>"string"
				),
				"create_time"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"status"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"iphone"=>array(
					"type"=>"varchar",
					"rule"=>"",
					"rType"=>"string"
				),
				"qq"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"type"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"reg_time"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"vip"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"honour"=>array(
					"type"=>"varchar",
					"rule"=>"",
					"rType"=>"string"
				),
				"iteam_list"=>array(
					"type"=>"text",
					"rule"=>"",
					"rType"=>"string"
				),
				"this_login_time"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"last_login_time"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"this_login_ip"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"last_login_ip"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"merchant_id"=>array(
					"type"=>"varchar",
					"rule"=>"",
					"rType"=>"string"
				),
				"tag_list"=>array(
					"type"=>"text",
					"rule"=>"",
					"rType"=>"string"
				),
			),
			"priKey"=>"id",
			"abre"=>"user"
		),
		"merchant_msg" => array (
				"tableName" => "merchant_msg",
				"element" => array (
						"id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "list" 
						),
						"merchant_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_branch" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_alias" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_logo" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_image" => array (
								"type" => "text",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_sounds" => array (
								"type" => "text",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_video" => array (
								"type" => "text",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_desc" => array (
								"type" => "text",
								"rule" => "",
								"rType" => "string" 
						),
						"taste_sec" => array (
								"type" => "float",
								"rule" => "",
								"rType" => "string" 
						),
						"environmental_sec" => array (
								"type" => "float",
								"rule" => "",
								"rType" => "string" 
						),
						"service_sec" => array (
								"type" => "float",
								"rule" => "",
								"rType" => "string" 
						),
						"longitude" => array (
								"type" => "double",
								"rule" => "",
								"rType" => "string" 
						),
						"latitude" => array (
								"type" => "double",
								"rule" => "",
								"rType" => "string" 
						),
						"altitude" => array (
								"type" => "double",
								"rule" => "",
								"rType" => "string" 
						),
						"address" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_call" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_traffic" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_wifi" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_marketing_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_per" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_star" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_start_time" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_end_time" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"score" => array (
								"type" => "float",
								"rule" => "",
								"rType" => "string" 
						),
						"score_taste" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"score_envirement" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"score_service" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"good_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"user_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"status" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_othername" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_manager" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_manager_phone" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_phone" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"pro" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"city" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"area" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"free_service" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_tag" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_ser" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"business_type" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"referrals" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						) 
				),
				"priKey" => "id",
				"abre" => "merchant_msg" 
		),
		
		"book" => array (
				"tableName" => "book",
				"element" => array (
						"id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "list" 
						),
						"user_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"account_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"user_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"merchange_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"book_time" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"book_desc" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"book_phone" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"book_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"book_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"book_no" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"order_num" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"order_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"status" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"book_or_num" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"reserve_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"reach_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"begin_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"over_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"book_type" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"add_user_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"book_date" => array (
								"type" => "date",
								"rule" => "",
								"rType" => "string" 
						),
						"book_sex" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"commit_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"add_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"book_seat_type" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"book_seat_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"book_source_type" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"book_seat_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"delay_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"customer_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						) 
				),
				"priKey" => "id",
				"abre" => "book" 
		),
		
		"take_out" => array (
				"tableName" => "take_out",
				"element" => array (
						"id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "list" 
						),
						"take_out_num" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"user_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"account_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"user_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"user_phone" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"order_num" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"price_count" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"take_num_count" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"take_outcol" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"take_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"pro_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"out_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"get_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						) 
				),
				"priKey" => "id",
				"abre" => "take_out" 
		),
		
		"ff_block_list" => array (
				"tableName" => "ff_block_list",
				"element" => array (
						"id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "list" 
						),
						"user_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"user_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"type" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"admin_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"desc" => array (
								"type" => "text",
								"rule" => "",
								"rType" => "string" 
						),
						"status" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						) 
				),
				"priKey" => "id",
				"abre" => "ff_block_list" 
		),
		"goods" => array (
				"tableName" => "goods",
				"element" => array (
						"id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "list" 
						),
						"goods_id" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_pice" => array (
								"type" => "float",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_real_pice" => array (
								"type" => "float",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_style" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_taste" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_evaluation" => array (
								"type" => "float",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_desc" => array (
								"type" => "text",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_image" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_up_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_modify_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_comment_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_marketing_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_visit_times" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"good_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"share_times" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"sound_times" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_remain" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_image_list" => array (
								"type" => "text",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_over_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_type" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_virtual_gold" => array (
								"type" => "float",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_real_virtual_gold" => array (
								"type" => "float",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_cat" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_tag" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_sounds" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"recommend" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"status" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_taste_tag" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_sale_type" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_correlate" => array (
								"type" => "text",
								"rule" => "",
								"rType" => "string" 
						),
						"add_user_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_v_type" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"t_begin_time" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"t_end_time" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"pri_time_per" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"pri_goods_list" => array (
								"type" => "text",
								"rule" => "",
								"rType" => "string" 
						),
						"pri_goods_per" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"vip_per" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"per_type" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"varil_begin_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"varil_end_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"add_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_or_num" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"pri_money" => array (
								"type" => "float",
								"rule" => "",
								"rType" => "string" 
						),
						"pro_list" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"cou_list" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_share_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"translate_type" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"sendout_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"use_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"view_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"translation_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"be_good_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"be_book_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						) 
				),
				"priKey" => "id",
				"abre" => "goods" 
		),
		
		"or_merchant_seat" => array (
				"tableName" => "or_merchant_seat",
				"element" => array (
						"id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "list" 
						),
						"merchant_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"seat_type" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"min_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"max_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"status" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"desc" => array (
								"type" => "text",
								"rule" => "",
								"rType" => "string" 
						),
						"at_area" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"seat_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						) 
				),
				"priKey" => "id",
				"abre" => "or_merchant_seat" 
		),
		"seat_area" => array (
				"tableName" => "seat_area",
				"element" => array (
						"id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "list" 
						),
						"merchant_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"area_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"desc" => array (
								"type" => "text",
								"rule" => "",
								"rType" => "string" 
						) 
				),
				"priKey" => "id",
				"abre" => "seat_area" 
		),
		
		"customer_msg" => array (
				"tableName" => "customer_msg",
				"element" => array (
						"id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "list" 
						),
						"mrchant_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"c_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"book_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"take_out_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"coupon_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"comment_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"source_type" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"user_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"status" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"phone" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						) 
				),
				"priKey" => "id",
				"abre" => "customer_msg" 
		),
		"talk_log" => array (
				"tableName" => "talk_log",
				"element" => array (
						"id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "list" 
						),
						"from_user_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"to_user_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"to_merchant_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"add_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"status" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"parent_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"first_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"from_user_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"to_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"content" => array (
								"type" => "text",
								"rule" => "",
								"rType" => "string" 
						),
						"get_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"reply_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"send_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"reply_content" => array (
								"type" => "text",
								"rule" => "",
								"rType" => "string" 
						) 
				),
				"priKey" => "id",
				"abre" => "talk_log" 
		),
		
		"server_msg" => array (
				"tableName" => "server_msg",
				"element" => array (
						"id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "list" 
						),
						"from_user_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"to_user_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"from_merchant_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"add_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"status" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"parent_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"first_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"from_user_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"to_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"content" => array (
								"type" => "tinytext",
								"rule" => "",
								"rType" => "string" 
						),
						"get_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"reply_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"send_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"reply_content" => array (
								"type" => "tinytext",
								"rule" => "",
								"rType" => "string" 
						),
						"detail_content" => array (
								"type" => "tinytext",
								"rule" => "",
								"rType" => "string" 
						) 
				),
				"priKey" => "id",
				"abre" => "server_msg" 
		),
		"take_out" => array (
				"tableName" => "take_out",
				"element" => array (
						"id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "list" 
						),
						"take_out_num" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"user_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"account_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"user_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"user_phone" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"order_num" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"price_count" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"take_num_count" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"take_outcol" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"take_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"pro_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"out_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"get_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"status" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"add_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"take_out_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"take_out_type" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"favorable_id" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"pay_type" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"pay_status" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"add" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"take_out_status" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"super_need" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"take_num" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						) 
				),
				"priKey" => "id",
				"abre" => "take_out" 
		),
		
		"goods_detail" => array (
				"tableName" => "goods_detail",
				"element" => array (
						"id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "list" 
						),
						"goods_at_num" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"parent_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"user_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"user_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"customer_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"get_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"status" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"user_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"goods_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"type" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						) 
				),
				"priKey" => "id",
				"abre" => "goods_detail" 
		),
		
		"image" => array (
				"tableName" => "image",
				"element" => array (
						"id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "list" 
						),
						"image_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"image_link" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"image_up_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"image_modify_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"image_up_user_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"image_up_user_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"image_up_user_account_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"up_user_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"up_account_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"up_user_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"status" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						) 
				),
				"priKey" => "id",
				"abre" => "image" 
		),
		
		"message" => array (
				"tableName" => "message",
				"element" => array (
						"id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "list" 
						),
						"customer_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "list" 
						),
						"to_no" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"from_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"to_user_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"from_user_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"merchant_id" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"to_user_name" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						),
						"content" => array (
								"type" => "text",
								"rule" => "",
								"rType" => "string" 
						),
						"status" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"send_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"real_send_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"add_time" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"type" => array (
								"type" => "int",
								"rule" => "",
								"rType" => "string" 
						),
						"title" => array (
								"type" => "varchar",
								"rule" => "",
								"rType" => "string" 
						) 
				),
				"priKey" => "id",
				"abre" => "message" 
		),
		"activity_list"=>array(
				"tableName"=>"activity_list",
				"element"=>array(
						"id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"list"
						),
						"user_id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"user_name"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"activity_type"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"activity_name"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"activity_content"=>array(
								"type"=>"text",
								"rule"=>"",
								"rType"=>"string"
						),
						"start_time"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"end_time"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"join_num"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"real_join"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"desc"=>array(
								"type"=>"text",
								"rule"=>"",
								"rType"=>"string"
						),
						"logo"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"merchant_id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
				),
				"priKey"=>"id",
				"abre"=>"activity_list"
		),
		"order"=>array(
				"tableName"=>"order",
				"element"=>array(
						"id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"list"
						),
						"order_num"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"order_gold"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"user_id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"account_name"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"user_name"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"order_time"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"user_phone"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"parnt_order_num"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"plant_come_num"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"merchant_id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"status"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"add_time"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"add_user_id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"parent_order_id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						'b_v_gold' =>array("type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"),
						'v_gold' =>array("type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"),
						'b_gold' =>array("type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"),
						'order_gold' =>array("type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"),
						"goods_id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						
				),
				"priKey"=>"id",
				"abre"=>"order"
		),
		
		"user_address"=>array(
				"tableName"=>"user_address",
				"element"=>array(
						"id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"list"
						),
						"address"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"phone"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"name"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"other_phone"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"user_id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"account_name"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"ad_time"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"modify_time"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"status"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"area"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"pro"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"city"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
				),
				"priKey"=>"id",
				"abre"=>"user_address"
		),
		
		"tag"=>array(
				"tableName"=>"tag",
				"element"=>array(
						"id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"list"
						),
						"tag_name"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"search_times"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"use_times"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"add_time"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
				),
				"priKey"=>"id",
				"abre"=>"tag"
		),
		
		"free_food_list"=>array(
				"tableName"=>"free_food_list",
				"element"=>array(
						"id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"list"
						),
						"ff_name"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"ff_content"=>array(
								"type"=>"text",
								"rule"=>"",
								"rType"=>"string"
						),
						"join_num"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"add_user_id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"add_time"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"start_time"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"end_time"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"merchant_id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"status"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"image_list"=>array(
								"type"=>"text",
								"rule"=>"",
								"rType"=>"string"
						),
				),
				"priKey"=>"id",
				"abre"=>"free_food_list"
		),
		
		"ff_user_list"=>array(
				"tableName"=>"ff_user_list",
				"element"=>array(
						"id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"list"
						),
						"user_id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"user_name"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"join_activity_id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"join_activity_type"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"add_time"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"status"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"phone"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"email"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"qq"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
				),
				"priKey"=>"id",
				"abre"=>"ff_user_list"
		),
		
				"article"=>array(
			"tableName"=>"article",
			"element"=>array(
				"id"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"list"
				),
				"parent_id"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"conment"=>array(
					"type"=>"text",
					"rule"=>"",
					"rType"=>"string"
				),
				"type"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"article_time"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"modify_time"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"user_id"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"user_name"=>array(
					"type"=>"varchar",
					"rule"=>"",
					"rType"=>"string"
				),
				"account_name"=>array(
					"type"=>"varchar",
					"rule"=>"",
					"rType"=>"string"
				),
				"follow_num"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"status"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"evaluate"=>array(
					"type"=>"float",
					"rule"=>"",
					"rType"=>"string"
				),
				"merchant_id"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"per"=>array(
					"type"=>"float",
					"rule"=>"",
					"rType"=>"string"
				),
				"image_list"=>array(
					"type"=>"text",
					"rule"=>"",
					"rType"=>"string"
				),
				"view_num"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"love_num"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
				"merchant_name"=>array(
					"type"=>"varchar",
					"rule"=>"",
					"rType"=>"string"
				),
				"merchant_feel"=>array(
					"type"=>"text",
					"rule"=>"",
					"rType"=>"string"
				),
				"pro"=>array(
					"type"=>"varchar",
					"rule"=>"",
					"rType"=>"string"
				),
				"city"=>array(
					"type"=>"varchar",
					"rule"=>"",
					"rType"=>"string"
				),
				"area"=>array(
					"type"=>"varchar",
					"rule"=>"",
					"rType"=>"string"
				),
				"activity_id"=>array(
					"type"=>"int",
					"rule"=>"",
					"rType"=>"string"
				),
			),
			"priKey"=>"id",
			"abre"=>"article"
		),
		
		"team_activity"=>array(
				"tableName"=>"team_activity",
				"element"=>array(
						"id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"list"
						),
						"user_id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"account_name"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"user_name"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"merchant_id"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"longitude"=>array(
								"type"=>"double",
								"rule"=>"",
								"rType"=>"string"
						),
						"latitude"=>array(
								"type"=>"double",
								"rule"=>"",
								"rType"=>"string"
						),
						"altitude"=>array(
								"type"=>"double",
								"rule"=>"",
								"rType"=>"string"
						),
						"team_type"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"team_title"=>array(
								"type"=>"varchar",
								"rule"=>"",
								"rType"=>"string"
						),
						"team_content"=>array(
								"type"=>"text",
								"rule"=>"",
								"rType"=>"string"
						),
						"join_num"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"real_join"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"start_time"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"end_time"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"is_good"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"status"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
						"add_time"=>array(
								"type"=>"int",
								"rule"=>"",
								"rType"=>"string"
						),
				),
				"priKey"=>"id",
				"abre"=>"team_activity"
		),
		
		
		
		
		
		
);
?>