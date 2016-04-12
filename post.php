<?php
define('IN_TG', 'post');
define('IN_JS', 'post');
define('SCRIPT', 'post');
include_once 'includes/common.inc.php';
require_once 'title.php';
require_once 'header.php';
session_start();
if ($_GET['action'] == 'post') {
    _check_code($_SESSION['code'], $_POST['code']);
    _uniqid();
    $content = _mysql_string(_html($_POST['content']));
    $sql = "INSERT INTO tg_article SET tg_reid=0, tg_username='{$_COOKIE['username']}', tg_type={$_POST['type']},
tg_title='{$_POST['title']}', tg_content='$content',tg_date=NOW()";
    _query($sql);
}
?>
    <script type="text/javascript" src="js/code.js">
        <
        script
        type = "text/javascript"
        src = "js/skin.js" ></script>
    <div id="post">
        <h2>发表帖子</h2>
        <form method="post" name="post" action="?action=post">
            <dl>
                <dt>请认真填写一下内容</dt>
                <dd>
                    类　　型：
                    <label for="type1"><input type="radio" id="type1" name="type" value="1" checked="checked"/> <img
                            src="images/icon1.gif" alt="类型"/></label>
                    <?php
                    for ($i = 2; $i <= 8; $i++) {
                        echo "<label for=\"type$i\"><input type=\"radio\" id=\"type$i\" name=\"type\" value=\"$i\" />  <img src=\"images/icon$i.gif\" alt=\"类型\" /></label>";
                    }
                    ?>
                    <br/>　　　 　　<?php
                    for ($i = 9; $i <= 16; $i++) {
                        echo "<label for=\"type$i\"><input type=\"radio\" id=\"type$i\" name=\"type\" value=\"$i\" />  <img src=\"images/icon$i.gif\" alt=\"类型\" /></label>";
                    }
                    ?>
                <dd>标　　题：<input type="text" name="title" class="text"/> (*必填，2-40位)</dd>
                <dd id="q">贴　　图：　<a href="javascript:;">Q图系列[1]</a>　 <a href="javascript:;">Q图系列[2]</a>　 <a
                        href="javascript:;">Q图系列[3]</a></dd>
                <dd>
                    <?php require 'includes/ubb.inc.php' ?>
                    <textarea name="content" rows="9"></textarea>
                </dd>
                <dd>验 证 码：<input type="text" name="code" class="text yzm"/> <img src="code.php" id="code"
                                                                                 onclick="javascript:this.src='code.php?tm='+Math.random();"/>
                    <input type="submit" class="submit" value="发表帖子"/></dd>
            </dl>
        </form>
    </div>
<?php require 'footer.php' ?>