<?php
	/*
	 * @desc 雾盛首页接口
	 */
	require_once "../common/ws_db.php";
	require_once "../common/ws_system.php";
	
	header('Content-type: application/json;charset=utf-8');
	
	$system = new ws_system();
	
	// 轮播图
	$carouseList = $system->getCarouselList();
	// 合作伙伴
	$partnerList = $system->getPartnerList();
	
	$res = array(
		"carouseList" => $carouseList,
		"partnerList" => $partnerList,
	);

    $system->response( $res );
