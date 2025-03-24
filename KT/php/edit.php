<?php
include 'connect.php';  // Kết nối tới database

// Kiểm tra nếu MaSV được truyền qua URL
if (isset($_GET['MaSV'])) {
    $maSV = $_GET['MaSV'];

    // Truy vấn dữ liệu sinh viên dựa trên MaSV
    $sql = "SELECT * FROM sinhvien WHERE MaSV = '$maSV'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Lấy dữ liệu sinh viên
        $row = $result->fetch_assoc();
        $maSV = $row['MaSV'];
        $hoTen = $row['HoTen'];
        $gioiTinh = $row['GioiTinh'];
        $ngaySinh = $row['NgaySinh'];
        $hinh = $row['Hinh'];
        $maNganh = $row['MaNganh'];
    } else {
        // Nếu không tìm thấy sinh viên, có thể chuyển hướng hoặc hiển thị thông báo
        echo "Không tìm thấy sinh viên với MaSV: $maSV";
        exit();
    }
} else {
    // Nếu không có MaSV trong URL, chuyển hướng hoặc hiển thị thông báo
    echo "Không có MaSV được cung cấp.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiệu chỉnh thông tin sinh viên</title>
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

        .form-group img {
            width: 100px;
            height: auto;
            margin-top: 10px;
            border-radius: 4px;
            display: block;
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

        .btn-save {
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

        .btn-save:hover {
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
</head>

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
        <h1>Hiệu chỉnh thông tin sinh viên</h1>

        <form action="connect.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="MaSV" value="<?php echo htmlspecialchars($maSV); ?>">

            <div class="form-group">
                <label for="hoten">Họ Tên</label>
                <input type="text" id="hoten" name="HoTen" value="<?php echo htmlspecialchars($hoTen); ?>">
            </div>

            <div class="form-group">
                <label for="gioitinh">Giới Tính</label>
                <input type="text" id="gioitinh" name="GioiTinh" value="<?php echo htmlspecialchars($gioiTinh); ?>">
            </div>

            <div class="form-group">
                <label for="ngaysinh">Ngày Sinh</label>
                <input type="text" id="ngaysinh" name="NgaySinh" value="<?php echo htmlspecialchars($ngaySinh); ?>">
            </div>

            <div class="form-group">
                <label for="hinh">Hình</label>
                <input type="text" id="hinh" name="HinhCu" value="<?php echo htmlspecialchars($hinh); ?>">
                <img src="/uploads/<?php echo htmlspecialchars($hinh); ?>" alt="Ảnh Sinh Viên">
                <input type="file" name="Hinh">
            </div>

            <div class="form-group">
                <label for="manganh">Mã Ngành</label>
                <input type="text" id="manganh" name="MaNganh" value="<?php echo htmlspecialchars($maNganh); ?>">
            </div>

            <button type="submit" class="btn-save">Save</button>
        </form>

        <a href="index.php" class="back-to-list">Back to List</a>
    </div>

</body>

</html>