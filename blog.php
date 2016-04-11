<?php
define('IN_TG', 'blog');
define('IN_JS', 'blog');
define('SCRIPT', 'blog');
include_once 'includes/common.inc.php';
require_once 'title.php';
require_once 'header.php';

_page("SELECT count(tg_id) FROM tg_user", 15);//_page已优化
$sql = "SELECT * FROM tg_user ORDER BY tg_reg_time DESC LIMIT {$_pagenum},15";
$result = _query($sql);
?>
<div id="blog">
    <h2>博友列表</h2>
    <?php
    while ($row = _fetch_array_list($result)) {
        echo <<<a
        <dl>
        <dd class="user">{$row['tg_username']}({$row['tg_sex']})</dd>
        <dt><img src="{$row['tg_face']}" alt="{$row['tg_username']}" /></dt>
        <dd class="message"><a href="javascript:;" name="message" title="{$row['tg_id']}">发消息</a></dd>
        <dd class="friend"><a href="javascript:;" name="friend" title="{$row['tg_id']}">加为好友</a></dd>
        <dd class="guest">写留言</dd>
        <dd class="flower"><a href="javascript:;" name="flower" title="{$row['tg_id']}">给他送花</a></dd>
    </dl>
a;
    }
    ?>

    <?php _paging(1) ?>

</div>
