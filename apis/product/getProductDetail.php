<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/6/13
 * Time: 12:28
 * Desc: 获取指定id的产品详情
 */

require_once '../common/ws_product.php';

$ws_product = new ws_product();
$ws_product->getProductDetail();