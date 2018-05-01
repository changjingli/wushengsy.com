<?php
	require_once "../conn.php";
	/*
	 * @desc 根据指定的ID删除案例
	 * @author Chang, Jingli
	 */
	
	header('Content-type: application/json;charset=utf-8');
	
	$id = @$_REQUEST[ 'id' ];
	$res = [];
	
	if (!$id) {
		$res = array(
			"code" => 2000,
			"desc" => "请传入id"
		);
		die( json_encode( $res ) );
	}
	// 删除对应案例
	$result = mysqli_query( $link, "UPDATE wusheng.case SET isDel=1 where id=".$id );
	
	if ( $result ) {
		$res = array(
			"code" => 1000,
			"desc" => "删除成功"
		);
	} else {
		$res = array(
			"code" => 2001,
			"desc" => "删除失败"
		);
	}
	
	echo json_encode( $res );
	// 释放查询资源
	mysqli_free_result($result);
	
	// 关闭数据库连接
	mysqli_close($link);
?>