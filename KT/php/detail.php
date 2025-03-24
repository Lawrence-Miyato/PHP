<?php
include 'connect.php';  // Kết nối tới database

// Kiểm tra nếu MaSV được truyền qua URL
if (isset($_GET['MaSV'])) {
    $maSV = $_GET['MaSV'];

    // Truy vấn dữ liệu sinh viên dựa trên MaSV
    $sql = "SELECT * FROM sinhvien WHERE MaSV = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $maSV);
    $stmt->execute();
    $result = $stmt->get_result();

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
        echo "Không tìm thấy sinh viên với MaSV: $maSV";
        exit();
    }
    $stmt->close();
} else {
    echo "Không có MaSV được cung cấp.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin</title>
    <style>
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
            font-size: 24px;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 5px 0;
            font-size: 16px;
        }

        .info img {
            display: block;
            margin: 10px 0;
            width: 150px;
            height: auto;
            border-radius: 4px;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn-delete {
            padding: 10px 20px;
            background-color: #fff;
            color: #333;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }

        .btn-delete:hover {
            background-color: #f0f0f0;
        }

        .btn-back {
            padding: 10px 20px;
            background-color: #fff;
            color: #0275d8;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }

        .btn-back:hover {
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
            <a href="#">Đăng Kí [0]</a>
            <a href="#">Đăng Nhập</a>
        </nav>
    </div>

    <div class="container">
        <h1>THÔNG TIN</h1>

        <div class="info">
            <p><strong>HoTen</strong> <?php echo htmlspecialchars($hoTen); ?></p>
            <p><strong>GioiTinh</strong> <?php echo htmlspecialchars($gioiTinh); ?></p>
            <p><strong>NgaySinh</strong> <?php echo htmlspecialchars($ngaySinh); ?></p>
            <p><strong>Hinh</strong></p>
            <img src="/uploads/<?php echo htmlspecialchars($hinh); ?>" alt="Ảnh Sinh Viên">
            <p><strong>MaNganh</strong> <?php echo htmlspecialchars($maNganh); ?></p>
        </div>

        <div class="buttons">
            <a href="index.php" class="btn-back">Back to List</a>
        </div>
    </div>
</body>

</html>

<?php
// Đóng kết nối sau khi sử dụng xong
$conn->close();
?>