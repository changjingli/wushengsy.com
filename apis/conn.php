<?php
	$dev = true;
	$hostname = $dev ? "127.0.0.1" : "wushengsy.com";
	$user = "wusheng";
	$password = "wusheng";
	$database = "wusheng";
	
	$link = mysqli_connect($hostname, $user, $password);

	if ( !$link ) {
		die( "数据库连接失败" );
	}
	
	mysqli_select_db($link, $database )
		or die( "数据表选择失败" );
		
//	mysql_query("set names 'utf8'");//写库
//	mysqli_query($link,"set character set 'utf8'");//读库
?>