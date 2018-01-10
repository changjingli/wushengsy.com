<?php
	/*
	 * @desc  获取轮播图列表
	 */
	require_once "../conn.php";
	
	header('Content-type: application/json;charset=utf-8');
	
	// sql 查询
	$query = "select * from carousel";
	mysqli_query($link,"set character set 'utf8'");//读库
	// 执行sql查询
	$result = mysqli_query($link, $query) or die("sql exec failed");
	
	$arr = [];
	
	while ( $row = mysqli_fetch_array($result) ) {
		$arr[] = array(
			"id"   => $row['id'],
			"src"  => $row['src'],
			"alt"  => $row['alt'],
			"href" => $row['href'],
		);
	}
	
	// 输出查询结果
	echo json_encode($arr);
		
	// 释放查询资源
	mysqli_free_result($result);
	
	// 关闭数据库连接
	mysqli_close($link);
?>