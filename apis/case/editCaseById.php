<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/6/18
 * Time: 16:37
 * Desc: 编辑案例详情
 */
require_once '../common/ws_system.php';
require_once '../common/ws_case.php';

header( 'Content-type: application/json;charset=utf-8' );

$ws_case = new ws_case();
$system = new ws_system();

$res = $ws_case->editCaseById();
$system->response( $res );