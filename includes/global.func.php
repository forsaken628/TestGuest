<?php
/**
 * TestGuest Version1.0
 * ================================================
 * Copy 2010-2012 yc60
 * Web: http://www.yc60.com
 * ================================================
 * Author: Lee
 * Date: 2010-8-11
 */
/*
*删除目录和文件
*/
function _remove_Dir($dirName)
{
    if (!is_dir($dirName)) {
        return false;
    }
    $handle = @opendir($dirName);
    while (($file = @readdir($handle)) !== false) {
        if ($file != '.' && $file != '..') {
            $dir = $dirName . '/' . $file;
            is_dir($dir) ? _remove_Dir($dir) : @unlink($dir);
        }
    }
    closedir($handle);
    return rmdir($dirName);
}

/*
*判断是否是正常用户
*/
function _manage_login()
{
    if ((!isset($_COOKIE['username'])) || (!isset($_SESSION['admin']))) {
        _alert_back('非法登录！');
    }
}

/*
*检查间隔时间
*/
function _timed($_now_time, $_pre_time, $_second)
{
    if ($_now_time - $_pre_time < $_second) {
        _alert_back('请阁下休息一会儿再发帖！');
    }
}


/**
 *_runtime()是用来获取执行耗时
 * @access public  表示函数对外公开
 * @return float 表示返回出来的是一个浮点型数字
 */
function _runtime()
{
    $_mtime = explode(' ', microtime());
    return $_mtime[1] + $_mtime[0];
}

/**
 * _alert_back()表是JS弹窗
 * @access public
 * @param $_info
 * @return void 弹窗
 */
function _alert_back($_info)
{
    echo "<script type='text/javascript'>alert('$_info');history.back();</script>";
    exit();
}

/**
 * _alert_close()表是JS弹窗并且关闭窗口
 */
function _alert_close($_info)
{
    echo "<script type='text/javascript'>alert('$_info');window.close();</script>";
    exit();
}

/**
 * _location()表是JS弹窗并且跳转到指定url
 */
function _location($_info, $_url)
{
    if (!empty($_info)) {
        echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
        exit();
    } else {
        header('Location:' . $_url);
    }
}

/**
 * _login_state登录状态的判断
 */

function _login_state()
{
    if (isset($_COOKIE['username'])) {
        _alert_back('登录状态无法进行本操作！');
    }
}

/**
 * 判断唯一标识符是否异常
 * @param $_mysql_uniqid
 * @param $_cookie_uniqid
 */

function _uniqid($_mysql_uniqid = null, $_cookie_uniqid = null)
{
    if (is_null($_mysql_uniqid)) {
        $_mysql_uniqid = _fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}'");
        $_mysql_uniqid = $_mysql_uniqid['tg_uniqid'];
    }
    if (is_null($_cookie_uniqid)) {
        $_cookie_uniqid = $_COOKIE['uniqid'];
    }

    if ($_mysql_uniqid != $_cookie_uniqid) {
        _alert_back('唯一标识符异常！');
    }
}


function _thumb($_filename, $_new_wid = 70, $_new_filename = null)
{
    //生成png标头文件
    if (is_null($_new_filename)) {
        header('Content-type: image/png');
    }
    $_n = explode('.', $_filename);
    //获取文件信息，长和高
    list($_width, $_height) = getimagesize($_filename);
    $_percent = $_new_wid / max($_width, $_height);
    //生成缩微的长和高
    $_new_width = $_width * $_percent;
    $_new_height = $_height * $_percent;
    //创建一个以0.3百分比新长度的画布
    $_new_image = imagecreatetruecolor($_new_width, $_new_height);
    //按照已有的图片创建一个画布
    switch ($_n[1]) {
        case 'jpg' :
            $_image = imagecreatefromjpeg($_filename);
            break;
        case 'png' :
            $_image = imagecreatefrompng($_filename);
            break;
        case 'gif' :
            $_image = imagecreatefrompng($_filename);
            break;
    }
    //将原图采集后重新复制到新图上，就缩略了
    imagecopyresampled($_new_image, $_image, 0, 0, 0, 0, $_new_width, $_new_height, $_width, $_height);
    $_new_filename = fopen($_new_filename, 'w');
    imagepng($_new_image, $_new_filename);
    imagedestroy($_new_image);
    imagedestroy($_image);
}

/**
 *首页读取new.xml
 *获取新注册用户信息数据
 */
function _get_xml($_xmlfile)
{
    $_html = array();
    if (file_exists($_xmlfile)) {
        $_html = get_object_vars(simplexml_load_file($_xmlfile));
    } else {
        echo '文件不存在';
    }
    return $_html;
}

/**
 *
 *新注册用户信息数据写入到new.xml文件
 */
