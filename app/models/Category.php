<?php

namespace App\Models;

use PDO;
use App\Config\Database;

class Category
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all()
    {
        $query = "SELECT * FROM categories";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update($id, $data) {
        $sql = "UPDATE categories SET name = ?, status = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $params = [];
        $params[] = $data['c_name'];
        $params[] = $data['status'];
        $params[] = $id;
        // Execute the statement with the parameters
        $stmt->execute($params);

        return $stmt->rowCount();
    }


    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO categories (name, status) VALUES (?, ?)");
        $stmt->execute([$data['c_name'], $data['status']]);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $tag = $stmt->fetch(PDO::FETCH_OBJ);

        return $tag ? $tag : null;
    }

    public function delete($id) {
        $query = "DELETE FROM categories WHERE id = ?";
        $statement = $this->db->prepare($query);
        $success = $statement->execute([$id]);
        return $success;
    }

    public function findSelectedCategories($post_id) {
        $query = "SELECT category_id FROM post_categories WHERE post_id = ?";
        $statement = $this->db->prepare($query);
        $statement->execute([$post_id]);
        $selectedTags = $statement->fetchAll(PDO::FETCH_COLUMN);
        return $selectedTags;
    }
}
