<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/6/15
 * Time: 18:04
 * Desc: 获取喷雾降温列表
 */
require_once '../common/ws_case.php';

header( 'Content-type: application/json;charset=utf-8' );

$ws_case = new ws_case();
$type = "penwujiangwen";
$ws_case->getCaseList( $type );