function _set_xml($_xmlfile, $_clean)
{

    $_fp = @fopen($_xmlfile, 'w');
    if (!$_fp) {
        exit('系统错误，文件不存在！');
    }
    flock($_fp, LOCK_EX);

    $_string = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
    fwrite($_fp, $_string, strlen($_string));
    $_string = "<vip>\r\n";
    fwrite($_fp, $_string, strlen($_string));
    $_string = "\t<id>{$_clean['id']}</id>\r\n";
    fwrite($_fp, $_string, strlen($_string));
    $_string = "\t<username>{$_clean['username']}</username>\r\n";
    fwrite($_fp, $_string, strlen($_string));
    $_string = "\t<sex>{$_clean['sex']}</sex>\r\n";
    fwrite($_fp, $_string, strlen($_string));
    $_string = "\t<face>{$_clean['face']}</face>\r\n";
    fwrite($_fp, $_string, strlen($_string));
    $_string = "\t<email>{$_clean['email']}</email>\r\n";
    fwrite($_fp, $_string, strlen($_string));
    $_string = "\t<url>{$_clean['url']}</url>\r\n";
    fwrite($_fp, $_string, strlen($_string));
    $_string = "</vip>";
    fwrite($_fp, $_string, strlen($_string));

    flock($_fp, LOCK_UN);
    fclose($_fp);

    /*$sxe = new SimpleXMLElement('<vip></vip>');
 

    foreach ( $_clean as $key => $value) {
         $sxe->addChild($key,$value);
        # code...
    }
    echo $sxe->asXML();
    file_put_contents($file, $current);


    */
}

/**
 *把字符串内容中特殊标签替换表情图片
 */
function _ubb($_string)
{
    $_string = nl2br($_string);
    $_string = preg_replace('/\[size=(.*)\](.*)\[\/size\]/U', '<span style="font-size:\1px">\2</span>', $_string);
    $_string = preg_replace('/\[b\](.*)\[\/b\]/U', '<strong>\1</strong>', $_string);
    $_string = preg_replace('/\[i\](.*)\[\/i\]/U', '<em>\1</em>', $_string);
    $_string = preg_replace('/\[u\](.*)\[\/u\]/U', '<span style="text-decoration:underline">\1</span>', $_string);
    $_string = preg_replace('/\[s\](.*)\[\/s\]/U', '<span style="text-decoration:line-through">\1</span>', $_string);
    $_string = preg_replace('/\[color=(.*)\](.*)\[\/color\]/U', '<span style="color:\1">\2</span>', $_string);
    $_string = preg_replace('/\[url\](.*)\[\/url\]/U', '<a href="\1" target="_blank">\1</a>', $_string);
    $_string = preg_replace('/\[email\](.*)\[\/email\]/U', '<a href="mailto:\1">\1</a>', $_string);
    $_string = preg_replace('/\[img\](.*)\[\/img\]/U', '<img src="\1" alt="图片" />', $_string);
    $_string = preg_replace('/\[flash\](.*)\[\/flash\]/U', '<embed style="width:480px;height:400px;" src="\1" />', $_string);
    return $_string;
}


/**
 * _title()标题截取函数
 * @param $_string
 */

function _title($_string, $_strlen)
{
    if (mb_strlen($_string, 'utf-8') > $_strlen) {
        $_string = mb_substr($_string, 0, $_strlen, 'utf-8') . '...';
    }
    return $_string;
}

/**
 * _html() 函数表示对字符串进行HTML过滤显示，如果是数组按数组的方式过滤，
 * 如果是单独的字符串，那么就按单独的字符串过滤
 * @param mixed $_string
 */


function _html($_string)
{
    if (is_array($_string)) {
        foreach ($_string as $_key => $_value) {
            $_string[$_key] = _html($_value);   //这里采用了递归，如果不理解，那么还是用htmlspecialchars
        }
    } else {
        $_string = htmlspecialchars($_string);
    }
    return $_string;
}

/**
 * _mysql_string写入数据库前验证是否需要转义字符串
 */

function _mysql_string($_string)
{
    //get_magic_quotes_gpc()如果开启状态，那么就不需要转义
    if (!GPC) {
        if (is_array($_string)) {
            foreach ($_string as $_key => $_value) {
                $_string[$_key] = _mysql_string($_value);   //这里采用了递归，如果不理解，那么还是用htmlspecialchars
            }
        } else {
            $_string = mysql_real_escape_string($_string);
        }
    }
    return $_string;
}


/**
 *
 * @param $_sql
 * @param $_size
 */

function _page($_sql, $_size)
{
    //将里面的所有变量取出来，外部可以访问
    //$_page：当前页 ,$_pagesize:每页显示记录数 ,$_pagenum:当前起始记录数 , $_pageabsolute:总页数 ,$_num :总记录数
    global $_page, $_pagesize, $_pagenum, $_pageabsolute, $_num;
    if (isset($_GET['page'])) {
        $_page = $_GET['page'];
        if (empty($_page) || $_page <= 0 || !is_numeric($_page)) {
            $_page = 1;
        } else {
            $_page = intval($_page);
        }
    } else {
        $_page = 1;
    }
    $_pagesize = $_size;
    $result = _query($_sql);
    $row = mysqli_fetch_array($result);
    $_num = $row[0];
    if ($_num == 0) {
        $_pageabsolute = 1;
    } else {
        $_pageabsolute = ceil($_num / $_pagesize);
    }
    if ($_page > $_pageabsolute) {
        $_page = $_pageabsolute;
    }
    $_pagenum = ($_page - 1) * $_pagesize;
}


