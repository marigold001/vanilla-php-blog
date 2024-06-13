<?php
// Start PHP block

require_once __DIR__ . '/app/controllers/PostController.php';
require_once __DIR__ . '/app/controllers/AdminController.php';
require_once __DIR__ . '/app/controllers/FrontendController.php';
require_once __DIR__ . '/app/controllers/TagsController.php';
require_once __DIR__ . '/app/controllers/CategoriesController.php';
require_once __DIR__ . '/app/models/Post.php';
require_once __DIR__ . '/app/models/Tag.php';
require_once __DIR__ . '/app/models/Category.php';
require_once __DIR__ . '/app/config/Database.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';

use App\Controllers\CategoriesController;
use App\Controllers\FrontendController;
use App\Controllers\PostController;
use App\Controllers\AdminController;
use App\Controllers\TagsController;

// Define routes
$routes = [
    // posts
    '/admin/posts' => [PostController::class, 'index'],
    '/admin/posts/create' => [PostController::class, 'create'],
    '/admin/posts/store' => [PostController::class, 'store'],
    '/admin/posts/{id}' => [PostController::class, 'show'],
    '/admin/posts/{id}/edit' => [PostController::class, 'edit'],
    '/admin/posts/{id}/update' => [PostController::class, 'update'],
    '/admin/posts/{id}/delete' => [PostController::class, 'destroy'],
    '/admin/posts/bulkDelete' => [PostController::class, 'bulkDelete'],
    '/upload' => [AdminController::class, 'CKimageUpload'],

    // categories
    '/admin/categories' => [CategoriesController::class, 'index'],
    '/admin/categories/create' => [CategoriesController::class, 'create'],
    '/admin/categories/store' => [CategoriesController::class, 'store'],
    '/admin/categories/{id}/edit' => [CategoriesController::class, 'edit'],
    '/admin/categories/{id}/update' => [CategoriesController::class, 'update'],
    '/admin/categories/{id}/delete' => [CategoriesController::class, 'destroy'],
    '/admin/categories/bulkDelete' => [CategoriesController::class, 'bulkDelete'],

    //tags
    '/admin/tags' => [TagsController::class, 'index'],
    '/admin/tags/create' => [TagsController::class, 'create'],
    '/admin/tags/store' => [TagsController::class, 'store'],
    '/admin/tags/{id}/edit' => [TagsController::class, 'edit'],
    '/admin/tags/{id}/update' => [TagsController::class, 'update'],
    '/admin/tags/{id}/delete' => [TagsController::class, 'destroy'],
    '/admin/tags/bulkDelete' => [TagsController::class, 'bulkDelete'],

    // Frontend routes
    '/' => [FrontendController::class, 'index'],
    '/post/{id}' => [FrontendController::class, 'single_post'],

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
