<?php

namespace App\Controllers;

use App\Models\Post;

class PostController
{
    public function index()
    {
        // Retrieve all posts from the database
        $postModel = new Post();
        $posts = $postModel->all();

        // Load the view to display all posts
        require_once  BASE_PATH . '/app/views/posts/index.php';
    }

    public function create()
    {
        // Load the view to create a new post
        require_once  BASE_PATH . '/app/views/posts/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $status = $_POST['status'];
            $content = $_POST['content'];

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imageName = basename($_FILES['image']['name']);
                $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
                $parsedImageName = parseImageName(pathinfo($imageName, PATHINFO_FILENAME)) . '.' . $imageExtension;
                $image = 'uploads/' . $parsedImageName;
                move_uploaded_file($_FILES['image']['tmp_name'], BASE_PATH . '/public/' . $image);
            } else {
                $parsedImageName = null;
            }

            $post = new Post();
            $post->create([
                'title' => $title,
                'content' => $content,
                'image' => $parsedImageName,
                'status' => $status,
            ]);

            header('Location: /admin/posts');
        }
    }

    public function update($param)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $status = $_POST['status'];
            $content = $_POST['content'];

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imageName = basename($_FILES['image']['name']);
                $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
                $parsedImageName = parseImageName(pathinfo($imageName, PATHINFO_FILENAME)) . '.' . $imageExtension;
                $image = 'uploads/' . $parsedImageName;
                move_uploaded_file($_FILES['image']['tmp_name'], BASE_PATH . '/public/' . $image);
            } else {
                $parsedImageName = null;  // No new image uploaded
            }

            $post = new Post();
            $data = [
                'title' => $title,
                'content' => $content,
                'image' => $parsedImageName,
                'status' => $status,
            ];
            // Only set the image if a new image was uploaded
            if ($parsedImageName === null) {
                unset($data['image']);
            }

            $post->update($param['id'], $data);

            header('Location: /admin/posts');
        }
    }



    public function show($id)
    {
        // Retrieve the post with the specified ID from the database
        $post = Post::find($id);

        // Load the view to display the single post
        require_once '../app/views/posts/show.php';
    }

    public function edit($param)
    {
        // Retrieve the post with the specified ID from the database
        $post_model = new Post();
        $post = $post_model->find($param['id']);

        // Check if the post exists
        if (!$post) {
            die('Post not found');
        }

        // Load the view to edit the post
        require_once BASE_PATH . '/app/views/posts/edit.php';
    }

    public function destroy($params)
    {
        // Logic to delete the post with the specified ID from the database
        // Redirect to the index page after deleting the post
        $post_model = new Post();
        $success = $post_model->delete($params['id']);

        if ($success) {
            $_SESSION['message'] = 'Post deleted successfully.';
            $_SESSION['success'] = true;
        } else {
            $_SESSION['message'] = 'Failed to delete post.';
            $_SESSION['success'] = false;
        }

        header("Location: /admin/posts");
        exit;
    }

    public function bulkDelete($params)
    {
        if(isset($_POST['delete'])) {
            $post_model = new Post();
            $deletedCount = 0;

            foreach($_POST['post_ids'] as $post_id) {
                $success = $post_model->delete($post_id);
                if($success) {
                    $deletedCount++;
                }
            }

            $_SESSION['message'] = $deletedCount . ' post(s) deleted successfully.';
            $_SESSION['success'] = true;

            header("Location: /admin/posts");
            exit;
        }
    }

}
