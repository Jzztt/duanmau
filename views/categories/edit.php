<?php
// Lấy dữ liệu cũ nếu có, không thì lấy từ category
$old = $_SESSION['old'] ?? $category;
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['old']);
unset($_SESSION['errors']);
?>

<div class="col-12">
    <a href="<?= BASE_URL ?>?action=category-index" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Quay lại
    </a>

    <div class="card">
        <div class="card-body">
            <form action="<?= BASE_URL ?>?action=category-update" method="POST">
                <input type="hidden" name="id" value="<?= $category['id'] ?>">

                <div class="mb-3">
                    <label for="name" class="form-label">Tên thể loại <span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                        id="name"
                        name="name"
                        value="<?= htmlspecialchars($old['name']) ?>"
                        required>
                    <?php if (isset($errors['name'])): ?>
                        <div class="invalid-feedback d-block">
                            <?= htmlspecialchars($errors['name']) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>"
                        id="description"
                        name="description"
                        rows="4"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
                    <?php if (isset($errors['description'])): ?>
                        <div class="invalid-feedback d-block">
                            <?= htmlspecialchars($errors['description']) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Cập nhật
                    </button>
                    <a href="<?= BASE_URL ?>?action=category-index" class="btn btn-secondary">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>