<?php
function parseImageName($imageName) {
    // Remove special characters and convert to lowercase
    $imageName = strtolower(preg_replace('/[^a-zA-Z0-9\s]/', '', $imageName));

    // Replace spaces with dashes
    $imageName = str_replace(' ', '-', $imageName);

    // Ensure only alphanumeric characters and dashes are present
    $imageName = preg_replace('/[^a-z0-9-]/', '', $imageName);

    return $imageName;
}

function getImagePath($imageName) {
    // Define the base path
    $basePath = BASE_PATH . '/public/uploads/';

    // Return the full path to the image
    return $basePath . $imageName;
}

?>
