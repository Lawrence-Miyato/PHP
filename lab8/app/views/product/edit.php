<?php include '../shares/header.php'; ?>

<h1>Chỉnh sửa sản phẩm</h1>

<?php
// Lấy ID của sản phẩm từ query string (ví dụ: /edit.php?id=1)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Kết nối cơ sở dữ liệu
    $pdo = new PDO('mysql:host=localhost;dbname=your_database_name', 'username', 'password');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Truy vấn sản phẩm từ cơ sở dữ liệu
    $statement = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $statement->bindValue(':id', $id);
    $statement->execute();
    $product = $statement->fetch(PDO::FETCH_ASSOC);

    // Kiểm tra nếu sản phẩm không tồn tại
    if (!$product) {
        echo "Sản phẩm không tồn tại!";
        exit;
    }
} else {
    echo "ID sản phẩm không hợp lệ!";
    exit;
}
?>


<!-- Form chỉnh sửa sản phẩm -->
<form method="POST" action="/webbanhang/Product/update">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">

    <div class="form-group">
        <label for="name">Tên sản phẩm:</label>
        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
    </div>

    <div class="form-group">
        <label for="description">Mô tả:</label>
        <textarea id="description" name="description" class="form-control" required><?php echo htmlspecialchars($product['description']); ?></textarea>
    </div>

    <div class="form-group">
        <label for="price">Giá:</label>
        <input type="number" id="price" name="price" class="form-control" value="<?php echo htmlspecialchars($product['price']); ?>" step="0.01" required>
    </div>

    <div class="form-group">
        <label for="category_id">Danh mục:</label>
        <select id="category_id" name="category_id" class="form-control" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category->id; ?>" <?php if ($category->id == $product['category_id']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($category->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
</form>


<a href="/webbanhang/Product/list" class="btn btn-secondary mt-2">Quay lại danh sách sản phẩm</a>

<?php include '../shares/footer.php'; ?>