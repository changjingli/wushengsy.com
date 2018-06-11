<?php
    /*
     * @desc  获取主机列表
     */
    require_once '../common/ws_product.php';
    require_once "../common/ws_system.php";

    header('Content-type: application/json;charset=utf-8');

    $system = new ws_system();
    $ws_product = new ws_product();

    $getZhuJiList = $ws_product->getZhuJiList();

    $res = array(
        "getZhuJiList" => $getZhuJiList,
    );

    $system->response( $res );