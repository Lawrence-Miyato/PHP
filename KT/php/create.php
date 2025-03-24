<?php
include 'connect.php';  // Kết nối tới database

// Truy vấn dữ liệu sinh viên từ bảng
$sql = "SELECT * FROM sinhvien";  // 'sinhvien' là tên bảng chứa danh sách sinh viên
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>
    <link rel="stylesheet" href="../css/create.css">
</head>
<style>
    /* Style cho trang */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .header {
        background-color: #333;
        padding: 10px;
        text-align: left;
    }

    .header nav a {
        color: #fff;
        margin: 0 10px;
        text-decoration: none;
        font-weight: bold;
    }

    .header nav a:hover {
        text-decoration: underline;
    }

    .container {
        margin: 50px auto;
        padding: 20px;
        max-width: 600px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    .btn-choose {
        margin-top: 10px;
        padding: 5px 10px;
        background-color: #5cb85c;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-choose:hover {
        background-color: #4cae4c;
    }

    .btn-create {
        width: 100%;
        padding: 10px;
        background-color: #0275d8;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 20px;
    }

    .btn-create:hover {
        background-color: #025aa5;
    }

    .back-to-list {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #0275d8;
        text-decoration: none;
    }

    .back-to-list:hover {
        text-decoration: underline;
    }
</style>

<body>

    <div class="header">
        <nav>
            <a href="#">Test1</a>
            <a href="#">Sinh Viên</a>
            <a href="#">Học Phần</a>
            <a href="#">Đăng Kí</a>
            <a href="#">Đăng Nhập</a>
        </nav>
    </div>

    <div class="container">
        <h1>THÊM SINH VIÊN</h1>
        <form action="connect.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="MaSV">MaSV</label>
                <input type="text" id="MaSV" name="MaSV" required>
            </div>

            <div class="form-group">
                <label for="HoTen">HoTen</label>
                <input type="text" id="HoTen" name="HoTen" required>
            </div>

            <div class="form-group">
                <label for="GioiTinh">GioiTinh</label>
                <input type="text" id="GioiTinh" name="GioiTinh" required>
            </div>

            <div class="form-group">
                <label for="NgaySinh">NgaySinh</label>
                <input type="date" id="NgaySinh" name="NgaySinh" required>
            </div>

            <div class="form-group">
                <label for="Hinh">Hinh</label>
                <input type="file" id="Hinh" name="Hinh">
            </div>

            <div class="form-group">
                <label for="MaNganh">MaNganh</label>
                <input type="text" id="MaNganh" name="MaNganh" required>
            </div>

            <button type="submit" class="btn-create">Create</button>
        </form>

        <a href="#" class="back-to-list">Back to List</a>
    </div>

</body>

</html>
<?php
// Đóng kết nối database
$conn->close();
