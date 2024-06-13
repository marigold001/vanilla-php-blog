<?php
// controllers/AdminController.php
namespace App\Controllers;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class FrontendController {
    public function index() {
        $partials = $this->partials();
        $header = $partials['header'];
        $footer = $partials['footer'];
        $navbar = $partials['navbar'];
        $postModel = new Post();
        $posts = $postModel->all();
        require_once '../app/views/frontend/index.php';
    }

    public function about() {
        $partials = $this->partials();
        $header = $partials['header'];
        $footer = $partials['footer'];
        $navbar = $partials['navbar'];
        require_once '../app/views/frontend/about.php';
    }

    public function contact() {
        $partials = $this->partials();
        $header = $partials['header'];
        $footer = $partials['footer'];
        $navbar = $partials['navbar'];
        require_once '../app/views/frontend/contact.php';
    }

    public function categories() {
        $partials = $this->partials();
        $header = $partials['header'];
        $navbar = $partials['navbar'];
        $aside_block = $partials['aside_block'];
        $footer = $partials['footer'];
        $post_model = new Post();
        $posts = $post_model->all();
        $category_model = new Category();
        $categories = $category_model->all();
        $tags_model = new Tag();
        $tags = $tags_model->all();
        require_once '../app/views/frontend/categories.php';
    }

    public function categories_single($param) {
        $partials = $this->partials();
        $header = $partials['header'];
        $navbar = $partials['navbar'];
        $aside_block = $partials['aside_block'];
        $footer = $partials['footer'];
        $post_model = new Post();
        $posts = $post_model->all();
        $category_model = new Category();
        $category = $category_model->find($param['id']);
        $categories = $category_model->all();
        $tags_model = new Tag();
        $tags = $tags_model->all();
        $tag = $tags_model->find($param['id']);
        require_once '../app/views/frontend/categories-single.php';
    }

    public function tags() {
        $partials = $this->partials();
        $header = $partials['header'];
        $navbar = $partials['navbar'];
        $aside_block = $partials['aside_block'];
        $footer = $partials['footer'];
        $post_model = new Post();
        $posts = $post_model->all();
        $category_model = new Category();
        $categories = $category_model->all();
        $tags_model = new Tag();
        $tags = $tags_model->all();
        require_once '../app/views/frontend/tags.php';
    }

    public function tags_single($param) {
        $partials = $this->partials();
        $header = $partials['header'];
        $navbar = $partials['navbar'];
        $aside_block = $partials['aside_block'];
        $footer = $partials['footer'];
        $post_model = new Post();
        $posts = $post_model->all();
        $category_model = new Category();
        $category = $category_model->find($param['id']);
        $categories = $category_model->all();
        $tags_model = new Tag();
        $tags = $tags_model->all();
        $tag = $tags_model->find($param['id']);
        require_once '../app/views/frontend/tags-single.php';
    }

    public function single_post($param) {
        $partials = $this->partials();
        $header = $partials['header'];
        $navbar = $partials['navbar'];
        $aside_block = $partials['aside_block'];
        $footer = $partials['footer'];
        $postModel = new Post();
        $post = $postModel->find($param['id']);

        require_once '../app/views/frontend/single-post.php';
    }

    public function CKimageUpload() {
        require_once  BASE_PATH . '/includes/upload.php';
    }

    public function partials() {
        $post_model = new Post();
        $posts = $post_model->all();

        $category_model = new Category();
        $categories = $category_model->all();

        $tag_model = new Tag();
        $tags = $tag_model->all();

        ob_start();
        include BASE_PATH . '/app/views/frontend_partials/_header.php';
        $header = ob_get_clean();


        ob_start();
        include BASE_PATH . '/app/views/frontend_partials/_navbar.php';
        $navbar = ob_get_clean();

        ob_start();
        include BASE_PATH . '/app/views/frontend_partials/aside_block.php';
        $aside_block = ob_get_clean();

        ob_start();
        include BASE_PATH . '/app/views/frontend_partials/_footer.php';
        $footer = ob_get_clean();

        return ['header' => $header, 'navbar' => $navbar, 'aside_block' => $aside_block,  'footer' => $footer];
    }

    // Add more methods for other admin actions as needed
}
