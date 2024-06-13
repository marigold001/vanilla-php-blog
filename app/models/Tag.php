<?php

namespace App\Models;

use PDO;
use App\Config\Database;

class Tag
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all()
    {
        $query = "SELECT * FROM tags";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function update($id, $data) {
        $sql = "UPDATE tags SET name = ?, status = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $params = [];
        $params[] = $data['t_name'];
        $params[] = $data['status'];
        $params[] = $id;
        // Execute the statement with the parameters
        $stmt->execute($params);

        return $stmt->rowCount();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO tags (name, status) VALUES (?, ?)");
        $stmt->execute([$data['t_name'], $data['status']]);
    }


    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tags WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $tag = $stmt->fetch(PDO::FETCH_OBJ);

        return $tag ? $tag : null;
    }

    public function delete($id) {
        $query = "DELETE FROM tags WHERE id = ?";
        $statement = $this->db->prepare($query);
        $success = $statement->execute([$id]);
        return $success;
    }

    public function findSelectedTags($post_id) {
        $query = "SELECT tag_id FROM post_tags WHERE post_id = ?";
        $statement = $this->db->prepare($query);
        $statement->execute([$post_id]);
        $selectedTags = $statement->fetchAll(PDO::FETCH_COLUMN);
        return $selectedTags;
    }
}
