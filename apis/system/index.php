<?php
	/*
	 * @desc 雾盛首页接口
	 */
	require_once "../conn.php";
	require_once "../function.php";
	
	header('Content-type: application/json;charset=utf-8');
	
	$carouseList = getCarouselList();
	
	$res = array(
		"carouseList" => $carouseList,
	);
	
	echo json_encode($res, JSON_UNESCAPED_UNICODE);
?>