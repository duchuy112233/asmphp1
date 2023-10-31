<?php
require_once 'sql/connect/cn-db-sqli.php';
require_once 'check.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.4.0.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASM</title>
    <style>
        .colo {
            color: red;
        }
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>

    <h1>Quản lý sản phẩm</h1>
    <h3>THÊM/SỬA SẢN PHẨM</h3>

    <form action="index.php" method="POST" enctype="multipart/form-data">
        <section>
            <!-- Tên -->
            <b>Tên</b> <br>
            <input type="text" name="name" placeholder="Nhập tên" value="<?= $name ?? '' ?>"> <br>
            <span class="colo"><?= $nameErr ?? '' ?></span>
            <br>
            <!-- Hãng sản xuất -->
            <b>Hãng sản xuất</b> <br>
            <input type="text" name="hang" placeholder="Nhập hãng sản xuất" value="<?= $hang ?? '' ?>"> <br>
            <span class="colo"><?= $hangErr ?? '' ?></span>
            <br>
            <!-- Giá -->
            <b>Giá</b> <br>
            <input type="text" name="gia" placeholder="Nhập giá" value="<?= $gia ?? '' ?>"> <br>
            <span class="colo"><?= $giaErr ?? '' ?></span>
            <br>
            <!-- Ảnh -->
            <b>Ảnh</b> <br>
            <input type="file" name="img">
            <span class="colo"><?= $imgErr ?? '' ?></span>
            <br>
        </section>

        <section>
            <!-- Thể loại -->
            <b>Thể loại</b> <br>
            <select name="theloai">
                <option value="">Thể loại</option>
                <option value="Thời sự">Thời sự</option>
                <option value="SmartTV">SmartTV</option>
                <option value="Bản tin">Bản tin</option>
                <option value="Truyền hình">Truyền hình</option>


            </select> <br><span class="colo"><?= $theloaiErr ?? '' ?></span> <br>
            <!-- Tính năng -->
            <b>Tính năng</b> <br>
            <select name="tinhnang" style="width: 450px;" id="mul" multiple="">
                <option value="Chống loá">Chống loá</option>
                <option value="4K">4K</option>
                <option value="Wireless">Wireless</option>
            </select> <br>
            <span class="colo"><?= $tinhnangErr ?? '' ?></span>
            <br>
            <!-- Mô tả -->
            <b>Mô tả</b> <br>
            <textarea name="mota" id="" cols="30" rows="5" value="<?= $mota ?? '' ?>"></textarea> <br>
            <span class="colo"><?= $motaErr ?? '' ?></span>
            <br> <br>
            <!-- submit, reset -->
            <input id="submit" type="submit" name="submit" value="Lưu">
            <button id="reset"><a href="index.php">Reset</a></button>
        </section>

    </form>

    <script>
        // js tính năng Multi-select boxes (pillbox)
        $(document).ready(
            function() {
                $('#mul').select2();
            }
        );
    </script>

    <section>
        <!-- <h1> INSERT </h1> -->
        <?php

        

        if (isset($_POST['submit'])) {
            $name =  $_POST['name'];
            $hang =  $_POST['hang'];
            $gia =  $_POST['gia'];

            $img = $_FILES['img']['name'];
            $img_tmp = $_FILES['img']['tmp_name'];

            move_uploaded_file($img_tmp, 'uploads/' . $img);


            $theloai =  $_POST['theloai'];
            $tinhnang =  $_POST['tinhnang'] ?? '';
            $mota =  $_POST['mota']; //check tồn tại

            if (!empty($name) && !empty($hang) && !empty($gia) && !empty($img) && !empty($theloai) && !empty($tinhnang) && !empty($mota)) {
                $sql = " INSERT INTO `myasmphp`(`name`,`hang`,`gia`,`img`,`theloai`,`tinhnang`,`mota`)
        VALUES('$name' ,'$hang','$gia','$img','$theloai','$tinhnang','$mota')";

                if ($conn->query($sql) === true) {
                    echo "Thêm thành công";
                }
            } else {
                echo "Bạn cần nhập đủ thông tin";
            }
        }
        ?>

    </section>

    <!-- Truy vấn bảng -->

    <section>
        <h1>Danh sách sản phẩm</h1>
        <!-- form search -->

        <form id="search" action="">
            <input type="search" placeholder="Search" >
        </form>

        <?php
        // kết nối vào database
        $link = mysqli_connect('localhost', 'root', '', 'asmphp');
        if (!$link) {
            die('Lỗi kết nối db');
        }
        //delete
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Thực hiện truy vấn DELETE để xóa bản ghi dựa vào giá trị uid
            $delete = mysqli_query($link, "DELETE FROM `myasmphp` WHERE `id`='$id'");
        }
        $sql = "SELECT * FROM myasmphp";
        $result = $conn->query($sql);
        echo "<table>
        <tr>
           <th style='background-color: aquamarine;'>ID</th>
           <th style='background-color: aquamarine;'>Ảnh</th>
           <th style='background-color: aquamarine;'>Tên</th>
           <th style='background-color: aquamarine;'>Hãng sản xuất</th>
           <th style='background-color: aquamarine;'>Giá</th>
           <th style='background-color: aquamarine;'>Thể loại</th>
           <th style='background-color: aquamarine;'>Tính năng</th>
           <th style='background-color: aquamarine;'>Mô ta</th>
           <th style='background-color: aquamarine;'>Hành<br>
           động</th>
        </tr>";

        $i = 1;
        foreach ($result->fetch_all(MYSQLI_ASSOC) as $item) {
            echo "
        <tr>
   
        <td style='text-align: center;  width: 40px;'>{$i}</td>
           <td style='text-align: center; padding: 6px 6px; '>
            <img src='uploads/{$item['img']}' alt='img' style='width: 100px;'>
        </td>
           <td style='padding: 0px 7px;'>{$item['name']}</td>
           <td style='padding: 0px 7px;'>{$item['hang']}</td>
           <td style='padding: 0px 7px;'>{$item['gia']}</td>
           <td style='padding: 0px 7px;'>{$item['theloai']}</td>
           <td style='padding: 0px 7px;'>{$item['tinhnang']}</td>
           <td style='padding: 0px 5px;'>{$item['mota']}</td>
           <td style='text-align: center;'>
           <button style=' background-color: blue;  margin-bottom: 7px;'><a href='update.php?id={$item['id']}' style='color: #fff;' >Edit</a> <br></button>
           <button style=' background-color: red;'><a href='javascript:;' onclick='del({$item['id']})' style='color: #fff;'>Xóa</a></button>
           </td>    
        </tr>";
        $i++;
        }
        echo "</table>";
        require_once 'sql/connect/close-sqli.php';
        ?>
    </section>
    <br>
    <script>
        function del(id) {
            if (confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?')) {
                window.location.href = 'index.php?id=' + id;
            }
        }
    </script>
    
</body>

</html>