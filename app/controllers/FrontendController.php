<?php
// controllers/AdminController.php
namespace App\Controllers;
class FrontendController {
    public function index() {
        // Path to the dashboard template
        dump_r("Hello World", 1);
        $templatePath = __DIR__ . '/../templates/frontend/index.html';

        // Check if the template file exists
        if (file_exists($templatePath)) {
            require_once ($templatePath);
        } else {
            echo "Dashboard template not found!";
        }
    }

    public function CKimageUpload() {
        require_once  BASE_PATH . '/includes/upload.php';
    }

    // Add more methods for other admin actions as needed
}
