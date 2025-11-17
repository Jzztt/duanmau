<?php

class Product extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'products';
    }

    // Lấy tất cả sản phẩm kèm thông tin thể loại
    public function all()
    {
        try {
            $sql = "SELECT p.*, c.name as category_name 
                    FROM {$this->table} p 
                    LEFT JOIN categories c ON p.category_id = c.id 
                    ORDER BY p.id DESC";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            die("Lỗi khi lấy dữ liệu: " . $e->getMessage());
        }
    }

    // Lấy 1 sản phẩm theo ID
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

    // Thêm sản phẩm mới
    public function create($data)
    {
        try {
            $sql = "INSERT INTO {$this->table} (name, price, image, description, category_id) 
                    VALUES (:name, :price, :image, :description, :category_id)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'name' => $data['name'],
                'price' => $data['price'],
                'image' => $data['image'] ?? null,
                'description' => $data['description'],
                'category_id' => $data['category_id']
            ]);
            return true;
        } catch (PDOException $e) {
            die("Lỗi khi thêm dữ liệu: " . $e->getMessage());
        }
    }

    // Cập nhật sản phẩm
    public function update($id, $data)
    {
        try {
            // Nếu có ảnh mới thì cập nhật, không thì giữ nguyên
            if (isset($data['image'])) {
                $sql = "UPDATE {$this->table} 
                        SET name = :name, price = :price, image = :image, 
                            description = :description, category_id = :category_id 
                        WHERE id = :id";
                $params = [
                    'id' => $id,
                    'name' => $data['name'],
                    'price' => $data['price'],
                    'image' => $data['image'],
                    'description' => $data['description'],
                    'category_id' => $data['category_id']
                ];
            } else {
                $sql = "UPDATE {$this->table} 
                        SET name = :name, price = :price, 
                            description = :description, category_id = :category_id 
                        WHERE id = :id";
                $params = [
                    'id' => $id,
                    'name' => $data['name'],
                    'price' => $data['price'],
                    'description' => $data['description'],
                    'category_id' => $data['category_id']
                ];
            }
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return true;
        } catch (PDOException $e) {
            die("Lỗi khi cập nhật dữ liệu: " . $e->getMessage());
        }
    }

    // Xóa sản phẩm
    public function delete($id)
    {
        try {
            // Lấy thông tin ảnh trước khi xóa
            $product = $this->find($id);
            
            // Xóa file ảnh nếu có
            if ($product && !empty($product['image'])) {
                $imagePath = PATH_ASSETS_UPLOADS . $product['image'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            
            // Xóa sản phẩm
            $sql = "DELETE FROM {$this->table} WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            die("Lỗi khi xóa dữ liệu: " . $e->getMessage());
        }
    }
}

