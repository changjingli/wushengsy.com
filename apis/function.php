<?php
	class ws_db {
		/*
		 * @desc 数据库连接
		 */
		
		private $hostname = "127.0.0.1";
		private $user = "wusheng";
		private $password = "wusheng";
		private $database = "wusheng";
		
		public function getLink () {

			$link = mysqli_connect($this->hostname, $this->user, $this->password);

			if ( !$link ) {
				die( "数据库连接失败" );
			}

			mysqli_select_db($link, $this->database )
				or die( "数据表选择失败" );

			return $link;
		}

		/*
		 * @desc 释放数据库连接
		 */
		public function close ( $link ) {
			if ( $link ) {
				mysqli_close( $link );
			}
		}

		/*
		 * 释放查询资源
		 */
		public function free ( $result ) {
			if ( $result ) {
				mysqli_free_result( $result );
			}
		}
	}

    /**
     * Class ws_system
     * @desc 系统模块
     */
	class ws_system {
		/*
		 * @desc 获取轮播图列表
		 */
		public function getCarouselList () {
			$db = new ws_db();
			$link = $db->getLink();

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
			$db->free($result);
			// 关闭数据库连接
			$db->close($link);
			// 返回查询结果
			return $arr;
		}

		/*
		 * @desc 获取合作伙伴列表
		 */
		public function getPartnerList () {
			$db = new ws_db();
			$link = $db->getLink();

			// sql 查询
			$query = "select * from partner";
			mysqli_query( $link, "set character set 'utf8'" );//读库
			// 执行sql查询
			$result = mysqli_query( $link, $query ) or die("sql exec failed");

			$arr = [];

			while ( $row = mysqli_fetch_array( $result ) ) {
				$arr[] = array(
					"id"   => $row['id'],
					"title"  => $row['title'],
					"imagesPath"  => $row['imagesPath'],
				);
			}

			// 释放查询资源
			$db->free( $result );
			// 关闭数据库连接
			$db->close($link);
			// 返回查询结果
			return $arr;
		}

        /**
         * @desc 输出需要返回的值
         * @param $res {Array} 需要输出的值
         */
        public static function response ( $res ) {
            if ($res) {
                echo json_encode($res, JSON_UNESCAPED_UNICODE);
            }
        }

	}

    /**
     * Class ws_news
     * @desc 新闻模块
     */
	class ws_news {

        /**
         * @desc 获取所有新闻列表
         * @return array
         */
	    public static function getAllNewsList () {
            $db = new ws_db();
			$link = $db->getLink();

            // sql 查询
            $query = "select * from news where isDel = 0";
            mysqli_query($link,"set character set 'utf8'");//读库
            // 执行sql查询
            $result = mysqli_query($link, $query) or die("sql exec failed");

            $arr = [];

            while ( $row = mysqli_fetch_array($result) ) {
                $arr[] = array(
                    "id"    => $row['id'],
                    "title" => $row['title'],
                    "time"  => $row['time']
                );
            }

            $db->free($result);
            $db->close($link);
            return $arr;
        }

        /**
         * @desc 获取雾盛动态列表
         * @return array
         */
        public static function getCompanyNewsList () {
	        $db = new ws_db();
			$link = $db->getLink();

            // sql 查询
            $query = "select * from news where type='Company' and isDel=0";
            mysqli_query($link,"set character set 'utf8'");//读库
            // 执行sql查询
            $result = mysqli_query($link, $query) or die("sql exec failed");

            $arr = [];

            while ( $row = mysqli_fetch_array($result) ) {
                $arr[] = array(
                    "id"    => $row['id'],
                    "title" => $row['title'],
                    "time"  => $row['time']
                );
            }

            $db->free($result);
            $db->close($link);
            return $arr;
        }
    }


?>