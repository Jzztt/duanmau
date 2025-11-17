<?php

class ProductController
{
    private $productModel;
    private $categoryModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
    }

    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $title = 'Quản lý sản phẩm';
        $view = 'products/index';
        $products = $this->productModel->all();
        require_once PATH_VIEW_MAIN;
    }

    // Hiển thị form thêm sản phẩm
    public function create()
    {
        $title = 'Thêm sản phẩm mới';
        $view = 'products/create';
        $categories = $this->categoryModel->all();
        require_once PATH_VIEW_MAIN;
    }

    // Xử lý thêm sản phẩm
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => trim($_POST['name'] ?? ''),
                'price' => trim($_POST['price'] ?? 0),
                'description' => trim($_POST['description'] ?? ''),
                'category_id' => $_POST['category_id'] ?? null
            ];

            // Validate
            $errors = [];
            if (empty($data['name'])) {
                $errors[] = 'Tên sản phẩm không được để trống';
            }
            if (empty($data['price']) || $data['price'] <= 0) {
                $errors[] = 'Giá sản phẩm phải lớn hơn 0';
            }
            if (empty($data['category_id'])) {
                $errors[] = 'Vui lòng chọn thể loại';
            }

            // Xử lý upload ảnh
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                try {
                    $data['image'] = upload_file('products', $_FILES['image']);
                } catch (Exception $e) {
                    $errors[] = $e->getMessage();
                }
            }

            if (empty($errors)) {
                $this->productModel->create($data);
                $_SESSION['success'] = 'Thêm sản phẩm thành công!';
                header('Location: ' . BASE_URL . '?action=product-index');
                exit;
            } else {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $data;
                header('Location: ' . BASE_URL . '?action=product-create');
                exit;
            }
        }
    }

    // Hiển thị form sửa sản phẩm
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: ' . BASE_URL . '?action=product-index');
            exit;
        }

        $product = $this->productModel->find($id);
        if (!$product) {
            $_SESSION['error'] = 'Không tìm thấy sản phẩm';
            header('Location: ' . BASE_URL . '?action=product-index');
            exit;
        }

        $title = 'Sửa sản phẩm';
        $view = 'products/edit';
        $categories = $this->categoryModel->all();
        require_once PATH_VIEW_MAIN;
    }

    // Xử lý cập nhật sản phẩm
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? null;
            if (!$id) {
                $_SESSION['error'] = 'ID không hợp lệ';
                header('Location: ' . BASE_URL . '?action=product-index');
                exit;
            }

            $data = [
                'name' => trim($_POST['name'] ?? ''),
                'price' => trim($_POST['price'] ?? 0),
                'description' => trim($_POST['description'] ?? ''),
                'category_id' => $_POST['category_id'] ?? null
            ];

            // Validate
            $errors = [];
            if (empty($data['name'])) {
                $errors[] = 'Tên sản phẩm không được để trống';
            }
            if (empty($data['price']) || $data['price'] <= 0) {
                $errors[] = 'Giá sản phẩm phải lớn hơn 0';
            }
            if (empty($data['category_id'])) {
                $errors[] = 'Vui lòng chọn thể loại';
            }

            // Xử lý upload ảnh mới
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                try {
                    // Xóa ảnh cũ
                    $oldProduct = $this->productModel->find($id);
                    if ($oldProduct && !empty($oldProduct['image'])) {
                        $oldImagePath = PATH_ASSETS_UPLOADS . $oldProduct['image'];
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                    
                    $data['image'] = upload_file('products', $_FILES['image']);
                } catch (Exception $e) {
                    $errors[] = $e->getMessage();
                }
            }

            if (empty($errors)) {
                $this->productModel->update($id, $data);
                $_SESSION['success'] = 'Cập nhật sản phẩm thành công!';
                header('Location: ' . BASE_URL . '?action=product-index');
                exit;
            } else {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $data;
                header('Location: ' . BASE_URL . '?action=product-edit&id=' . $id);
                exit;
            }
        }
    }

    // Xóa sản phẩm
    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: ' . BASE_URL . '?action=product-index');
            exit;
        }

        $this->productModel->delete($id);
        $_SESSION['success'] = 'Xóa sản phẩm thành công!';
        header('Location: ' . BASE_URL . '?action=product-index');
        exit;
    }
}

