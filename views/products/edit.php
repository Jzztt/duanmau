<?php
// Lấy dữ liệu cũ nếu có, không thì lấy từ product
$old = $_SESSION['old'] ?? $product;
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['old']);
unset($_SESSION['errors']);
?>

<div class="col-12">
    <a href="<?= BASE_URL ?>?action=product-index" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Quay lại
    </a>

    <div class="card">
        <div class="card-body">
            <form action="<?= BASE_URL ?>?action=product-update" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $product['id'] ?>">

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
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
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá <span class="text-danger">*</span></label>
                            <input type="number"
                                class="form-control <?= isset($errors['price']) ? 'is-invalid' : '' ?>"
                                id="price"
                                name="price"
                                value="<?= htmlspecialchars($old['price']) ?>"
                                min="0"
                                step="0.01"
                                required>
                            <?php if (isset($errors['price'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= htmlspecialchars($errors['price']) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Thể loại <span class="text-danger">*</span></label>
                            <select class="form-select <?= isset($errors['category_id']) ? 'is-invalid' : '' ?>"
                                id="category_id"
                                name="category_id"
                                required>
                                <option value="">-- Chọn thể loại --</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>"
                                        <?= ($old['category_id'] == $category['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($errors['category_id'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= htmlspecialchars($errors['category_id']) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình ảnh</label>
                            <input type="file"
                                class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>"
                                id="image"
                                name="image"
                                accept="image/*">
                            <small class="text-muted">Để trống nếu không muốn thay đổi ảnh</small>
                            <?php if (isset($errors['image'])): ?>
                                <div class="invalid-feedback d-block">
                                    <?= htmlspecialchars($errors['image']) ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($product['image'])): ?>
                                <div class="mt-2">
                                    <img src="<?= BASE_ASSETS_UPLOADS . $product['image'] ?>"
                                        alt="<?= htmlspecialchars($product['name']) ?>"
                                        style="max-width: 200px; max-height: 200px;"
                                        class="rounded">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
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
                    <a href="<?= BASE_URL ?>?action=product-index" class="btn btn-secondary">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>