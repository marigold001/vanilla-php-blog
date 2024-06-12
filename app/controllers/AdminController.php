<?php
// controllers/AdminController.php
namespace App\Controllers;
class AdminController {
    public function dashboard() {
        // Path to the dashboard template
        $templatePath = __DIR__ . '/../templates/admin/index.html';

        // Check if the template file exists
        if (file_exists($templatePath)) {
            include($templatePath);
        } else {
            echo "Dashboard template not found!";
        }
    }

    public function CKimageUpload() {
        require_once  BASE_PATH . '/includes/upload.php';
    }

    // Add more methods for other admin actions as needed
}
