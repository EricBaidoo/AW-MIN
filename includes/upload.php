<?php
/**
 * Secure file upload helper
 * 
 * @param array $file The $_FILES['input_name'] array
 * @param string $destinationDir Directory relative to public/ (e.g. 'uploads/')
 * @return string|false The URL path to the uploaded file on success, or false on failure
 */
function handleImageUpload($file, $destinationDir = 'uploads/') {
    if (!isset($file['error']) || is_array($file['error'])) {
        return false;
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    // Check file size (e.g., max 5MB)
    if ($file['size'] > 5000000) {
        return false;
    }

    // Check MIME type securely
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($file['tmp_name']),
        array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp'
        ),
        true
    )) {
        return false;
    }

    // Generate unique name
    $fileName = sprintf('%s.%s', sha1_file($file['tmp_name']) . '_' . time(), $ext);
    
    $uploadPath = __DIR__ . '/../public/' . $destinationDir;
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0755, true);
    }

    $fullPath = $uploadPath . $fileName;

    if (!move_uploaded_file($file['tmp_name'], $fullPath)) {
        return false;
    }

    return '/' . $destinationDir . $fileName;
}
