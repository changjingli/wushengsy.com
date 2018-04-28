<?php
	// 新增案例
	require_once "../conn.php";
	
	header('Content-type: application/json;charset=utf-8');
	
	$res = [];
	
	$type = $_REQUEST[ 'type' ];
	$title = $_REQUEST[ 'title' ];
	$author = $_REQUEST[ 'author' ];
	$view = $_REQUEST[ 'view' ];
	$content = $_REQUEST[ 'content' ];
	
	// 插入对应案例
	$result = mysqli_query( $link, "INSERT into case (type, title, author, view, content) values('" .$type. "', '" .$title. "', '" .$author. "', '" .$view. "', '" .$content. "')" );
	
	if ( $result ) {
		$res = array(
			"code" => 1000,
			"desc" => "新增成功"
		);
	} else {
		$res = array(
			"code" => 2001,
			"desc" => "新增失败"
		);
	}
	
	echo json_encode( $res );
	// 释放查询资源
	mysqli_free_result($result);
	
	// 关闭数据库连接
	mysqli_close($link);
?>