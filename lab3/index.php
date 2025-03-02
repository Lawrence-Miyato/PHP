<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính tổng điểm và xếp hạng</title>
</head>

<body>
    <!-- Form gửi dữ liệu tới chính trang này qua phương thức POST -->
    <div class="contain">
        <div>
            <span>Xếp hạng điểm sinh viên </span>
        </div>
        <br>
        <form action="" method="post">
            <label for="math">Điểm môn Toán:</label>
            <input type="number" id="math" name="math" required><br><br>

            <label for="physics">Điểm môn Lý:</label>
            <input type="number" id="physics" name="physics" required><br><br>

            <label for="chemistry">Điểm môn Hóa:</label>
            <input type="number" id="chemistry" name="chemistry" required><br><br>

            <label for="location">Chọn khu vực:</label>
            <select id="location" name="location" required>
                <option value="">--Chọn khu vực--</option>
                <option value="KV1">Khu vực 1</option>
                <option value="KV2">Khu vực 2</option>
                <option value="KV3">Khu vực 3</option>
                <option value="none">Khu vực khác</option>
            </select><br><br>

            <input class="button" type="submit" value="Xếp loại">
        </form>
    </div>

    <div class="contain">
        <?php
        // Kiểm tra nếu form đã được gửi và có đủ giá trị
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['math'], $_POST['physics'], $_POST['chemistry'], $_POST['location'])) {
            // Lấy giá trị từ form
            $math = floatval($_POST['math']);
            $physics = floatval($_POST['physics']);
            $chemistry = floatval($_POST['chemistry']);
            $location = $_POST['location'];

            // Tính tổng điểm
            $total = $math + $physics + $chemistry;

            // Xếp hạng dựa trên tổng điểm
            if ($total >= 27) {
                $rank = "Xuất sắc";
            } elseif ($total >= 24) {
                $rank = "Giỏi";
            } elseif ($total >= 18) {
                $rank = "Khá";
            } elseif ($total >= 15) {
                $rank = "Trung bình";
            } else {
                $rank = "Yếu";
            }

            // Tính điểm ưu tiên dựa trên khu vực
            $priorityPoints = 0;
            if ($location == "KV1" || $location == "KV2") {
                $priorityPoints = 5;
            } elseif ($location == "KV3") {
                $priorityPoints = 3;
            }

            echo "<h2>Xếp Hạng</h2> ";
            // Hiển thị kết quả tổng điểm, xếp hạng và điểm ưu tiên
            echo "Tổng điểm: $total <br><br>";
            echo "Xếp hạng: $rank <br><br>";
            echo "Điểm ưu tiên: $priorityPoints <br><br>";
        }
        ?>
    </div>
</body>

<style>
    html,
    body {
        height: 100%;
        width: 100%;
        max-width: 100vw;
        max-height: 100vh;
    }

    .button {
        background-color: CornflowerBlue;
        color: white;
        width: 90px;
        height: 50px;
        border-radius: 2rem;
    }

    .contain {
        display: flex;
        flex-direction: column;
        align-content: center;
        align-items: center;
    }

    .tittle {
        bottom: 20px;
    }
</style>

</html>