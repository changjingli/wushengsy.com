<?php

	require_once "../common/ws_product.php";

	/*
	 * @desc 根据制定ID获取产品详情
	 * @author Chang, Jingli
	 */
	
	header('Content-type: application/json;charset=utf-8');

	$product = new ws_product();
	$system = new ws_system();

	$res = $product->getProductDetail();

	$system->response( $res );
