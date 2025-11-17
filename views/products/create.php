<?php
// Hiển thị lỗi
if (isset($_SESSION['errors'])) {
    echo '<div class="col-12"><div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo '<strong>Có lỗi xảy ra:</strong><ul class="mb-0">';
    foreach ($_SESSION['errors'] as $error) {
        echo '<li>' . $error . '</li>';
    }
    echo '</ul>';
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
    echo '</div></div>';
    unset($_SESSION['errors']);
}

// Lấy dữ liệu cũ nếu có
$old = $_SESSION['old'] ?? [];
unset($_SESSION['old']);
?>

<div class="col-12">
    <a href="<?= BASE_URL ?>?action=product-index" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Quay lại
    </a>

    <div class="card">
        <div class="card-body">
            <form action="<?= BASE_URL ?>?action=product-store" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control" 
                                   id="name" 
                                   name="name" 
                                   value="<?= htmlspecialchars($old['name'] ?? '') ?>"
                                   required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control" 
                                   id="price" 
                                   name="price" 
                                   value="<?= htmlspecialchars($old['price'] ?? '') ?>"
                                   min="0"
                                   step="0.01"
                                   required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Thể loại <span class="text-danger">*</span></label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">-- Chọn thể loại --</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>"
                                            <?= (isset($old['category_id']) && $old['category_id'] == $category['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình ảnh</label>
                            <input type="file" 
                                   class="form-control" 
                                   id="image" 
                                   name="image"
                                   accept="image/*">
                            <small class="text-muted">Chấp nhận: JPG, PNG, GIF</small>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea class="form-control" 
                              id="description" 
                              name="description" 
                              rows="4"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Lưu
                    </button>
                    <a href="<?= BASE_URL ?>?action=product-index" class="btn btn-secondary">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

