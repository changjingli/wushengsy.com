<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/6/11
 * Time: 20:38
 */

class ws_product {
    /**
     * 获取喷头管件列表
     * @return array
     */
    public function getPenTouGuanJianList () {
        $db = new ws_db();
        $link = $db->getLink();

        // sql 查询
        $type = "pentouguanjian";
        $query = "select * from wusheng.product where isDel=0 and type='$type' order by id desc";
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
     * 获取主机列表
     * @return array
     */
    public function getZhuJiList () {
        $db = new ws_db();
        $link = $db->getLink();

        // sql 查询
        $type = "zhuji";
        $query = "select * from wusheng.product where isDel=0 and type='$type' order by id desc";
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

    
    public function getProductDetail () {

    }
}