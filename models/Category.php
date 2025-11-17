<?php

class Category extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'categories';
    }

    // Lấy tất cả thể loại
    public function all()
    {
        try {
            $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            die("Lỗi khi lấy dữ liệu: " . $e->getMessage());
        }
    }

    // Lấy 1 thể loại theo ID
    public function find($id)
    {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            die("Lỗi khi lấy dữ liệu: " . $e->getMessage());
        }
    }

    // Thêm thể loại mới
    public function create($data)
    {
        try {
            $sql = "INSERT INTO {$this->table} (name, description) VALUES (:name, :description)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'name' => $data['name'],
                'description' => $data['description']
            ]);
            return true;
        } catch (PDOException $e) {
            die("Lỗi khi thêm dữ liệu: " . $e->getMessage());
        }
    }

    // Cập nhật thể loại
    public function update($id, $data)
    {
        try {
            $sql = "UPDATE {$this->table} SET name = :name, description = :description WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id' => $id,
                'name' => $data['name'],
                'description' => $data['description']
            ]);
            return true;
        } catch (PDOException $e) {
            die("Lỗi khi cập nhật dữ liệu: " . $e->getMessage());
        }
    }

    // Xóa thể loại
    public function delete($id)
    {
        try {
            $sql = "DELETE FROM {$this->table} WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            die("Lỗi khi xóa dữ liệu: " . $e->getMessage());
        }
    }

    // Đếm số sản phẩm trong thể loại
    public function countProducts($id)
    {
        try {
            $sql = "SELECT COUNT(*) as total FROM products WHERE category_id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch();
            return $result['total'];
        } catch (PDOException $e) {
            return 0;
        }
    }
}

