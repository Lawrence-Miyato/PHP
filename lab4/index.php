<?php
$uploadedImages = []; // Mảng lưu địa chỉ hình ảnh đã upload

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kiểm tra xem có tệp nào được upload hay không
    if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
        $uploadDirectory = 'C:/laragon/www/PHP/lab4/uploads/'; // Đường dẫn tuyệt đối tới thư mục uploads

        // Tạo thư mục nếu chưa tồn tại
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        // Lặp qua từng tệp và upload
        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            $fileName = basename($_FILES['images']['name'][$key]);
            $uploadPath = $uploadDirectory . $fileName;

            // Kiểm tra nếu tệp là hình ảnh
            if (getimagesize($tmpName)) {
                // Di chuyển tệp đã upload đến thư mục đích
                if (move_uploaded_file($tmpName, $uploadPath)) {
                    $uploadedImages[] = $uploadPath; // Lưu đường dẫn vào mảng
                } else {
                    echo "Có lỗi khi upload file " . $fileName . ".<br>";
                }
            } else {
                echo $fileName . " không phải là hình ảnh hợp lệ.<br>";
            }
        }
    } else {
        echo "Bạn chưa chọn file nào để upload.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Images</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="container">

        <div id="imagePreview">
            <?php
            // Hiển thị hình ảnh đã upload
            if (!empty($uploadedImages)) {
                foreach ($uploadedImages as $image) {
                    // Chuyển đường dẫn thành URL tương đối
                    $relativePath = str_replace('C:/laragon/www/PHP/lab4/', '', $image);
                    echo '<img src="' . $relativePath . '" style="max-width: 400px; margin: 5px;" />';
                }
            }
            ?>
        </div>
    </div>
</body>

</html>