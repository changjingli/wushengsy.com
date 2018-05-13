<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/5/13
 * Time: 16:02
 */

require_once "../common/ws_db.php";
require_once "../common/ws_system.php";

/**
 * Class ws_news
 * @desc 新闻模块
 */
class ws_news {

    /**
     * @desc 获取所有新闻列表
     * @return array
     */
    public function getAllNewsList () {
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
    public function getCompanyNewsList () {
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
                "id"    => $row['id'   ],
                "title" => $row['title'],
                "time"  => $row['time' ]
            );
        }

        $db->free($result);
        $db->close($link);
        return $arr;
    }
}
