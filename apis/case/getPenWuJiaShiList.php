<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/6/15
 * Time: 18:04
 * Desc: 获取喷雾加湿列表
 */
require_once '../common/ws_system.php';
require_once '../common/ws_case.php';

header( 'Content-type: application/json;charset=utf-8' );

$ws_case = new ws_case();
$system = new ws_system();

$type = "penwujiashi";
$caseList = $ws_case->getCaseList( $type );
$system->response( $caseList );