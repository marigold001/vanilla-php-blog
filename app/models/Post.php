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
        $posts = $statement->fetchAll(PDO::FETCH_OBJ);

        foreach ($posts as $post) {
            // Fetch categories related to the current post
            $query = "SELECT c.id, c.name, c.status
                  FROM categories c
                  INNER JOIN post_categories pc ON c.id = pc.category_id
                  WHERE pc.post_id = ?";
            $statement = $this->db->prepare($query);
            $statement->execute([$post->id]);
            $post->categories = $statement->fetchAll(PDO::FETCH_OBJ);

            // Fetch tags related to the current post
            $query = "SELECT t.id, t.name, t.status 
                  FROM tags t
                  INNER JOIN post_tags pt ON t.id = pt.tag_id
                  WHERE pt.post_id = ?";
            $statement = $this->db->prepare($query);
            $statement->execute([$post->id]);
            $post->tags = $statement->fetchAll(PDO::FETCH_OBJ);
        }

        return $posts;
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

        $postId = $this->db->lastInsertId();
        if (!empty($data['tags'])) {
            $tagStmt = $this->db->prepare("INSERT INTO post_tags (post_id, tag_id) VALUES (?, ?)");
            foreach ($data['tags'] as $tagId) {
                $tagStmt->execute([$postId, $tagId]);
            }
        }
        if (!empty($data['categories'])) {
            $catStmt = $this->db->prepare("INSERT INTO post_categories (post_id, category_id) VALUES (?, ?)");
            foreach ($data['categories'] as $catId) {
                $catStmt->execute([$postId, $catId]);
            }
        }
    }

    public function update($id, $data)
    {
        // Prepare the base SQL query
        $sql = "UPDATE posts SET title = ?, summary = ?, content = ?, status = ?";
        $params = [
            $data['title'],
            $data['summary'],
            $data['content'],
            $data['status'],
        ];

        // Check if an image is provided
        if (!empty($data['image'])) {
            $sql .= ", image = ?";
            $params[] = $data['image'];
        }

        // Add WHERE clause
        $sql .= " WHERE id = ?";

        // Add $id to the parameters
        $params[] = $id;

        // Prepare the statement
        $stmt = $this->db->prepare($sql);

        // Execute the statement with the parameters
        $stmt->execute($params);
        if (isset($data['tags'])) {
            $this->updateTags($id, $data['tags']);
        } else {
            $this->deleteTags($id);
        }

        if (isset($data['categories'])) {
            $this->updateCategories($id, $data['categories']);
        } else {
            $this->deleteCategories($id);
        }

        return $stmt->rowCount();
    }


    public function find($id)
    {

        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $post = $stmt->fetch(PDO::FETCH_OBJ);

        // Fetch categories related to the current post
        $query = "SELECT c.id, c.name, c.status
                  FROM categories c
                  INNER JOIN post_categories pc ON c.id = pc.category_id
                  WHERE pc.post_id = ?";
        $statement = $this->db->prepare($query);
        $statement->execute([$id]);
        $post->categories = $statement->fetchAll(PDO::FETCH_OBJ);

        // Fetch tags related to the current post
        $query = "SELECT t.id, t.name, t.status 
                  FROM tags t
                  INNER JOIN post_tags pt ON t.id = pt.tag_id
                  WHERE pt.post_id = ?";
        $statement = $this->db->prepare($query);
        $statement->execute([$id]);
        $post->tags = $statement->fetchAll(PDO::FETCH_OBJ);


        return $post ? $post : null;
    }


    public function delete($id)
    {
        $query = "DELETE FROM posts WHERE id = ?";
        $statement = $this->db->prepare($query);
        $success = $statement->execute([$id]);
        return $success;
    }

    public function postTagsInsert($post_id, $tag_id)
    {
        $query = "SELECT * FROM posts";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteTags($postId)
    {
        $sql = "DELETE FROM post_tags WHERE post_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postId]);
    }

    public function updateTags($postId, $tags)
    {
        // First, delete all existing tags for the post
        $this->deleteTags($postId);

        // Insert new tags for the post
        $sql = "INSERT INTO post_tags (post_id, tag_id) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        foreach ($tags as $tagId) {
            $stmt->execute([$postId, $tagId]);
        }
    }

    public function deleteCategories($postId)
    {
        $sql = "DELETE FROM post_categories WHERE post_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postId]);
    }

    public function updateCategories($postId, $categories)
    {
        // First, delete all existing tags for the post
        $this->deleteCategories($postId);

        // Insert new tags for the post
        $sql = "INSERT INTO post_categories (post_id, category_id) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        foreach ($categories as $catId) {
            $stmt->execute([$postId, $catId]);
        }
    }


}
