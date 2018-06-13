<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/6/13
 * Time: 14:42
 * Desc: 视频逻辑处理
 */

require_once "../common/ws_db.php";
require_once "../common/ws_system.php";

class ws_video
{
    const TABLE_NAME = 'wusheng.videos';

    /**
     * 获取视频列表
     */
    public function getVideoList ()
    {
        $db = new ws_db();
        $system = new ws_system();
        $link = $db->getLink();

        // sql 查询
        $query = "select * from ".self::TABLE_NAME." where isDel=0 order by id desc";
        mysqli_query( $link, "set character set 'utf8'" );//读库
        // 执行sql查询
        $result = mysqli_query( $link, $query ) or die( "sql exec failed" );

        $arr = [];

        while ( $row = mysqli_fetch_array( $result ) ) {
            $arr[] = array(
                "id" => $row[ 'id' ],
                "src" => $row[ 'src' ],
                "title" => $row[ 'title' ],
                "poster" => $row[ 'poster' ],
                "type" => $row[ 'type' ]
            );
        }

        $system->response( $arr );

        $db->free( $result );
        $db->close( $link );
    }

    /**
     * 获取视频详情
     */
    public function getVideoDetail () {
        $id = @$_REQUEST[ 'id' ];
        $system = new ws_system();

        if ( !$id ) {
            $system->idNotExist();
            exit();
        }

        $db = new ws_db();
        $link = $db->getLink();

        // sql 查询
        $query = "select * from ".self::TABLE_NAME." where isDel=0 and id=" . $id;
        mysqli_query( $link, "set character set 'utf8'" );//读库
        // 执行sql查询
        $result = mysqli_query( $link, $query ) or die( "sql exec failed" );

        if ( !mysqli_num_rows( $result ) ) {
            $system->rowsNotExist();
            exit();
        }

        // 对应案例访问量增加1
        mysqli_query( $link, "UPDATE ".self::TABLE_NAME." SET view=view+1 where id=" . $id );

        $arr = [];

        while ( $row = mysqli_fetch_array( $result ) ) {
            $arr = array(
                "id"      => $row['id'     ], // 视频id
                "src"     => $row['src'    ], // 视频路径
                "title"   => $row['title'  ], // 视频标题
                "author"  => $row['author' ], // 作者
                "time"    => $row['time'   ], // 发布时间
                "poster"  => $row['poster' ], // 视频海报地址
                "view"    => $row['view'   ], // 浏览次数
                "type"    => $row['type'   ], // 视频类别
            );
        }

        $system->response( $arr );

        $db->free( $result );
        $db->close( $link );
    }

    /**
     * 新增视频
     */
    public function addVideo () {

    }

    /**
     * 编辑视频
     */
    public function editVideoById () {

    }

    /**
     * 删除视频
     */
    public function deleteVideoById () {
        $id = @$_REQUEST[ 'id' ];
        $system = new ws_system();

        if ( !$id ) {
            $system->idNotExist();
            exit();
        }

        $db = new ws_db();
        $link = $db->getLink();

        // sql 查询
        $query = "UPDATE ".self::TABLE_NAME." SET isDel=1 where id=" . $id;
        mysqli_query( $link, "set character set 'utf8'" );//读库
        // 执行sql查询
        $result = mysqli_query( $link, $query ) or die( "sql exec failed" );

        $res = array(
            "code" => $result ? 1000 : 2000,
            "desc" => "删除" . ( $result ? "成功" : "失败" )
        );

        $system->response( $res );

        $db->close( $link );
    }
}