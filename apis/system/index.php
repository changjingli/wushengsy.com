<?php
	/*
	 * @desc 雾盛首页接口
	 */
	require_once "../function.php";
	
	header('Content-type: application/json;charset=utf-8');
	
	// 轮播图
	$carouseList = ws_system::getCarouselList();
	// 合作伙伴
	$partnerList = ws_system::getPartnerList();
	
	$res = array(
		"carouseList" => $carouseList,
		"partnerList" => $partnerList,
	);
	
	ws_system::response( $res );
?>