/**
 * _paging分页函数
 * @param $_type
 * @return 返回分页
 */

function _paging($_type)
{
    global $_page, $_pageabsolute, $_num, $_id;
    if ($_type == 1) {
        echo '<div id="page_num">';
        echo '<ul>';
        for ($i = 0; $i < $_pageabsolute; $i++) {
            if ($_page == ($i + 1)) {
                echo '<li><a href="' . SCRIPT . '.php?' . $_id . 'page=' . ($i + 1) . '" class="selected">' . ($i + 1) . '</a></li>';
            } else {
                echo '<li><a href="' . SCRIPT . '.php?' . $_id . 'page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
            }
        }
        echo '</ul>';
        echo '</div>';
    } elseif ($_type == 2) {
        echo '<div id="page_text">';
        echo '<ul>';
        echo '<li>' . $_page . '/' . $_pageabsolute . '页 | </li>';
        echo '<li>共有<strong>' . $_num . '</strong>条数据 | </li>';
        if ($_page == 1) {
            echo '<li>首页 | </li>';
            echo '<li>上一页 | </li>';
        } else {
            echo '<li><a href="' . SCRIPT . '.php">首页</a> | </li>';
            echo '<li><a href="' . SCRIPT . '.php?' . $_id . 'page=' . ($_page - 1) . '">上一页</a> | </li>';
        }
        if ($_page == $_pageabsolute) {
            echo '<li>下一页 | </li>';
            echo '<li>尾页</li>';
        } else {
            echo '<li><a href="' . SCRIPT . '.php?' . $_id . 'page=' . ($_page + 1) . '">下一页</a> | </li>';
            echo '<li><a href="' . SCRIPT . '.php?' . $_id . 'page=' . $_pageabsolute . '">尾页</a></li>';
        }
        echo '</ul>';
        echo '</div>';
    } else {
        _paging(2);
    }
}


/**
 * _session_destroy删除session
 */

function _session_destroy()
{
    if (session_start()) {
        session_destroy();
    }
}

/**
 * 删除cookies   _unsetcookies()
 */

function _unsetcookies()
{
    setcookie('username', '', time() - 1);
    setcookie('uniqid', '', time() - 1);
    _session_destroy();
    _location(null, 'index.php');
}


/**
 *
 */

function _sha1_uniqid()
{
    return _mysql_string(sha1(uniqid(mt_rand(), true)));
}


/**
 * @param $_first_code
 * @param $_end_code
 */
function _check_code($_first_code, $_end_code)
{
    if ($_first_code != $_end_code) {
        _alert_back('验证码不正确!');
    }
}

/**
 * _code()是验证码函数
 * @access public
 * @param int $_width 表示验证码的长度
 * @param int $_height 表示验证码的高度
 * @param int $_rnd_code 表示验证码的位数
 * @param bool $_flag 表示验证码是否需要边框
 * @return void 这个函数执行后产生一个验证码
 */
function _code($_width = 75, $_height = 25, $_rnd_code = 4, $_flag = false)
{
    $_nmsg = '';
    //创建随机码
    for ($i = 0; $i < $_rnd_code; $i++) {
        $_nmsg .= dechex(mt_rand(0, 15));
    }

    //保存在session
    $_SESSION['code'] = $_nmsg;

    //创建一张图像
    $_img = imagecreatetruecolor($_width, $_height);

    //白色
    $_white = imagecolorallocate($_img, 255, 255, 255);

    //填充
    imagefill($_img, 0, 0, $_white);

    if ($_flag) {
        //黑色,边框
        $_black = imagecolorallocate($_img, 0, 0, 0);
        imagerectangle($_img, 0, 0, $_width - 1, $_height - 1, $_black);
    }

    //随即画出6个线条
    for ($i = 0; $i < 6; $i++) {
        $_rnd_color = imagecolorallocate($_img, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imageline($_img, mt_rand(0, $_width), mt_rand(0, $_height), mt_rand(0, $_width), mt_rand(0, $_height), $_rnd_color);
    }

    //随即雪花
    for ($i = 0; $i < 100; $i++) {
        $_rnd_color = imagecolorallocate($_img, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
        imagestring($_img, 1, mt_rand(1, $_width), mt_rand(1, $_height), '*', $_rnd_color);
    }

    //输出验证码
    for ($i = 0; $i < strlen($_SESSION['code']); $i++) {
        $_rnd_color = imagecolorallocate($_img, mt_rand(0, 100), mt_rand(0, 150), mt_rand(0, 200));
        imagestring($_img, 5, $i * $_width / $_rnd_code + mt_rand(1, 10), mt_rand(1, $_height / 2), $_SESSION['code'][$i], $_rnd_color);
    }

    //输出图像
    header('Content-Type: image/png');
    imagepng($_img);

    //销毁
    imagedestroy($_img);
}