<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/5/13
 * Time: 16:01
 * Desc: 雾盛数据库逻辑
 */

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
