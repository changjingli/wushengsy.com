<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/6/13
 * Time: 14:42
 * Desc: 获取视频列表
 */
require_once "../common/ws_video.php";

header( 'Content-type: application/json;charset=utf-8' );
$ws_video = new ws_video();
$ws_video->getVideoList();