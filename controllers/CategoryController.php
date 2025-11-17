<?php

class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    // Hiển thị danh sách thể loại
    public function index()
    {
        $title = 'Quản lý thể loại';
        $view = 'categories/index';
        $categories = $this->categoryModel->all();
        
        // Thêm số lượng sản phẩm cho mỗi thể loại
        foreach ($categories as &$category) {
            $category['product_count'] = $this->categoryModel->countProducts($category['id']);
        }
        
        require_once PATH_VIEW_MAIN;
    }

    // Hiển thị form thêm thể loại
    public function create()
    {
        $title = 'Thêm thể loại mới';
        $view = 'categories/create';
        require_once PATH_VIEW_MAIN;
    }

    // Xử lý thêm thể loại
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => trim($_POST['name'] ?? ''),
                'description' => trim($_POST['description'] ?? '')
            ];

            // Validate
            $errors = [];
            if (empty($data['name'])) {
                $errors[] = 'Tên thể loại không được để trống';
            }

            if (empty($errors)) {
                $this->categoryModel->create($data);
                $_SESSION['success'] = 'Thêm thể loại thành công!';
                header('Location: ' . BASE_URL . '?action=category-index');
                exit;
            } else {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $data;
                header('Location: ' . BASE_URL . '?action=category-create');
                exit;
            }
        }
    }

    // Hiển thị form sửa thể loại
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: ' . BASE_URL . '?action=category-index');
            exit;
        }

        $category = $this->categoryModel->find($id);
        if (!$category) {
            $_SESSION['error'] = 'Không tìm thấy thể loại';
            header('Location: ' . BASE_URL . '?action=category-index');
            exit;
        }

        $title = 'Sửa thể loại';
        $view = 'categories/edit';
        require_once PATH_VIEW_MAIN;
    }

    // Xử lý cập nhật thể loại
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? null;
            if (!$id) {
                $_SESSION['error'] = 'ID không hợp lệ';
                header('Location: ' . BASE_URL . '?action=category-index');
                exit;
            }

            $data = [
                'name' => trim($_POST['name'] ?? ''),
                'description' => trim($_POST['description'] ?? '')
            ];

            // Validate
            $errors = [];
            if (empty($data['name'])) {
                $errors[] = 'Tên thể loại không được để trống';
            }

            if (empty($errors)) {
                $this->categoryModel->update($id, $data);
                $_SESSION['success'] = 'Cập nhật thể loại thành công!';
                header('Location: ' . BASE_URL . '?action=category-index');
                exit;
            } else {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $data;
                header('Location: ' . BASE_URL . '?action=category-edit&id=' . $id);
                exit;
            }
        }
    }

    // Xóa thể loại
    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: ' . BASE_URL . '?action=category-index');
            exit;
        }

        // Kiểm tra xem có sản phẩm nào trong thể loại này không
        $productCount = $this->categoryModel->countProducts($id);
        if ($productCount > 0) {
            $_SESSION['error'] = "Không thể xóa thể loại này vì còn {$productCount} sản phẩm. Vui lòng xóa hoặc chuyển sản phẩm sang thể loại khác trước!";
            header('Location: ' . BASE_URL . '?action=category-index');
            exit;
        }

        $this->categoryModel->delete($id);
        $_SESSION['success'] = 'Xóa thể loại thành công!';
        header('Location: ' . BASE_URL . '?action=category-index');
        exit;
    }
}

