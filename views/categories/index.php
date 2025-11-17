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
    <a href="<?= BASE_URL ?>?action=category-create" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Thêm thể loại mới
    </a>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên thể loại</th>
                        <th>Mô tả</th>
                        <th>Số sản phẩm</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($categories)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Chưa có thể loại nào</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?= $category['id'] ?></td>
                                <td><strong><?= htmlspecialchars($category['name']) ?></strong></td>
                                <td><?= htmlspecialchars($category['description'] ?? '') ?></td>
                                <td>
                                    <span class="badge bg-info"><?= $category['product_count'] ?> sản phẩm</span>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($category['created_at'])) ?></td>
                                <td>
                                    <a href="<?= BASE_URL ?>?action=category-edit&id=<?= $category['id'] ?>" 
                                       class="btn btn-sm btn-warning">
                                        Sửa
                                    </a>
                                    <a href="<?= BASE_URL ?>?action=category-delete&id=<?= $category['id'] ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa thể loại này?')">
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

