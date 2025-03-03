<?php
session_start();

// Khởi tạo dữ liệu người dùng trong session nếu chưa có
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [
        ['id' => 1, 'fullname' => 'Nguyen van A', 'email' => 'tructhach@gmail.com'],
        ['id' => 2, 'fullname' => 'Nguyen van B', 'email' => 'tructhach@gmail.com'],
        ['id' => 3, 'fullname' => 'Nguyen van C', 'email' => 'tructhach@gmail.com'],
    ];
}

// Thêm người dùng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];

    // Lấy ID tiếp theo
    $nextId = count($_SESSION['users']) + 1;

    // Thêm người dùng mới vào session
    $_SESSION['users'][] = [
        'id' => $nextId,
        'fullname' => $fullname,
        'email' => $email,
    ];

    // Chuyển hướng lại để tránh form submit lại khi refresh trang
    header("Location: success.php");
    exit();
}

// Xóa người dùng
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Tìm kiếm và xóa người dùng khỏi session
    foreach ($_SESSION['users'] as $key => $user) {
        if ($user['id'] == $id) {
            unset($_SESSION['users'][$key]);
            $_SESSION['users'] = array_values($_SESSION['users']); // Reset lại mảng
            break;
        }
    }

    // Chuyển hướng lại sau khi xóa
    header("Location: success.php");
    exit();
}

// Sửa người dùng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];

    // Tìm kiếm và cập nhật thông tin người dùng
    foreach ($_SESSION['users'] as &$user) {
        if ($user['id'] == $id) {
            $user['fullname'] = $fullname;
            $user['email'] = $email;
            break;
        }
    }

    // Chuyển hướng lại để tránh form submit lại khi refresh trang
    header("Location: success.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <style>
        table {
            width: 60%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>Quản lý người dùng</h1>

    <!-- Form thêm người dùng -->
    <form action="success.php" method="POST">
        <input type="text" name="fullname" placeholder="Fullname" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit" name="add">Thêm</button>
    </form>

    <!-- Bảng hiển thị người dùng -->
    <table>
        <tr>
            <th>ID</th>
            <th>Fullname</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php foreach ($_SESSION['users'] as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['fullname']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td>
                    <a href="success.php?edit=<?php echo $user['id']; ?>">Edit</a>
                    <a href="success.php?delete=<?php echo $user['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Form sửa người dùng -->
    <?php if (isset($_GET['edit'])): ?>
        <?php
        $id = $_GET['edit'];
        $userToEdit = null;

        // Tìm kiếm người dùng cần sửa
        foreach ($_SESSION['users'] as $user) {
            if ($user['id'] == $id) {
                $userToEdit = $user;
                break;
            }
        }
        ?>
        <?php if ($userToEdit): ?>
            <h2>Sửa thông tin</h2>
            <form class="edit-form" action="success.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $userToEdit['id']; ?>">
                <input type="text" name="fullname" value="<?php echo $userToEdit['fullname']; ?>" required>
                <input type="email" name="email" value="<?php echo $userToEdit['email']; ?>" required>
                <button type="submit" name="edit">Lưu</button>
            </form>
        <?php endif; ?>
    <?php endif; ?>
</body>

</html>