<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/6/12
 * Time: 12:56
 * Desc: 获取指定新闻详情
 */
require_once '../common/ws_news.php';

header('Content-type: application/json;charset=utf-8');

$ws_news = new ws_news();
$ws_news->getNewsDetail();