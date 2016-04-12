<?php
define('IN_TG', 'article');
define('IN_JS', 'article');
define('SCRIPT', 'article');
include_once 'includes/common.inc.php';
require_once 'title.php';
require_once 'header.php';
session_start();

if ($_GET['action'] == 'rearticle') {
    _check_code($_SESSION['code'], $_POST['code']);
    _uniqid();
    $content = _mysql_string(_html($_POST['content']));
    $sql = "INSERT INTO tg_article SET tg_reid={$_GET['id']}, tg_username='{$_COOKIE['username']}', tg_type={$_POST['type']},
tg_title='{$_POST['title']}', tg_content='$content',tg_date=NOW()";
    _query($sql);
    _query("UPDATE tg_article SET tg_commendcount=tg_commendcount+1 WHERE tg_id={$_GET['id']}");
}

if(isset($_COOKIE['username']) && !isset($_SESSION['read'][$_GET['id']])){
    $_SESSION['read'][$_GET['id']]=true;
    _query("UPDATE tg_article SET tg_readcount=tg_readcount+1 WHERE tg_id={$_GET['id']}");
}

$id = intval($_GET['id']);
$_id = 'id=' . $id . '&';
$sql = "SELECT a.tg_username,a.tg_type,a.tg_title,a.tg_content,a.tg_readcount,a.tg_commendcount,a.tg_nice,
a.tg_last_modify_date,a.tg_date,b.tg_id,b.tg_email,b.tg_url,b.tg_sex,b.tg_face,b.tg_switch,b.tg_autograph
FROM tg_article a JOIN tg_user b ON a.tg_username=b.tg_username WHERE a.tg_id={$id}";
$row = _fetch_array($sql);
if (!$row) {
    _alert_close('此帖不存在');
}
$tg_title = $row['tg_title']
?>
    <script type="text/javascript" src="js/code.js"></script>
    <script type="text/javascript" src="js/skin.js"></script>
    <div id="article">
        <h2>帖子详情</h2>
        <?php if ($row['tg_nice']) { ?>
            <img src="images/nice.gif" alt="精华帖" class="nice"/>
        <?php }
        if ($row['tg_commendcount'] > 5) { ?>
            <img src="images/hot.gif" alt="热帖" class="hot"/>
        <?php } ?>
        <div id="subject">
            <dl>
                <?php
                $content = _ubb($row['tg_content']);
                ?>
                <dd class="user"><?= $row['tg_username'] ?>(<?= $row['tg_sex'] ?>)[楼主]</dd>
                <dt><img src="<?= $row['tg_face'] ?>" alt="<?= $row['tg_username'] ?>"/></dt>
                <dd class="message"><a href="javascript:;" name="message" title="<?= $row['tg_id'] ?>">发消息</a></dd>
                <dd class="friend"><a href="javascript:;" name="friend" title="<?= $row['tg_id'] ?>">加为好友</a></dd>
                <dd class="guest">写留言</dd>
                <dd class="flower"><a href="javascript:;" name="flower" title="<?= $row['tg_id'] ?>">给他送花</a></dd>
                <dd class="email">邮件：<a href="mailto:<?= $row['tg_email'] ?>"><?= $row['tg_email'] ?></a></dd>
                <dd class="url">网址：<a href="<?= $row['tg_url'] ?>" target="_blank"><?= $row['tg_url'] ?></a></dd>
            </dl>
        </div>
        <div class="content">
            <div class="user">
				<span>
                    <?php if (false) { ?>
                        [<a href="article.php?action=nice&on=0&id=<?= $id ?>">取消精华</a>]
                    <?php } ?>
                    <?php if ($row['tg_username'] == $_COOKIE['username']) { ?>
                        [<a href="article_modify.php?id=<?= $id ?>">修改</a>]
                    <?php } ?>
                    1#
				</span><?= $row['tg_username'] ?> | 发表于：<?= $row['tg_date'] ?>
            </div>
            <h3>主题：<?= $row['tg_title'] ?> <img src="images/icon<?= $row['tg_type'] ?>.gif" alt="icon"/>
                <span>[<a href="#ree" name="re" title="回复1楼的<?= $row['tg_username'] ?>">回复</a>]</span>
            </h3>
            <div class="detail">
                <?php
                echo $content;
                if ($row['tg_switch']) {
                    ?>
                    <p class="autograph"><?= _ubb($row['tg_autograph']) ?></p>
                <?php } ?>
            </div>
            <div class="read">
                <?php if ($row['tg_last_modify_date'] != 0) { ?>
                    <p>本贴已由[<?php echo $row['tg_username'] ?>]于<?php echo $row['tg_last_modify_date'] ?>修改过！</p>
                <?php } ?>
                阅读量：(<?php echo $row['tg_readcount'] ?>) 评论量：(<?php echo $row['tg_commendcount'] ?>)
            </div>
        </div>
        <p class="line"></p>
        <?php
        _page("SELECT count(tg_id) FROM tg_article WHERE tg_reid=$id", 10);//_page已优化
        $sql = "SELECT a.tg_username,a.tg_type,a.tg_title,a.tg_content,a.tg_readcount,a.tg_commendcount,a.tg_nice,
