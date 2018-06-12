<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/6/12
 * Time: 23:55
 * Desc: 新增产品
 */

require_once '../common/ws_product.php';

$ws_product = new ws_product();
$ws_product->addProduct();