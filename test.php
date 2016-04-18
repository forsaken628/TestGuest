<?php
function _thumb($_filename, $_new_wid = 70, $_new_filename = null)
{
    //生成png标头文件
//    if (is_null($_new_filename)) {
//        header('Content-type: image/png');
//    }
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
    var_dump($_n[1]);
    switch ($_n[1]) {

        case 'jpg' :
            $_image = imagecreatefromjpeg($_filename);
            break;
        case 'png' :
            $_image = imagecreatefrompng($_filename);
            break;
        case 'gif' :
            $_image = imagecreatefromgif($_filename);
            break;
    }
    //将原图采集后重新复制到新图上，就缩略了
    imagecopyresampled($_new_image, $_image, 0, 0, 0, 0, $_new_width, $_new_height, $_width, $_height);
//    $_new_filename = fopen($_new_filename, 'w');
//    imagepng($_new_image);
    imagedestroy($_new_image);
    imagedestroy($_image);
}

//header('Content-type: image/png');
_thumb($_GET['filename'], $_GET['wid']);
