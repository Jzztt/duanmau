<?php
// Hiển thị thông báo
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo $_SESSION['success'];
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
    echo '</div>';
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo $_SESSION['error'];
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
    echo '</div>';
    unset($_SESSION['error']);
}
?>

<div class="col-12">
    <a href="<?= BASE_URL ?>?action=product-create" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Thêm sản phẩm mới
    </a>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Thể loại</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="7" class="text-center">Chưa có sản phẩm nào</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $product['id'] ?></td>
                                <td>
                                    <?php if (!empty($product['image'])): ?>
                                        <img src="<?= BASE_ASSETS_UPLOADS . $product['image'] ?>" 
                                             alt="<?= htmlspecialchars($product['name']) ?>"
                                             style="width: 60px; height: 60px; object-fit: cover;"
                                             class="rounded">
                                    <?php else: ?>
                                        <div style="width: 60px; height: 60px;" 
                                             class="bg-secondary rounded d-flex align-items-center justify-content-center text-white">
                                            No image
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td><strong><?= htmlspecialchars($product['name']) ?></strong></td>
                                <td class="text-danger"><strong><?= number_format($product['price'], 0, ',', '.') ?> đ</strong></td>
                                <td>
                                    <span class="badge bg-info"><?= htmlspecialchars($product['category_name'] ?? 'Chưa phân loại') ?></span>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($product['created_at'])) ?></td>
                                <td>
                                    <a href="<?= BASE_URL ?>?action=product-edit&id=<?= $product['id'] ?>" 
                                       class="btn btn-sm btn-warning">
                                        Sửa
                                    </a>
                                    <a href="<?= BASE_URL ?>?action=product-delete&id=<?= $product['id'] ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                        Xóa
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

