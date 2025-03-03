<?php
// Khởi tạo biến $success rỗng
$success = "";

// Kiểm tra xem người dùng có gửi dữ liệu từ form hay không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy giá trị từ form đăng nhập
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Thông tin đăng nhập cố định
    $correctUsername = 'HuynhNgocBao';
    $correctPassword = '123';

    // Kiểm tra thông tin đăng nhập
    if ($username === $correctUsername && $password === $correctPassword) {
        // Đăng nhập thành công, chuyển hướng đến trang khác
        header("Location: success.php");
        exit(); // Dừng kịch bản sau khi chuyển hướng
    } else {
        $success = "Sai tài khoản hoặc mật khẩu!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
</head>

<body>
    <div class="container">
        <h1>Đăng Nhập</h1>
        <form action="login.php" method="POST">
            <div>
                <span>Tài khoản: </span>
                <input type="text" name="username">
            </div>
            <br>
            <div>
                <span>Mật Khẩu: </span>
                <input type="password" name="password">
            </div>
            <br>
            <button type="submit">Đăng Nhập</button>
        </form>

        <!-- Chỉ hiển thị thông báo nếu form đã được gửi -->
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
            <p><?php echo $success; ?></p>
        <?php endif; ?>
    </div>
</body>

</html>