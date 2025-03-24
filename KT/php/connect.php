<?php
// Bật hiển thị lỗi để debug (chỉ dùng trong môi trường phát triển)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";  // Địa chỉ server (thường là localhost)
$username = "root";  // Tên người dùng MySQL mặc định là root
$password = "";  // Mật khẩu của MySQL (thường để trống)
$dbname = "test1";  // Tên database

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Chỉ xử lý POST và DELETE nếu file được truy cập trực tiếp
if (basename($_SERVER['PHP_SELF']) === 'connect.php') {
    // Thiết lập header để trả về JSON
    header('Content-Type: application/json');

    // Kiểm tra nếu dữ liệu được gửi qua form POST (INSERT hoặc UPDATE)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lấy dữ liệu từ form
        $action = $_POST['action'] ?? 'create'; // Mặc định là create nếu không có action
        $maSV = $_POST['MaSV'];
        $hoTen = $_POST['HoTen'];
        $gioiTinh = $_POST['GioiTinh'];
        $ngaySinh = $_POST['NgaySinh'];
        $hinhCu = isset($_POST['HinhCu']) ? $_POST['HinhCu'] : ''; // Hình cũ (nếu có)
        $hinhMoi = $_FILES['Hinh']['name'] ?? '';  // Lấy tên file ảnh mới (nếu có)
        $maNganh = $_POST['MaNganh'];

        // Xử lý file ảnh
        $hinh = $hinhCu; // Mặc định dùng ảnh cũ
        if (!empty($hinhMoi)) {
            $target_dir = "uploads/";  // Đường dẫn thư mục lưu trữ file ảnh
            $target_file = $target_dir . basename($hinhMoi);
            if (move_uploaded_file($_FILES['Hinh']['tmp_name'], $target_file)) {
                $hinh = $hinhMoi; // Nếu upload thành công, cập nhật đường dẫn ảnh mới
            } else {
                echo json_encode(["status" => "error", "message" => "Lỗi khi upload ảnh."]);
                exit();
            }
        } else {
            // Nếu không có ảnh mới, kiểm tra xem $hinhCu có phải là tên file hợp lệ không
            if (!empty($hinhCu) && file_exists("uploads/" . $hinhCu)) {
                $hinh = $hinhCu; // Chỉ sử dụng $hinhCu nếu nó là tên file hợp lệ
            } else {
                $hinh = ''; // Nếu không có ảnh mới và $hinhCu không hợp lệ, để trống
            }
        }

        // Kiểm tra xem MaSV đã tồn tại trong bảng chưa
        $checkSql = "SELECT * FROM sinhvien WHERE MaSV = ?";
        $stmt = $conn->prepare($checkSql);
        $stmt->bind_param("s", $maSV);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($action === 'update') {
            // Hành động cập nhật (update)
            if ($result->num_rows > 0) {
                // MaSV tồn tại, thực hiện UPDATE
                $sql = "UPDATE sinhvien SET HoTen = ?, GioiTinh = ?, NgaySinh = ?, Hinh = ?, MaNganh = ? WHERE MaSV = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh, $maSV);

                if ($stmt->execute()) {
                    echo json_encode(["status" => "success", "message" => "Cập nhật sinh viên thành công!"]);
                    header("Location: index.php");
                    exit();
                } else {
                    echo json_encode(["status" => "error", "message" => "Lỗi khi cập nhật: " . $conn->error]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "Không tìm thấy sinh viên với MaSV: $maSV"]);
                exit();
            }
        } else {
            // Hành động thêm mới (create)
            if ($result->num_rows > 0) {
                // MaSV đã tồn tại, báo lỗi
                echo json_encode(["status" => "error", "message" => "Mã sinh viên '$maSV' đã tồn tại. Vui lòng chọn mã khác."]);
                exit();
            } else {
                // MaSV chưa tồn tại, thực hiện INSERT
                $sql = "INSERT INTO sinhvien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh);

                if ($stmt->execute()) {
                    echo json_encode(["status" => "success", "message" => "Thêm sinh viên thành công!"]);
                    header("Location: index.php");
                    exit();
                } else {
                    echo json_encode(["status" => "error", "message" => "Lỗi khi thêm mới: " . $conn->error]);
                }
            }
        }

        $stmt->close();
        exit();
    }

    // API DELETE: Xóa sinh viên
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        // Lấy dữ liệu từ query string hoặc body
        parse_str(file_get_contents("php://input"), $deleteData);
        $maSV = $deleteData['MaSV'] ?? $_GET['MaSV'] ?? '';

        if (empty($maSV)) {
            echo json_encode(["status" => "error", "message" => "MaSV không được để trống."]);
            exit();
        }

        // Kiểm tra xem MaSV có tồn tại không
        $checkSql = "SELECT * FROM sinhvien WHERE MaSV = ?";
        $stmt = $conn->prepare($checkSql);
        $stmt->bind_param("s", $maSV);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // MaSV tồn tại, thực hiện DELETE
            $sql = "DELETE FROM sinhvien WHERE MaSV = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $maSV);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Xóa sinh viên thành công!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Lỗi khi xóa: " . $conn->error]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Không tìm thấy sinh viên với MaSV: $maSV"]);
        }

        $stmt->close();
        exit();
    }

    // Nếu không có hành động nào khớp, trả về lỗi
    echo json_encode(["status" => "error", "message" => "Phương thức không được hỗ trợ."]);
    exit();
}
