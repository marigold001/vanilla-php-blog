<?php

namespace App\Controllers;

use App\Models\Category;

class CategoriesController
{
    public function index() {
        $categoriesModel = new Category();
        $categories = $categoriesModel->all();
        $partials = $this->partials();
        $header = $partials['header'];
        $navbar = $partials['navbar'];
        $sidebar = $partials['sidebar'];
        $footer = $partials['footer'];
        require_once  BASE_PATH . '/app/views/categories/index.php';
    }
    public function create()
    {
        // Load the view to create a new post
        $partials = $this->partials();
        $header = $partials['header'];
        $navbar = $partials['navbar'];
        $sidebar = $partials['sidebar'];
        $footer = $partials['footer'];
        require_once  BASE_PATH . '/app/views/categories/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $c_name = $_POST['c_name'];
            $status = $_POST['status'];
            $post = new Category();
            $post->create([
                'c_name' => $c_name,
                'status' => $status
            ]);
            header('Location: /admin/categories');
        }
    }

    public function edit($param) {
        $category_model = new Category();
        $category = $category_model->find($param['id']);

        $partials = $this->partials();
        $header = $partials['header'];
        $navbar = $partials['navbar'];
        $sidebar = $partials['sidebar'];
        $footer = $partials['footer'];

        // Check if the post exists
        if (!$category) {
            die('Category not found');
        }

        // Load the view to edit the post
        require_once BASE_PATH . '/app/views/categories/edit.php';
    }
    public function update($param)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = ['c_name' => $_POST['c_name'], 'status' => $_POST['status']];
            $category = new Category();
            $success = $category->update(
                $param['id'],
                $data
            );

            if ($success) {
                $_SESSION['message'] = 'Category update successfully.';
                $_SESSION['success'] = true;
            } else {
                $_SESSION['message'] = 'Failed to update category.';
                $_SESSION['success'] = false;
            }

            header('Location: /admin/categories');
        }
    }



    public function destroy($params)
    {
        // Logic to delete the post with the specified ID from the database
        // Redirect to the index page after deleting the post
        $category_model = new Category();
        $success = $category_model->delete($params['id']);

        if ($success) {
            $_SESSION['message'] = 'Category deleted successfully.';
            $_SESSION['success'] = true;
        } else {
            $_SESSION['message'] = 'Failed to delete category.';
            $_SESSION['success'] = false;
        }

        header("Location: /admin/categories");
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
            $cat_model = new Category();
            $deletedCount = 0;

            foreach($_POST['cat_ids'] as $cat_id) {
                $success = $cat_model->delete($cat_id);
                if($success) {
                    $deletedCount++;
                }
            }

            $_SESSION['message'] = $deletedCount . ' category(s) deleted successfully.';
            $_SESSION['success'] = true;

            header("Location: /admin/categories");
            exit;
        }
    }
}