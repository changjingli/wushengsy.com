<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/6/15
 * Time: 17:49
 * Desc: 雾盛案例逻辑
 */

require_once "../common/ws_db.php";
require_once "../common/ws_system.php";

class ws_case
{
    const TABLE_NAME = 'wusheng.case'; // 表名

    /**
     * 获取指定类型的案例
     *
     * @param $type {string} 指定类型 - penwujiangwen, penwuchuchou, penwuchuchen, penwujiashi, jingguanzaowu
     *
     * @return array
     */
    public function getCaseList ( $type )
    {
        $system = new ws_system();

        if ( !$type ) {
            $system->error( 2001, '请选择要获取的案例类型' );
        }
        $db = new ws_db();
        $link = $db->getLink();

        // sql 查询
        $query = "select * from " . self::TABLE_NAME . " where type='$type' and isDel=0 order by id desc";
        mysqli_query( $link, "set character set 'utf8'" );//读库
        // 执行sql查询
        $result = mysqli_query( $link, $query ) or die( "sql exec failed" );

        $arr = [];

        while ( $row = mysqli_fetch_array( $result ) ) {
            $arr[] = array(
                "id" => $row[ 'id' ],
                "title" => $row[ 'title' ],
                "thumb" => $row[ 'thumb' ],
                "type" => $row[ 'type' ],
            );
        }

        $db->free( $result );
        $db->close( $link );

        return $arr;
    }

    /**
     * 获取案例详情
     */
    public function getCaseDetail ()
    {
        $id = @$_REQUEST[ 'id' ];
        $system = new ws_system();

        if ( !$id ) {
            $system->error( 2001, '请传入案例的id' );
        }

        $db = new ws_db();
        $link = $db->getLink();

        // sql 查询
        $query = "select * from " . self::TABLE_NAME . " where isDel=0 and id=" . $id;
        mysqli_query( $link, "set character set 'utf8'" );//读库
        // 执行sql查询
        $result = mysqli_query( $link, $query ) or die( "sql exec failed" );

        if ( !mysqli_num_rows( $result ) ) {
            $system->rowsNotExist();
            exit();
        }

        // 对应案例访问量增加1
        mysqli_query( $link, "UPDATE " . self::TABLE_NAME . " SET view=view+1 where id=" . $id );

        $arr = [];

        while ( $row = mysqli_fetch_array( $result ) ) {
            $arr = array(
                "id" => $row[ 'id' ], // 案例id
                "title" => $row[ 'title' ], // 案例标题
                "type" => $row[ 'type' ], // 案例标题
                "author" => $row[ 'author' ], // 作者
                "time" => $row[ 'time' ], // 发布时间
                "content" => $row[ 'content' ], // 案例内容
                "view" => $row[ 'view' ], // 浏览次数
            );
        }

        $db->free( $result );
        $db->close( $link );

        return $arr;
    }

    /**
     * 编辑案例
     * @return array
     */
    public function editCaseById ()
    {
        $id = @$_REQUEST[ 'id' ];
        $system = new ws_system();

        if ( !$id ) {
            $system->error( 2001, '请传入要编辑案例的id' );
        }

        $db = new ws_db();
        $link = $db->getLink();

        $title = $_REQUEST[ 'title' ];
        $type = $_REQUEST[ 'type' ];
        $author = $_REQUEST[ 'author' ];
        $content = $_REQUEST[ 'content' ];
        $view = $_REQUEST[ 'view' ];
        $thumb = $_REQUEST[ 'thumb' ];

        // 更新对应案例
        $result = mysqli_query( $link, "UPDATE " . self::TABLE_NAME . " SET title = '" . $title . "', type = '" . $type . "', author = '" . $author . "', view = '" . $view . "', content = '" . $content . "', thumb = '" . $thumb . "' where id=" . $id );

        $res = array(
            "code" => $result ? 1000 : 2000,
            "desc" => "编辑" . ( $result ? "成功" : "失败" )
        );

        $db->close( $link );

        return $res;
    }

    /**
     * 删除对应id的案例
     * @return array
     */
    public function deleteCaseById () {
        $id = @$_REQUEST[ 'id' ];
        $system = new ws_system();

        if ( !$id ) {
            $system->error( 2001, '请传入要编辑案例的id' );
        }

        $db = new ws_db();
        $link = $db->getLink();

        // 删除对应案例
        $result = mysqli_query( $link, "UPDATE " . self::TABLE_NAME . " SET isDel=1 where id=" . $id ) or die( "sql exec failed" );

        $res = array(
            "code" => $result ? 1000 : 2000,
            "desc" => "删除" . ( $result ? "成功" : "失败" )
        );

        $db->close( $link );

        return $res;
    }
}