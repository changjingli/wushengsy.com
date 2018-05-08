<?php
	require_once  "conn.php";
	
	class ws_system {
		/*
		 * @desc 获取轮播图列表
		 */
		public static function getCarouselList () {
			$link = $GLOBALS[ '$link' ];
			
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
				
			// 释放查询资源
			mysqli_free_result($result);
			// 关闭数据库连接
			mysqli_close($link);
			// 返回查询结果
			return $arr;
		}
		
		/*
		 * @desc 获取合作伙伴列表
		 */
		public static function getPartnerList () {
			$link = $GLOBALS[ '$link' ];
			
			// sql 查询
			$query = "select * from partner";
			mysqli_query($link,"set character set 'utf8'");//读库
			// 执行sql查询
			$result = mysqli_query($link, $query) or die("sql exec failed");
			
			$arr = [];
			
			while ( $row = mysqli_fetch_array($result) ) {
				$arr[] = array(
					"id"   => $row['id'],
					"title"  => $row['title'],
					"imagesPath"  => $row['imagesPath'],
				);
			}
				
			// 释放查询资源
			mysqli_free_result($result);
			// 关闭数据库连接
			mysqli_close($link);
			// 返回查询结果
			return $arr;
		}
	}
	
	
	
	
?>