<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/6/12
 * Time: 12:57
 * Desc: 获取行业新闻列表
 */
require_once '../common/ws_news.php';

header('Content-type: application/json;charset=utf-8');

$ws_news = new ws_news();
$ws_news->getIndustryNewsList();