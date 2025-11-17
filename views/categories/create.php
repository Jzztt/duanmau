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
    <a href="<?= BASE_URL ?>?action=category-index" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Quay lại
    </a>

    <div class="card">
        <div class="card-body">
            <form action="<?= BASE_URL ?>?action=category-store" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Tên thể loại <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control" 
                           id="name" 
                           name="name" 
                           value="<?= htmlspecialchars($old['name'] ?? '') ?>"
                           required>
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
                    <a href="<?= BASE_URL ?>?action=category-index" class="btn btn-secondary">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

