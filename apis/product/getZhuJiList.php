<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/6/12
 * Time: 12:56
 * Desc: 获取主机列表
 */
require_once '../common/ws_product.php';

header( 'Content-type: application/json;charset=utf-8' );

$ws_product = new ws_product();

$ws_product->getZhuJiList();
