<?php
	require_once "../conn.php";
	
	header('Content-type: application/json;charset=utf-8');
	
	$id = $_REQUEST[ 'id' ];
	$res = [];
	
	if (!$id) {
		$res = array(
			"code" => 2000,
			"desc" => "请传入id"
		);
		die( json_encode( $res ) );
	}
	
	$title  = $_REQUEST[ 'title' ];
	$author = $_REQUEST[ 'author' ];
	$content  = $_REQUEST[ 'content' ];
	$view  = $_REQUEST[ 'view' ];
	
	// 更新对应新闻
	$result = mysqli_query( $link, "UPDATE news SET title = '" .$title. "', author = '" .$author. "', view = '" .$view. "', content = '" .$content. "' where id=".$id );
	
	if ( $result ) {
		$res = array(
			"code" => 1000,
			"desc" => "更新成功"
		);
	} else {
		$res = array(
			"code" => 2001,
			"desc" => "更新失败"
		);
	}
	
	echo json_encode( $res );
	// 释放查询资源
	mysqli_free_result($result);
	
	// 关闭数据库连接
	mysqli_close($link);
?>