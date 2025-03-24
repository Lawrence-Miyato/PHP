<?php include '../shares/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Thêm sản phẩm mới</h2>
    <form action="/path-to-save-product" method="POST">
        <div class="form-group mb-3">
            <label for="productName">Tên sản phẩm:</label>
            <input type="text" class="form-control" id="productName" name="productName" placeholder="Nhập tên sản phẩm" required>
        </div>
        <div class="form-group mb-3">
            <label for="description">Mô tả:</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Nhập mô tả sản phẩm" required></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="price">Giá:</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá sản phẩm" required>
        </div>
        <div class="form-group mb-3">
            <label for="category">Danh mục:</label>
            <select class="form-control" id="category" name="category" required>
                <option value="" disabled selected>Chọn danh mục</option>
                <!-- Các danh mục sẽ được điền ở đây -->
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        <a href="/path-to-list-products" class="btn btn-secondary">Quay lại danh sách sản phẩm</a>
    </form>
</div>

<?php include '../shares/footer.php'; ?>