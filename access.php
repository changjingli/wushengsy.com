<?php
	require_once "apis/conn.php";
		
	$query = 'select * from users'; // sql 查询语句
	$result = mysqli_query($link, $query)
		or die( "sql exec failed" ); // 执行sql查询
	while ( $row = mysqli_fetch_array($result) ) {
		echo 'id:'.$row['id'].",<br>";
		echo 'username:'.$row[1].",<br>";
		echo $row[2]."<br>";
		echo $row[3]."<br>";
	}
	
	
	
	// 释放查询资源
	mysqli_free_result($result);
	
	// 关闭数据库连接
	mysqli_close($link);
	
?>