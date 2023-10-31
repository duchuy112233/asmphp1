<?php
require_once 'sql/connect/cn-db-sqli.php';



if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $img_tmp = $_FILES['img']['tmp_name'];

    if ($_FILES['img']['name']) {
        # code...
    }else {
       $img = $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name'];

    move_uploaded_file($img_tmp, '../uploads/' . $img);
    }
   


    $name = $_POST['name'];
    $hang = $_POST['hang'];
    $gia = $_POST['gia'];
    $theloai = $_POST['theloai'];
    $tinhnang = $_POST['tinhnang'] ?? '';
    $mota = $_POST['mota'];

    if (!empty($name) && !empty($hang) && !empty($gia) && !empty($img) && !empty($theloai) && !empty($tinhnang) && !empty($mota)) {

        $sql_update = "UPDATE myasmphp 
                   SET name = '$name', hang = '$hang', gia = '$gia', img = '$img', theloai = '$theloai', tinhnang = '$tinhnang', mota = '$mota' 
                   WHERE id = $id";

        if ($conn->query($sql_update) === TRUE) {
            echo " / Cập nhật thông tin sản phẩm thành công!";
            header("location: index.php");
        }
    } else {
        echo " Bạn cần nhập đủ thông tin";
    }

    // Cập nhật thông tin sản phẩm vào cơ sở dữ liệu


}
// Lấy thông tin sản phẩm từ cơ sở dữ liệu
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_select = "SELECT * FROM myasmphp WHERE id = $id";
    $result = $conn->query($sql_select);
    $product = $result->fetch_assoc();
}

require_once 'sql/connect/close-sqli.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.4.0.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật sản phẩm</title>
    <style>
        body{
            width: 980px;
            margin: 0 auto;
            
        }
        input{
            width: 600px;
            height: 30px;
        }
        select{
            width: 450px;
            height: 30px;
        }
        textarea{
            width: 600px;
        }
        .butt{
            background-color: blue;
            color: white;
            font-weight: bold;
        }
        .butt2{
            background-color: red;
            
        }
        .butt2 a{
            color: white;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <h1>Cập nhật sản phẩm</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <section>
            Tên <br>
            <input type="text" name="name" value="<?= $product['name'] ?>"> <br>
            
            Hãng sản xuất <br>
            <input type="text" name="hang" value="<?= $product['hang'] ?>"> <br>

            Giá <br>
            <input type="text" name="gia" value="<?= $product['gia'] ?>"> <br>

            Ảnh<br>

            <input type="file" name="img" value="<?= $product['img'] ?>"> <br>

        </section>

        <section>

            Thể loại <br>
            <select name="theloai">
                <option value="">Thể loại</option>
                <option value="Electronic">Electronic</option>
                <option value="SmartTV">SmartTV</option>
                <option value="Option3">Option 3</option>
                <option value="Option4">Option 4</option>
            </select> <br>

            Tính năng <br>
            <select name="tinhnang" style="width: 450px;" id="mul" multiple="">
                <option value="Chống loá">Chống loá</option>
                <option value="4K">4K</option>
                <option value="Wireless">Wireless</option>
            </select> <br>
            Mô tả <br>
            <textarea name="mota" id="" cols="30" rows="10"><?= $product['mota'] ?></textarea> <br> <br>

            <button class="butt" type="submit" name="submit">Cập nhật</button>
            <button class="butt2"><a href="index.php">Huỷ</a></button>
            
        </section>

    </form>
    <script>
        $(document).ready(
            function() {
                $('#mul').select2();
            }
        );
    </script>
</body>

</html>