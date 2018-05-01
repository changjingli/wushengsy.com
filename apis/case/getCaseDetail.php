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
			"code": 2000,
			"desc": "没有id",
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
			"id"      => $row['id'     ], // 新闻id
			"title"   => $row['title'  ], // 新闻标题
			"author"  => $row['author' ], // 作者
			"time"    => $row['time'   ], // 发布时间
			"content" => $row['content'], // 新闻内容
			"view"    => $row['view'   ], // 浏览次数
		);
	}
	
	// 输出查询结果
	echo json_encode($arr);
	
	// 对应新闻访问量增加1
	mysqli_query( $link, "UPDATE wusheng.case SET view=view+1 where id=".$id );
		
	// 释放查询资源
	mysqli_free_result($result);
	
	// 关闭数据库连接
	mysqli_close($link);
?>