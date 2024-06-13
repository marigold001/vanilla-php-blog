<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Tag;

class TagsController
{
    public function index() {
        $tagsModel = new Tag();
        $tags = $tagsModel->all();
        $partials = $this->partials();
        $header = $partials['header'];
        $navbar = $partials['navbar'];
        $sidebar = $partials['sidebar'];
        $footer = $partials['footer'];
        require_once  BASE_PATH . '/app/views/tags/index.php';
    }
    public function create()
    {
        // Load the view to create a new post
        $partials = $this->partials();
        $header = $partials['header'];
        $navbar = $partials['navbar'];
        $sidebar = $partials['sidebar'];
        $footer = $partials['footer'];
        require_once  BASE_PATH . '/app/views/tags/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $t_name = $_POST['t_name'];
            $status = $_POST['status'];

            $post = new Tag();
            $post->create([
                't_name' => $t_name,
                'status' => $status
            ]);
            header('Location: /admin/tags');
        }
    }

    public function edit($param) {
        $tag_model = new Tag();
        $tag = $tag_model->find($param['id']);

        $partials = $this->partials();
        $header = $partials['header'];
        $navbar = $partials['navbar'];
        $sidebar = $partials['sidebar'];
        $footer = $partials['footer'];

        // Check if the post exists
        if (!$tag) {
            die('Tag not found');
        }

        // Load the view to edit the post
        require_once BASE_PATH . '/app/views/tags/edit.php';
    }
    public function update($param)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = ['t_name' => $_POST['t_name'], 'status' => $_POST['status']];
            $tag = new Tag();
            $success = $tag->update(
                $param['id'],
                $data
            );

            if ($success) {
                $_SESSION['message'] = 'Tag update successfully.';
                $_SESSION['success'] = true;
            } else {
                $_SESSION['message'] = 'Failed to update tag.';
                $_SESSION['success'] = false;
            }

            header('Location: /admin/tags');
        }
    }



    public function destroy($params)
    {
        // Logic to delete the post with the specified ID from the database
        // Redirect to the index page after deleting the post
        $tag_model = new Tag();
        $success = $tag_model->delete($params['id']);

        if ($success) {
            $_SESSION['message'] = 'Tag deleted successfully.';
            $_SESSION['success'] = true;
        } else {
            $_SESSION['message'] = 'Failed to delete tag.';
            $_SESSION['success'] = false;
        }

        header("Location: /admin/tags");
        exit;
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

    public function bulkDelete($params)
    {
        if(isset($_POST['delete'])) {
            $tag_model = new Tag();
            $deletedCount = 0;

            foreach($_POST['tag_ids'] as $tag_id) {
                $success = $tag_model->delete($tag_id);
                if($success) {
                    $deletedCount++;
                }
            }

            $_SESSION['message'] = $deletedCount . ' tag(s) deleted successfully.';
            $_SESSION['success'] = true;

            header("Location: /admin/tags");
            exit;
        }
    }
}