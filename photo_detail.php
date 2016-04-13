<?php
define('IN_TG', 'photo_detail');
define('IN_JS', 'article');
define('SCRIPT', 'photo_detail');
include_once 'includes/common.inc.php';
require_once 'title.php';
require_once 'header.php';
$id = intval($_GET['id']);
$_id = 'id=' . $id . '&';

session_start();
//加载页面主体
$html = _fetch_array("
SELECT p.tg_name, p.tg_url, p.tg_content, p.tg_sid, p.tg_username, p.tg_readcount, p.tg_commendcount, p.tg_date,tg_dir.tg_type
FROM tg_photo p JOIN tg_dir ON p.tg_sid = tg_dir.tg_id
WHERE p.tg_id = {$_GET['id']}");
//私密判断
if ($html['tg_type'] && !isset($_SESSION['photo_pwd'][$html['tg_sid']])) {
    _location('私密照片', "photo_show.php?id={$html['tg_sid']}");
}
//阅读量
if(isset($_COOKIE['username']) && !isset($_SESSION['photo_read'][$_GET['id']])){
    $_SESSION['photo_read'][$_GET['id']]=true;
    _query("UPDATE tg_photo SET tg_readcount=tg_readcount+1 WHERE tg_id={$_GET['id']}");
}
//前页后页
$result = _query("
(SELECT tg_id FROM tg_photo
WHERE tg_sid={$html['tg_sid']} AND tg_id>{$_GET['id']}
ORDER BY tg_id LIMIT 1)
UNION ALL
(SELECT tg_id FROM tg_photo
WHERE tg_sid={$html['tg_sid']} AND tg_id<{$_GET['id']}
ORDER BY tg_id DESC LIMIT 1)");
while ($nextPage = _fetch_array_list($result)) {
    $nextPage['tg_id'] > $_GET['id'] ? $next = $nextPage['tg_id'] : $pre = $nextPage['tg_id'];
}
?>
    <script type="text/javascript" src="js/code.js"></script>
    <div id="photo">
        <h2>图片详情</h2>
        <a name="pre"></a><a name="next"></a>
        <dl class="detail">
            <dd class="name"><?= $html['tg_name'] ?></dd>
            <dt>
                <a href="<?php if ($pre) echo "photo_detail.php?id=$pre" ?>#pre">上一页</a>
                <img src="<?= $html['tg_url'] ?>"/>
                <a href="<?php if ($next) echo "photo_detail.php?id=$next" ?>#next">下一页</a>
            </dt>
            <dd>[<a href="photo_show.php?id=<?= $html['tg_sid'] ?>">返回列表</a>]</dd>
            <dd>浏览量(<strong><?= $html['tg_readcount'] ?></strong>) 评论量(<strong><?= $html['tg_commendcount'] ?></strong>)
                发表于：<?= $html['tg_date'] ?> 上传者：<?= $html['tg_username'] ?></dd>
            <dd>简介：<?= $html['tg_content'] ?></dd>
        </dl>


        <p class="line"></p>


        <?php
        _page("SELECT count(tg_id) FROM tg_photo_commend WHERE tg_sid={$_GET['id']}", 10);//_page已优化
        $sql = "SELECT a.tg_username,a.tg_title,a.tg_content,a.tg_date,
b.tg_id,b.tg_email,b.tg_url,b.tg_sex,b.tg_face,b.tg_switch,b.tg_autograph
FROM tg_photo_commend a JOIN tg_user b ON a.tg_username=b.tg_username
WHERE a.tg_sid={$_GET['id']}
ORDER BY a.tg_id LIMIT $_pagenum,$_pagesize";
        $result = _query($sql);
        $i = $_pagenum;
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
                        <span><?php switch ($i) {
                                case 1:
                                    echo '沙发';
                                    break;
                                case 2:
                                    echo '地板';
                                    break;
                                default:
                                    echo '#'.$i;
                            } ?></span><?= $row['tg_username'] ?> | 发表于：<?= $row['tg_date'] ?>
                    </div>
                    <h3><?= $row['tg_title'] ?>
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
        echo '<div id="page_num">';
        _paging(1);
        echo '</div>';
        ?>
        <form method="post" action="?action=rephoto">
            <input type="hidden" name="sid" value="16"/>
            <dl class="rephoto">
                <dd>标　　题：<input type="text" name="title" class="text" value="RE:ChinaJoyMM9"/> (*必填，2-40位)</dd>
                <dd id="q">贴　　图：　<a href="javascript:;">Q图系列[1]</a>　
                    <a href="javascript:;">Q图系列[2]</a>　
                    <a href="javascript:;">Q图系列[3]</a>
                </dd>
                <dd>
                    <?php require 'includes/ubb.inc.php' ?>
                    <textarea name="content" rows="9"></textarea>
                </dd>
                <dd>
                    验 证 码：
                    <input type="text" name="code" class="text yzm"/> <img src="code.php" id="code"/>
                    <input type="submit" class="submit" value="发表帖子"/></dd>
            </dl>
        </form>
    </div>
<?php require 'footer.php';