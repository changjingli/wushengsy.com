<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/6/12
 * Time: 23:34
 * Desc: 获取产品详情
 */
require_once '../common/ws_product.php';

header( 'Content-type: application/json;charset=utf-8' );

$ws_product = new ws_product();

$res = $ws_product->getProductDetail();