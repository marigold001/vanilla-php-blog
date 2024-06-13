<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PostController
{
    public function index()
    {
        // Retrieve all posts from the database
        $postModel = new Post();
        $posts = $postModel->all();
        $partials = $this->partials();
        $header = $partials['header'];
        $navbar = $partials['navbar'];
        $sidebar = $partials['sidebar'];
        $footer = $partials['footer'];


        require_once  BASE_PATH . '/app/views/posts/index.php';
    }

    public function create()
    {
        // Load the view to create a new post
        $partials = $this->partials();
        $header = $partials['header'];
        $navbar = $partials['navbar'];
        $sidebar = $partials['sidebar'];
        $footer = $partials['footer'];
        $tags_model = new Tag();
        $tags = $tags_model->all();
        $categories_model = new Category();
        $categories = $categories_model->all();
        require_once  BASE_PATH . '/app/views/posts/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $summary = $_POST['summary'];
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
            if($_POST['tags']) {
                $tags = $_POST['tags'];
            }
            if($_POST['categories']) {
                $categories = $_POST['categories'];
            }
            $post = new Post();
            $post->create([
                'title' => $title,
                'summary' => $summary,
                'content' => $content,
                'image' => $parsedImageName,
                'status' => $status,
                'tags' => $tags,
                'categories' => $categories
            ]);

            header('Location: /admin/posts');
        }
    }

    public function update($param)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $summary = $_POST['summary'];
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
            if(isset($_POST['tags'])) {
                $tags = $_POST['tags'];
            } else {
                $tags = null;
            }
            if(isset($_POST['categories'])) {
                $categories = $_POST['categories'];
            } else {
                $categories = null;
            }
            $post = new Post();
            $data = [
                'title' => $title,
                'summary' => $summary,
                'content' => $content,
                'image' => $parsedImageName,
                'status' => $status,
                'tags' => $tags,
                'categories' => $categories
            ];
            // Only set the image if a new image was uploaded
            if ($parsedImageName === null) {
                unset($data['image']);
            }


            $post->update($param['id'], $data);

            header('Location: /admin/posts');
        }
    }


    public function edit($param)
    {
        // Retrieve the post with the specified ID from the database
        $post_model = new Post();
        $post = $post_model->find($param['id']);

        $partials = $this->partials();
        $header = $partials['header'];
        $navbar = $partials['navbar'];
        $sidebar = $partials['sidebar'];
        $footer = $partials['footer'];

        // Check if the post exists
        if (!$post) {
            die('Post not found');
        }

        $tags_model = new Tag();
        $tags = $tags_model->all();
        $selectedTags = $tags_model->findSelectedTags($param['id']);

        $categories_model = new Category();
        $categories = $categories_model->all();
        $selectedCategories = $categories_model->findSelectedCategories($param['id']);
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

    public function partials() {
        ob_start();
        include BASE_PATH . '/app/views/backend_partials/_header.php';
        $header = ob_get_clean();

        ob_start();
        include BASE_PATH . '/app/views/backend_partials/_navbar.php';
        $navbar = ob_get_clean();

        ob_start();
        include BASE_PATH . '/app/views/backend_partials/_sidebar.php';
        $sidebar = ob_get_clean();

        ob_start();
        include BASE_PATH . '/app/views/backend_partials/_footer.php';
        $footer = ob_get_clean();

        return ['header' => $header,   'navbar' => $navbar, 'sidebar' =>$sidebar, 'footer' => $footer];
    }

}
