<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/5/13
 * Time: 20:18
 */

require_once "../common/ws_db.php";
require_once "../common/ws_system.php";

class ws_product
{

    /**
     * 获取所有产品列表
     */
    public function getAllProductList ()
    {
        $db = new ws_db();
        $system = new ws_system();
        $link = $db->getLink();

        // sql 查询
        $query = "select * from wusheng.product where isDel=0 order by id desc";
        mysqli_query( $link, "set character set 'utf8'" );//读库
        // 执行sql查询
        $result = mysqli_query( $link, $query ) or die( "sql exec failed" );

        $arr = [];

        while ( $row = mysqli_fetch_array( $result ) ) {
            $arr[] = array(
                "id" => $row[ 'id' ],
                "title" => $row[ 'title' ],
                "thumb" => $row[ 'thumb' ],
                "type" => $row[ 'type' ]
            );
        }

        $system->response( $arr );

        $db->free( $result );
        $db->close( $link );
    }

    /**
     * @desc 获取喷头和管件列表
     */
    public function getPenTouGuanJianList ()
    {
        $db = new ws_db();
        $system = new ws_system();
        $link = $db->getLink();

        // sql 查询
        $type = "pentouguanjian";
        $query = "select * from wusheng.product where isDel=0 and type='$type' order by id desc";
        mysqli_query( $link, "set character set 'utf8'" );//读库
        // 执行sql查询
        $result = mysqli_query( $link, $query ) or die( "sql exec failed" );

        $arr = [];

        while ( $row = mysqli_fetch_array( $result ) ) {
            $arr[] = array(
                "id" => $row[ 'id' ],
                "title" => $row[ 'title' ],
                "thumb" => $row[ 'thumb' ],
                "type" => $row[ 'type' ]
            );
        }

        $system->response( $arr );

        $db->free( $result );
        $db->close( $link );
    }

    /**
     * @desc 获取主机列表
     */
    public function getZhuJiList ()
    {
        $db = new ws_db();
        $system = new ws_system();
        $link = $db->getLink();

        // sql 查询
        $type = "zhuji";
        $query = "select * from wusheng.product where isDel=0 and type='$type' order by id desc";
        mysqli_query( $link, "set character set 'utf8'" );//读库
        // 执行sql查询
        $result = mysqli_query( $link, $query ) or die( "sql exec failed" );

        $arr = [];

        while ( $row = mysqli_fetch_array( $result ) ) {
            $arr[] = array(
                "id" => $row[ 'id' ],
                "title" => $row[ 'title' ],
                "thumb" => $row[ 'thumb' ],
                "type" => $row[ 'type' ]
            );
        }

        $system->response( $arr );

        $db->free( $result );
        $db->close( $link );
    }

    /**
     * @desc 获取产品详情
     */
    public function getProductDetail ()
    {
        $id = @$_REQUEST[ 'id' ];
        $system = new ws_system();

        if ( !$id ) {
            $system->idNotExist();
            exit();
        }

        $db = new ws_db();
        $link = $db->getLink();

        // sql 查询
        $query = "select * from wusheng.product where isDel=0 and id=" . $id;
        mysqli_query( $link, "set character set 'utf8'" );//读库
        // 执行sql查询
        $result = mysqli_query( $link, $query ) or die( "sql exec failed" );

        if ( !mysqli_num_rows( $result ) ) {
            $system->rowsNotExist();
            exit();
        }

        // 对应案例访问量增加1
        mysqli_query( $link, "UPDATE wusheng.product SET view=view+1 where id=" . $id );

        $arr = [];

        while ( $row = mysqli_fetch_array( $result ) ) {
            $arr = array(
                "id" => $row[ 'id' ], // 产品id
                "title" => $row[ 'title' ], // 产品标题
                "type" => $row[ 'type' ], // 产品标题
                "author" => $row[ 'author' ], // 作者
                "time" => $row[ 'time' ], // 发布时间
                "content" => $row[ 'content' ], // 产品内容
                "view" => $row[ 'view' ], // 浏览次数
            );
        }

        $system->response( $arr );

        $db->free( $result );
        $db->close( $link );
    }

    /**
     * @desc 删除指定ID的产品
     */
    public function deleteProductById ()
    {
        $id = @$_REQUEST[ 'id' ];
        $system = new ws_system();

        if ( !$id ) {
            $system->idNotExist();
            exit();
        }

        $db = new ws_db();
        $link = $db->getLink();

        // sql 查询
        $query = "UPDATE wusheng.product SET isDel=1 where id=" . $id;
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

    /**
     * 编辑产品详情
     */
    public function editProductById () {
        $id = @$_REQUEST[ 'id' ];
        $system = new ws_system();

        if ( !$id ) {
            $system->idNotExist();
            exit();
        }

        $db = new ws_db();
        $link = $db->getLink();

        $title = $_REQUEST[ 'title' ];
        $type = $_REQUEST[ 'type' ];
        $author = $_REQUEST[ 'author' ];
        $content = $_REQUEST[ 'content' ];
        $view = $_REQUEST[ 'view' ];

        // 更新对应新闻
        $result = mysqli_query( $link, "UPDATE wusheng.product SET title = '" . $title . "', author = '" . $author . "', view = '" . $view . "', content = '" . $content . "', type = '" .$type. "' where id=" . $id );

        $res = array(
            "code" => $result ? 1000 : 2000,
            "desc" => "编辑" . ( $result ? "成功" : "失败" )
        );

        $system->response( $res );

        $db->close( $link );
    }

    /**
     * 新增产品
     */
    public function addProduct () {
        $system = new ws_system();
        $db = new ws_db();

        $link = $db->getLink();

        $type = $_REQUEST[ 'type' ];
        $title = $_REQUEST[ 'title' ];
        $author = $_REQUEST[ 'author' ];
        $view = $_REQUEST[ 'view' ];
        $content = $_REQUEST[ 'content' ];

        // 插入对应新闻
        $result = mysqli_query( $link, "INSERT into wusheng.product (type, title, author, view, content) values('$type', '$title', '$author', '$view', '$content')" );

        $res = array(
            "code" => $result ? 1000 : 2000,
            "desc" => "新增" . ( $result ? "成功" : "失败" )
        );

        $system->response( $res );

        $db->close( $link );
    }
}