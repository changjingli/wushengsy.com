<?php
	/*
	 * @desc 雾盛首页接口
	 */
	require_once "../function.php";
	
	header('Content-type: application/json;charset=utf-8');
	
	$carouseList = getCarouselList();
	$artnerList = getPartnerList();
	
	$res = array(
		"carouseList" => $carouseList,
		"artnerList" => $partnerList,
	);
	
	echo json_encode($res, JSON_UNESCAPED_UNICODE);
?>