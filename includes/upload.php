<?php

// upload.php
// upload.php
function log_error($message) {
    error_log($message, 3, BASE_PATH . '/logs/upload_errors.log');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['uploaded' => false];

    if (isset($_FILES['upload']) && $_FILES['upload']['error'] === 0) {
        $uploadDir = BASE_PATH . '/public/uploads/';
        $fileName = basename($_FILES['upload']['name']);
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $safeFileName = parseImageName(pathinfo($fileName, PATHINFO_FILENAME)) . '.' . $fileExtension;
        $filePath = $uploadDir . $safeFileName;

        if (!is_dir($uploadDir) || !is_writable($uploadDir)) {
            $error_message = 'Upload directory is not writable or does not exist.';
            log_error($error_message);
            $response['error'] = ['message' => $error_message];
        } elseif (move_uploaded_file($_FILES['upload']['tmp_name'], $filePath)) {
            $response = [
                'uploaded' => true,
                'url' => BASE_URL . '/uploads/' . $safeFileName
            ];
        } else {
            $error_message = 'Could not upload the file.';
            log_error($error_message);
            $response['error'] = ['message' => $error_message];
        }
    } else {
        $error_message = 'No file uploaded or there was an error. Error code: ' . $_FILES['upload']['error'];
        log_error($error_message);
        $response['error'] = [
            'message' => $error_message,
            'error_code' => $_FILES['upload']['error']
        ];
    }

    echo json_encode($response);
}
