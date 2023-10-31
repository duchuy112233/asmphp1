<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name =  $_POST['name'];
    $hang =  $_POST['hang'];
    $gia =  $_POST['gia'] ?? '';
    $img =  $_FILES['img'] ?? '';
  
   
   
    $theloai =  $_POST['theloai'];
    $tinhnang =  $_POST['tinhnang'] ?? '';
    $mota =  $_POST['mota']; //check tồn tại


    $nameErr = $hangErr = $giaErr = $imgErr = $theloaiErr = $tinhnangErr = $motaErr =  null;


    if (empty($name) || ctype_alpha(str_replace(' ', '', $name)) === false) {
        $nameErr = 'Vui lòng nhập tên hợp lệ';
    }

    if (empty($hang)) {
        $hangErr = 'Vui lòng chọn hãng';
    }
    if (empty($gia)) {
        $giaErr = 'Giá không được bỏ trống';
    } elseif (!is_numeric($gia)) {
        $giaErr = 'Giá phải là số';
    }
    if (empty($img)) {
        $imgErr = 'Vui lòng chọn ảnh';
    }
    if (empty($theloai)) {
        $theloaiErr = 'Vui lòng chọn thể loại';
    }
    if (empty($tinhnang)) {
        $tinhnangErr = 'Vui lòng chọn tính năng';
    }
    if (empty($mota) || strlen($hang) > 200) {
        $motaErr = 'mô tả không quá 200 kí tự';
    }
}
