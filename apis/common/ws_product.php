<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/5/13
 * Time: 20:18
 */

require_once "../common/ws_db.php";
require_once "../common/ws_system.php";

class ws_product {
    /**
     * @desc 获取喷头和管件列表
     * @return array
     */
    public function getPenTouGuanJianList () {
        $db = new ws_db();
        $link = $db->getLink();

        // sql 查询
        $type = "pentouguanjian";
        $query = "select * from wusheng.product where isDel=0 and type='$type' order by id desc";
        mysqli_query($link,"set character set 'utf8'");//读库
        // 执行sql查询
        $result = mysqli_query($link, $query) or die("sql exec failed");

        $arr = [];

        while ( $row = mysqli_fetch_array($result) ) {
            $arr[] = array(
                "id"      => $row['id'],
                "title"   => $row['title'],
                "thumb"   => $row['thumb'],
                "type"    => $row['type']
            );
        }

        $db->free($result);
        $db->close($link);
        return $arr;
    }

    /**
     * @desc 获取主机列表
     * @return array
     */
    public function getZhuJiList () {
        $db = new ws_db();
        $link = $db->getLink();

        // sql 查询
        $type = "zhuji";
        $query = "select * from wusheng.product where isDel=0 and type='$type' order by id desc";
        mysqli_query($link,"set character set 'utf8'");//读库
        // 执行sql查询
        $result = mysqli_query($link, $query) or die("sql exec failed");

        $arr = [];

        while ( $row = mysqli_fetch_array($result) ) {
            $arr[] = array(
                "id"      => $row['id'],
                "title"   => $row['title'],
                "thumb"   => $row['thumb'],
                "type"    => $row['type']
            );
        }

        $db->free($result);
        $db->close($link);
        return $arr;
    }

    /**
     * @desc 获取产品详情
     * @return array
     */
    public function getProductDetail() {
        $id = @$_REQUEST[ 'id' ];
        $system = new ws_system();

        if ( !$id ) {
            $system->idNotExist();
            exit();
        }

        $db = new ws_db();
        $link = $db->getLink();

        // sql 查询
        $query = "select * from wusheng.product where isDel=0 and id=".$id;
        mysqli_query($link,"set character set 'utf8'");//读库
        // 执行sql查询
        $result = mysqli_query($link, $query) or die("sql exec failed");

        if ( !mysqli_num_rows($result) ) {
            $system->rowsNotExist();
            exit();
        }

        // 对应案例访问量增加1
        mysqli_query( $link, "UPDATE wusheng.product SET view=view+1 where id=".$id );

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

        $db->free($result);
        $db->close($link);
        return $arr;
    }

    /**
     * @desc 删除指定ID的产品
     */
    public function deleteProductById () {
        $id = @$_REQUEST[ 'id' ];
        $system = new ws_system();

        if ( !$id ) {
            $system->idNotExist();
            exit();
        }

        $db = new ws_db();
        $link = $db->getLink();

        // sql 查询
        $query = "UPDATE wusheng.product SET isDel=1 where id=".$id;
        mysqli_query($link,"set character set 'utf8'");//读库
        // 执行sql查询
        $result = mysqli_query($link, $query) or die("sql exec failed");

        $res = array(
            "code" => $result ? "1000" : "2000",
            "desc" => "删除".($result ? "成功" : "失败")
        );

        $system->response( $res );

        $db->free($result);
        $db->close($link);
    }
}