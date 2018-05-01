<?php
	/*
	 * @desc  获取喷雾降温列表
	 */
	require_once "../conn.php";
	
	header('Content-type: application/json;charset=utf-8');
	
	// sql 查询
	$type = "penwujiangwen";
	$query = "select * from wusheng.case where isDel=0 and type='" .$type. "'";
	mysqli_query($link,"set character set 'utf8'");//读库
	// 执行sql查询
	$result = mysqli_query($link, $query) or die("sql exec failed");
	
	$arr = [];
	
	while ( $row = mysqli_fetch_array($result) ) {
		$arr[] = array(
			"id"      => $row['id'],
			"title"   => $row['title'],
			"thumb"   => $row['thumb'],
			"type"    => $row['type'],
		);
	}
	
	// 输出查询结果
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
		
	// 释放查询资源
	mysqli_free_result($result);
	
	// 关闭数据库连接
	mysqli_close($link);
?>