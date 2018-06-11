<?php
	/*
	 * @desc  获取喷头和管件列表
	 */
	require_once '../common/ws_product.php';
    require_once "../common/ws_system.php";

    header('Content-type: application/json;charset=utf-8');

    $system = new ws_system();
    $ws_product = new ws_product();

	$PenTouGUanJIanList = $ws_product->getPenTouGuanJianList();

    $system->response( $PenTouGUanJIanList );