<?php
	require_once "../conn.php";
	
	header('Content-type: application/json;charset=utf-8');
	
	$id = @$_REQUEST[ 'id' ];
	
	if (!$id) {
		die( "没有id" );
	}
	// sql 查询
	$query = "select * from news where id=".$id;
	mysqli_query($link,"set character set 'utf8'");//读库
	// 执行sql查询
	$result = mysqli_query($link, $query) or die("sql exec failed");
	
	$arr = [];
	
	while ( $row = mysqli_fetch_array($result) ) {
		$arr[] = array(
			"id"      => $row['id'     ], // 新闻id
			"title"   => $row['title'  ], // 新闻标题
			"author"  => $row['author' ], // 作者
			"time"    => $row['time'   ], // 发布时间
			"content" => $row['content'], // 新闻内容
		);
	}
	
	// 输出查询结果
	echo json_encode($arr);
		
	// 释放查询资源
	mysqli_free_result($result);
	
	// 关闭数据库连接
	mysqli_close($link);
?>