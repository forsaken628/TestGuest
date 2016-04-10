<?php
define('IN_TG', 'face');
define('IN_JS', 'opener');
include_once 'includes/common.inc.php';
require_once 'title.php';
?>
<body>
<div id="face">
    <h3>选择头像</h3>
    <dl>
        <?php
        for ($i = 1; $i <= 64; $i++) {
            $j = '';
            $j = str_pad($i, 2, '0', STR_PAD_LEFT);
            echo "<dd><img src=\"face/m{$j}.gif\" alt=\"face/m{$j}.gif\" title=\"头像{$i}\"/></dd>";
        }
        ?>
    </dl>
</div>
</body>
</html>