a.tg_last_modify_date,a.tg_date,b.tg_id,b.tg_email,b.tg_url,b.tg_sex,b.tg_face,b.tg_switch,b.tg_autograph
FROM tg_article a JOIN tg_user b ON a.tg_username=b.tg_username
WHERE a.tg_reid={$id}
ORDER BY a.tg_id LIMIT $_pagenum,$_pagesize";
        $result = _query($sql);
        $i = $_pagenum + 1;
        while ($row = _fetch_array_list($result)) {
            $i++;
            ?>

            <div class="re">
                <dl>
                    <dd class="user"><?= $row['tg_username'] ?>(<?= $row['tg_sex'] ?>)</dd>
                    <dt><img src="<?= $row['tg_face'] ?>" alt="<?= $row['tg_username'] ?>"/></dt>
                    <dd class="message"><a href="javascript:;" name="message" title="<?= $row['tg_id'] ?>">发消息</a>
                    </dd>
                    <dd class="friend"><a href="javascript:;" name="friend" title="<?= $row['tg_id'] ?>">加为好友</a>
                    </dd>
                    <dd class="guest">写留言</dd>
                    <dd class="flower"><a href="javascript:;" name="flower" title="<?= $row['tg_id'] ?>">给他送花</a>
                    </dd>
                    <dd class="email">邮件：<a href="mailto:<?= $row['tg_email'] ?>"><?= $row['tg_email'] ?></a></dd>
                    <dd class="url">网址：<a href="<?= $row['tg_url'] ?>" target="_blank"><?= $row['tg_url'] ?></a>
                    </dd>
                </dl>
                <div class="content">
                    <div class="user">
                        <span><?= $i ?>#</span><?= $row['tg_username'] ?> | 发表于：<?= $row['tg_date'] ?>
                    </div>
                    <h3><?= $row['tg_title'] ?> <img src="images/icon<?= $row['tg_type'] ?>.gif" alt="icon"/>
                            <span>[<a href="#ree" name="re"
                                      title="回复<?= $i ?>楼的<?= $row['tg_username'] ?>">回复</a>]</span>
                    </h3>
                    <div class="detail">
                        <?php
                        echo _ubb($row['tg_content']);
                        if ($row['tg_switch']) { ?>
                            <p class="autograph">
                                <?= _ubb($row['tg_autograph']) ?>
                            </p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <p class="line"></p>
            <?php
        }
        _paging(1);
        ?>
        <a name="ree"></a>
        <form method="post" action="?<?= $_id ?>action=rearticle">
            <input type="hidden" name="reid" value="16"/>
            <input type="hidden" name="type" value="1"/>
            <dl>
                <dd>标　　题：<input type="text" name="title" class="text" value="RE:<?= $tg_title ?>"/> (*必填，2-40位)
                </dd>
                <dd id="q">贴　　图：　<a href="javascript:;">Q图系列[1]</a>　 <a href="javascript:;">Q图系列[2]</a>　 <a
                        href="javascript:;">Q图系列[3]</a></dd>
                <dd>
                    <?php require 'includes/ubb.inc.php' ?>
                    <textarea name="content" rows="9"></textarea>
                </dd>

                <dd>
                    验 证 码：
                    <input type="text" name="code" class="text yzm"/>
                    <img src="code.php" id="code" onclick="javascript:this.src='code.php?tm='+Math.random();"/>
                    <input type="submit" class="submit" value="发表帖子"/>
                </dd>
            </dl>
        </form>
    </div>
<?php
require_once 'footer.php';