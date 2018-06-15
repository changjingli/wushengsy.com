<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/5/13
 * Time: 16:02
 */
/**
 * Class ws_system
 * @desc 系统模块
 */
require_once "../common/ws_db.php";

class ws_system
{
    /*
     * @desc 获取轮播图列表
     */
    public function getCarouselList ()
    {
        $db = new ws_db();
        $link = $db->getLink();

        // sql 查询
        $query = "select * from carousel";
        mysqli_query( $link, "set character set 'utf8'" );//读库
        // 执行sql查询
        $result = mysqli_query( $link, $query ) or die( "sql exec failed" );

        $arr = [];

        while ( $row = mysqli_fetch_array( $result ) ) {
            $arr[] = array(
                "id" => $row[ 'id' ],
                "src" => $row[ 'src' ],
                "alt" => $row[ 'alt' ],
                "href" => $row[ 'href' ],
            );
        }

        // 释放查询资源
        $db->free( $result );
        // 关闭数据库连接
        $db->close( $link );
        // 返回查询结果
        return $arr;
    }

    /*
     * @desc 获取合作伙伴列表
     */
    public function getPartnerList ()
    {
        $db = new ws_db();
        $link = $db->getLink();

        // sql 查询
        $query = "select * from partner";
        mysqli_query( $link, "set character set 'utf8'" );//读库
        // 执行sql查询
        $result = mysqli_query( $link, $query ) or die( "sql exec failed" );

        $arr = [];

        while ( $row = mysqli_fetch_array( $result ) ) {
            $arr[] = array(
                "id" => $row[ 'id' ],
                "title" => $row[ 'title' ],
                "imagesPath" => $row[ 'imagesPath' ],
            );
        }

        // 释放查询资源
        $db->free( $result );
        // 关闭数据库连接
        $db->close( $link );
        // 返回查询结果
        return $arr;
    }

    /**
     * @desc 输出需要返回的值
     *
     * @param $res {Array} 需要输出的值
     */
    public function response ( $res )
    {
        if ( $res ) {
            echo json_encode( $res, JSON_UNESCAPED_UNICODE );
        }
    }

    /**
     * @desc id不存在时处理结果
     */
    public function idNotExist ()
    {
        $this->response( array(
            "code" => "2001",
            "desc" => "请传入id"
        ) );
    }

    /**
     * @desc 返回空数据集时的处理
     */
    public function rowsNotExist ()
    {
        $this->response( array(
            "code" => "3000",
            "desc" => "未找到与该id匹配的记录"
        ) );
    }

    /**
     * 显示报错信息并停止运行
     * @param $code {number} 报错码
     * @param $msg {string} 报错信息
     */
    public function error ( $code, $msg )
    {
        $code = $code || 2000;
        $msg = $msg || '出错啦。。';

        $this->response( array(
            "code" => $code,
            "desc" => $msg
        ) );
        exit();
    }

}
