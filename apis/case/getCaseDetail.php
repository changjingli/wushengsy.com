<?php
	require_once "../conn.php";
	/*
	 * @desc 根据制定ID获取案例详情
	 * @author Chang, Jingli
	 */
	
	header('Content-type: application/json;charset=utf-8');
	
	$id = @$_REQUEST[ 'id' ];
	
	if (!$id) {
		die( array(
			"code" => 2000,
			"desc" => "没有id",
		) );
	}
	// sql 查询
	$query = "select * from wusheng.case where id=".$id;
	mysqli_query($link,"set character set 'utf8'");//读库
	// 执行sql查询
	$result = mysqli_query($link, $query) or die("sql exec failed");
	
	$arr = [];
	
	while ( $row = mysqli_fetch_array($result) ) {
		$arr = array(
			"id"      => $row['id'     ], // 案例id
			"title"   => $row['title'  ], // 案例标题
			"type"    => $row['type'   ], // 案例标题
			"author"  => $row['author' ], // 作者
			"time"    => $row['time'   ], // 发布时间
			"content" => $row['content'], // 案例内容
			"view"    => $row['view'   ], // 浏览次数
		);
	}
	
	// 输出查询结果
	echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	
	// 对应案例访问量增加1
	mysqli_query( $link, "UPDATE wusheng.case SET view=view+1 where id=".$id );
		
	// 关闭数据库连接
	mysqli_close($link);
?>