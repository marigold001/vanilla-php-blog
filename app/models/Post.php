<?php

namespace App\Models;

use PDO;
use App\Config\Database;

class Post
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all()
    {
        $query = "SELECT * FROM posts";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO posts (title, content, image, status, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([
            $data['title'],
            $data['content'],
            $data['image'],
            $data['status']
        ]);
    }

    public function update($id, $data)
    {
        // Prepare the base SQL query
        $sql = "UPDATE posts SET title = ?, content = ?, status = ?";

        // Check if an image is provided
        if (!empty($data['image'])) {
            $sql .= ", image = ?";
        }

        $sql .= " WHERE id = ?";

        // Prepare the statement
        $stmt = $this->db->prepare($sql);
        // Bind parameters based on whether the image is provided
        if (!empty($data['image'])) {
            $params = [
                $data['title'],
                $data['content'],
                $data['status'],
                $data['image'],
                $id
            ];
        } else {
            $params = [
                $data['title'],
                $data['content'],
                $data['status'],
                $id
            ];
        }

        // Execute the statement with the parameters
        $stmt->execute($params);
        return $stmt->rowCount();
    }


    public function find($id)
    {

        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $post = $stmt->fetch(PDO::FETCH_OBJ);

        return $post ? $post : null;
    }


    public function delete($id) {
        $query = "DELETE FROM posts WHERE id = ?";
        $statement = $this->db->prepare($query);
        $success = $statement->execute([$id]);
        return $success;
    }

}
