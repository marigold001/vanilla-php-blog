<?php
// Start PHP block

require_once __DIR__ . '/app/controllers/PostController.php';
require_once __DIR__ . '/app/controllers/AdminController.php';
require_once __DIR__ . '/app/models/Post.php';
require_once __DIR__ . '/app/config/Database.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';

use App\Controllers\FrontendController;
use App\Controllers\PostController;
use App\Controllers\AdminController;

// Define routes
$routes = [
    '/admin/posts' => [PostController::class, 'index'],
    '/admin/posts/create' => [PostController::class, 'create'],
    '/admin/posts/store' => [PostController::class, 'store'],
    '/admin/posts/{id}' => [PostController::class, 'show'],
    '/admin/posts/{id}/edit' => [PostController::class, 'edit'],
    '/admin/posts/{id}/update' => [PostController::class, 'update'],
    '/admin/posts/{id}/delete' => [PostController::class, 'destroy'],
    '/admin/posts/bulkDelete' => [PostController::class, 'bulkDelete'],
    '/upload' => [AdminController::class, 'CKimageUpload'],
    // Frontend routes
    '/' => [FrontendController::class, 'index']
];

// Get the current URL
$url = $_SERVER['REQUEST_URI'];

// Remove query string from URL
$urlParts = explode('?', $url);
$url = rtrim($urlParts[0], '/');

if ($url === '') {
    $url = '/';
}

// Match the URL to a route
foreach ($routes as $route => $action) {

    $pattern = str_replace('/', '\/', $route);
    $pattern = preg_replace('/\{(\w+)\}/', '(?<$1>\d+)', $pattern); // Replace placeholders with named capture groups


    if (preg_match('/^' . $pattern . '$/', $url, $matches)) {
        if (is_callable($action)) {
            // If the action is a callable (e.g., closure), call it directly
            $action($matches);
        } else {
            // Extract controller and method names
            list($controllerName, $methodName) = $action;

            // Create controller instance
            $controller = new $controllerName();

            // Call controller method with route parameters
            $controller->$methodName($matches);
        }

        exit; // Stop processing further routes
    }
}

// If no route matches, show a 404 error
http_response_code(404);
echo "Page not found!";
