<?php
define('IN_TG', 'article');
define('IN_JS', 'article');
define('SCRIPT', 'article');
include_once 'includes/common.inc.php';
require_once 'title.php';
require_once 'header.php';

$id = intval($_GET['id']);
$_id = 'id=' . $id . '&';
$sql = "SELECT a.tg_username,a.tg_type,a.tg_title,a.tg_content,a.tg_readcount,a.tg_commendcount,a.tg_nice,
a.tg_last_modify_date,a.tg_date,b.tg_id,b.tg_email,b.tg_url,b.tg_sex,b.tg_face,b.tg_switch,b.tg_autograph
FROM tg_article a JOIN tg_user b ON a.tg_username=b.tg_username WHERE a.tg_id={$id}";
$row = _fetch_array($sql);
if(!$row){
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
                    <div id="ubb">
                        <img src="images/fontsize.gif" title="字体大小" alt="字体大小"/>
                        <img src="images/space.gif" title="线条" alt="线条"/>
                        <img src="images/bold.gif" title="粗体"/>
                        <img src="images/italic.gif" title="斜体"/>
                        <img src="images/underline.gif" title="下划线"/>
                        <img src="images/strikethrough.gif" title="删除线"/>
                        <img src="images/space.gif"/>
                        <img src="images/color.gif" title="颜色"/>
                        <img src="images/url.gif" title="超链接"/>
                        <img src="images/email.gif" title="邮件"/>
                        <img src="images/image.gif" title="图片"/>
                        <img src="images/swf.gif" title="flash"/>
                        <img src="images/movie.gif" title="影片"/>
                        <img src="images/space.gif"/>
                        <img src="images/left.gif" title="左区域"/>
                        <img src="images/center.gif" title="中区域"/>
                        <img src="images/right.gif" title="右区域"/>
                        <img src="images/space.gif"/>
                        <img src="images/increase.gif" title="扩大输入区"/>
                        <img src="images/decrease.gif" title="缩小输入区"/>
                        <img src="images/help.gif"/>
                    </div>
                    <div id="font">
                        <strong onclick="font(10)">10px</strong>
                        <strong onclick="font(12)">12px</strong>
                        <strong onclick="font(14)">14px</strong>
                        <strong onclick="font(16)">16px</strong>
                        <strong onclick="font(18)">18px</strong>
                        <strong onclick="font(20)">20px</strong>
                        <strong onclick="font(22)">22px</strong>
                        <strong onclick="font(24)">24px</strong>
                    </div>
                    <div id="color">
                        <strong title="黑色" style="background:#000" onclick="showcolor('#000')"></strong>
                        <strong title="褐色" style="background:#930" onclick="showcolor('#930')"></strong>
                        <strong title="橄榄树" style="background:#330" onclick="showcolor('#330')"></strong>
                        <strong title="深绿" style="background:#030" onclick="showcolor('#030')"></strong>
                        <strong title="深青" style="background:#036" onclick="showcolor('#036')"></strong>
                        <strong title="深蓝" style="background:#000080" onclick="showcolor('#000080')"></strong>
                        <strong title="靓蓝" style="background:#339" onclick="showcolor('#339')"></strong>
                        <strong title="灰色-80%" style="background:#333" onclick="showcolor('#333')"></strong>
                        <strong title="深红" style="background:#800000" onclick="showcolor('#800000')"></strong>
                        <strong title="橙红" style="background:#f60" onclick="showcolor('#f60')"></strong>
                        <strong title="深黄" style="background:#808000" onclick="showcolor('#000')"></strong>
                        <strong title="深绿" style="background:#008000" onclick="showcolor('#808000')"></strong>
                        <strong title="绿色" style="background:#008080" onclick="showcolor('#008080')"></strong>
                        <strong title="蓝色" style="background:#00f" onclick="showcolor('#00f')"></strong>
                        <strong title="蓝灰" style="background:#669" onclick="showcolor('#669')"></strong>
                        <strong title="灰色-50%" style="background:#808080" onclick="showcolor('#808080')"></strong>
                        <strong title="红色" style="background:#f00" onclick="showcolor('#f00')"></strong>
                        <strong title="浅橙" style="background:#f90" onclick="showcolor('#f90')"></strong>
                        <strong title="酸橙" style="background:#9c0" onclick="showcolor('#9c0')"></strong>
                        <strong title="海绿" style="background:#396" onclick="showcolor('#396')"></strong>
                        <strong title="水绿色" style="background:#3cc" onclick="showcolor('#3cc')"></strong>
                        <strong title="浅蓝" style="background:#36f" onclick="showcolor('#36f')"></strong>
                        <strong title="紫罗兰" style="background:#800080" onclick="showcolor('#800080')"></strong>
                        <strong title="灰色-40%" style="background:#999" onclick="showcolor('#999')"></strong>
                        <strong title="粉红" style="background:#f0f" onclick="showcolor('#f0f')"></strong>
                        <strong title="金色" style="background:#fc0" onclick="showcolor('#fc0')"></strong>
                        <strong title="黄色" style="background:#ff0" onclick="showcolor('#ff0')"></strong>
                        <strong title="鲜绿" style="background:#0f0" onclick="showcolor('#0f0')"></strong>
                        <strong title="青绿" style="background:#0ff" onclick="showcolor('#0ff')"></strong>
                        <strong title="天蓝" style="background:#0cf" onclick="showcolor('#0cf')"></strong>
                        <strong title="梅红" style="background:#936" onclick="showcolor('#936')"></strong>
                        <strong title="灰度-20%" style="background:#c0c0c0" onclick="showcolor('#c0c0c0')"></strong>
                        <strong title="玫瑰红" style="background:#f90" onclick="showcolor('#f90')"></strong>
                        <strong title="茶色" style="background:#fc9" onclick="showcolor('#fc9')"></strong>
                        <strong title="浅黄" style="background:#ff9" onclick="showcolor('#ff9')"></strong>
                        <strong title="浅绿" style="background:#cfc" onclick="showcolor('#cfc')"></strong>
                        <strong title="浅青绿" style="background:#cff" onclick="showcolor('#cff')"></strong>
                        <strong title="浅蓝" style="background:#9cf" onclick="showcolor('#9cf')"></strong>
                        <strong title="淡紫" style="background:#c9f" onclick="showcolor('#c9f')"></strong>
                        <strong title="白色" style="background:#fff"></strong>
                        <em><input type="text" name="t" value="#"/></em>
                    </div>
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