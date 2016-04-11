<?php
define('IN_TG', 'q');
define('IN_JS', 'qopener');
define('SCRIPT', 'q');
include_once 'includes/common.inc.php';
require_once 'title.php';
?>
<body>
<div id="q">
    <h3>选择Q图</h3>
    <dl>
        <?php
        for ($i = 1; $i <= $_GET['num']; $i++) {
            ?>
            <dd><img src="<?=$_GET['path'].$i?>.gif" alt="qpic/1/<?=$i?>.gif" title="头像<?=$i?>"/></dd>
            <?php
        }
        ?>
    </dl>
</div>
</body>
</html>
