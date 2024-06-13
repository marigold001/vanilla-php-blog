<?php
// controllers/AdminController.php
namespace App\Controllers;
use App\Models\Post;

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

    public function single_post($param) {
        $partials = $this->partials();
        $header = $partials['header'];
        $footer = $partials['footer'];
        $postModel = new Post();
        $post = $postModel->find($param['id']);

        require_once '../app/views/frontend/single-post.php';
    }

    public function CKimageUpload() {
        require_once  BASE_PATH . '/includes/upload.php';
    }

    public function partials() {
        ob_start();
        include BASE_PATH . '/app/views/frontend_partials/_header.html';
        $header = ob_get_clean();

        ob_start();
        include BASE_PATH . '/app/views/frontend_partials/_navbar.html';
        $navbar = ob_get_clean();

        ob_start();
        include BASE_PATH . '/app/views/frontend_partials/_footer.html';
        $footer = ob_get_clean();

        return ['header' => $header, 'navbar' => $navbar,  'footer' => $footer];
    }

    // Add more methods for other admin actions as needed
}
