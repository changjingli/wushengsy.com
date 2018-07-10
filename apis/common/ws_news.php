<?php
/**
 * Created by PhpStorm.
 * User: jingl
 * Date: 2018/5/13
 * Time: 16:02
 * Desc: 雾盛新闻逻辑
 */

require_once "../common/ws_db.php";
require_once "../common/ws_system.php";

/**
 * Class ws_news
 * @desc 新闻模块
 */
class ws_news
{

    /**
     * @desc 获取所有新闻列表
     */
    public function getAllNewsList ()
    {
        $system = new ws_system();
        $db = new ws_db();
        $link = $db->getLink();

        // sql 查询
        $query = "select * from news where isDel = 0";
        mysqli_query( $link, "set character set 'utf8'" );//读库
        // 执行sql查询
        $result = mysqli_query( $link, $query ) or die( "sql exec failed" );

        $arr = [];

        while ( $row = mysqli_fetch_array( $result ) ) {
            $arr[] = array(
                "id" => $row[ 'id' ],
                "title" => $row[ 'title' ],
                "time" => $row[ 'time' ]
            );
        }

        $system->response( $arr );

        $db->free( $result );
        $db->close( $link );
    }

    /**
     * @desc 获取雾盛动态列表
     */
    public function getCompanyNewsList ()
    {
        $system = new ws_system();
        $db = new ws_db();
        $link = $db->getLink();

        // sql 查询
        $query = "select * from news where type='Company' and isDel=0";
        mysqli_query( $link, "set character set 'utf8'" );//读库
        // 执行sql查询
        $result = mysqli_query( $link, $query ) or die( "sql exec failed" );

        $arr = [];

        while ( $row = mysqli_fetch_array( $result ) ) {
            $arr[] = array(
                "id" => $row[ 'id' ],
                "title" => $row[ 'title' ],
                "time" => $row[ 'time' ]
            );
        }

        $system->response( $arr );

        $db->free( $result );
        $db->close( $link );
    }

    /**
     * @desc 获取行业新闻列表
     */
    public function getIndustryNewsList ()
    {
        $system = new ws_system();
        $db = new ws_db();
        $link = $db->getLink();

        // sql 查询
        $query = "select * from news where type='Industry' and isDel=0";
        mysqli_query( $link, "set character set 'utf8'" );//读库
        // 执行sql查询
        $result = mysqli_query( $link, $query ) or die( "sql exec failed" );

        $arr = [];

        while ( $row = mysqli_fetch_array( $result ) ) {
            $arr[] = array(
                "id" => $row[ 'id' ],
                "title" => $row[ 'title' ],
                "time" => $row[ 'time' ]
            );
        }

        $system->response( $arr );

        $db->free( $result );
        $db->close( $link );
    }

    /**
     * 获取新闻详情
     */
    public function getNewsDetail ()
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
        $query = "select * from news where id=" . $id;
        mysqli_query( $link, "set character set 'utf8'" );//读库
        // 执行sql查询
        $result = mysqli_query( $link, $query ) or die( "sql exec failed" );

        if ( !mysqli_num_rows( $result ) ) {
            $system->rowsNotExist();
            exit();
        }

        // 对应案例访问量增加1
        mysqli_query( $link, "UPDATE wusheng.news SET view=view+1 where id=" . $id );

        $arr = [];

        while ( $row = mysqli_fetch_array( $result ) ) {
            $arr = array(
                "id" => $row[ 'id' ], // 新闻id
                "title" => $row[ 'title' ], // 新闻标题
                "author" => $row[ 'author' ], // 作者
                "time" => $row[ 'time' ], // 发布时间
                "content" => $row[ 'content' ], // 新闻内容
                "view" => $row[ 'view' ], // 浏览次数
            );
        }

        $system->response( $arr );

        $db->close( $link );
    }

    /**
     * 根据id删除指定新闻
     */
    public function deleteNewsById ()
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
        $query = "UPDATE wusheng.news SET isDel=1 where id=" . $id;
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
     * 编辑新闻
     */
    public function editNewsById ()
    {
        $id = @$_REQUEST[ 'id' ];
        $system = new ws_system();

        if ( !$id ) {
            $system->idNotExist();
            exit();
        }

        $db = new ws_db();
        $link = $db->getLink();

        $title = $_REQUEST[ 'title' ];
        $author = $_REQUEST[ 'author' ];
        $content = $_REQUEST[ 'content' ];
        $view = $_REQUEST[ 'view' ];

        // 更新对应新闻
        $result = mysqli_query( $link, "UPDATE wusheng.news SET title = '" . $title . "', author = '" . $author . "', view = '" . $view . "', content = '" . $content . "' where id=" . $id );

        $res = array(
            "code" => $result ? 1000 : 2000,
            "desc" => "编辑" . ( $result ? "成功" : "失败" )
        );

        $system->response( $res );

        $db->close( $link );
    }

    /**
     * 添加新闻
     */
    public function addNews ()
    {
        $system = new ws_system();
        $db = new ws_db();

        $link = $db->getLink();

        $type = $_REQUEST[ 'type' ];
        $title = $_REQUEST[ 'title' ];
        $author = $_REQUEST[ 'author' ];
        $view = $_REQUEST[ 'view' ];
        $content = $_REQUEST[ 'content' ];

        // 插入对应新闻
        $result = mysqli_query( $link, "INSERT into wusheng.news (type, title, author, view, content) values('$type', '$title', '$author', '$view', '$content')" );

        $res = array(
            "code" => $result ? 1000 : 2000,
            "desc" => "新增" . ( $result ? "成功" : "失败" )
        );

        $system->response( $res );

        $db->close( $link );
    }
}
