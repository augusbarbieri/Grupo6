<?php
// php/config.php

if (!defined('BASE_URL')) {
    // Calculate the base URL dynamically.
    // This allows the application to be placed in a subdirectory without breaking links.
    $config_dir = str_replace('\\', '/', __DIR__);
    $document_root = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);

    // Ensure DOCUMENT_ROOT is not empty and is a substring of the directory.
    if (!empty($document_root) && strpos($config_dir, $document_root) === 0) {
        // Get the part of the path after the document root.
        $base_path = substr($config_dir, strlen($document_root));
        // Remove the '/php' part to get the true base directory.
        $base_url = str_replace('/php', '', $base_path);
        // Define the constant, ensuring it ends with exactly one slash.
        define('BASE_URL', rtrim($base_url, '/') . '/');
    } else {
        // Fallback to a simple root path if the calculation fails.
        define('BASE_URL', '/');
    }
}
