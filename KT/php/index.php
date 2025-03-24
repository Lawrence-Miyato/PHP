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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRANG SINH VIÊN</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<style>
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        background-color: #333;
        color: white;
    }

    .header a {
        color: white;
        text-decoration: none;
        margin: 0 10px;
    }

    .header h1 {
        flex-grow: 1;
        text-align: center;
    }

    .add-student {
        background-color: #4CAF50;
        padding: 10px 20px;
        border-radius: 5px;
        color: white;
        text-decoration: none;
    }

    .table-container {
        width: 100%;
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    img {
        width: 100px;
        height: auto;
    }

    td a {
        color: #4CAF50;
        text-decoration: none;
        margin-right: 10px;
    }

    td a:hover {
        text-decoration: underline;
    }
</style>

<body>
    <div class="header">
        <a href="#">Test 1</a>
        <a href="#">Sinh Viên</a>
        <a href="#">Học Phần</a>
        <a href="#">Đăng Ký</a>
        <a href="#">Đăng Nhập</a>
        <h1>TRANG SINH VIÊN</h1>
        <a href="create.php" class="add-student">Add Student</a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>MaSV</th>
                    <th>HoTen</th>
                    <th>GioiTinh</th>
                    <th>NgaySinh</th>
                    <th>Hinh</th>
                    <th>MaNganh</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Lặp qua từng dòng kết quả và hiển thị lên bảng
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["MaSV"] . "</td>";
                        echo "<td>" . $row["HoTen"] . "</td>";
                        echo "<td>" . $row["GioiTinh"] . "</td>";
                        echo "<td>" . $row["NgaySinh"] . "</td>";
                        echo "<td><img src='../KT/php/uploads" . htmlspecialchars($row["Hinh"]) . "' alt='" . htmlspecialchars($row["HoTen"]) . "' width='100' height='auto'></td>";
                        echo "<td>" . $row["MaNganh"]  . "</td>";
                        echo "<td><a href='edit.php?MaSV=" . $row["MaSV"] . "'>Edit</a>|";
                        echo "<a href='detail.php?MaSV=" . $row["MaSV"] . "'> Detail</a>|";
                        echo "<a href='delete.php?MaSV=" . $row["MaSV"] . "' class='delete-btn'> Delete</a>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Không có sinh viên nào</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
// Đóng kết nối database
$conn->close();
?>