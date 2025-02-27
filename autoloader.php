<?php
spl_autoload_register(function ($class) {

    // Base directory for the namespace prefix
    $baseDir = __DIR__ . '/src/';

    // Convert namespace to file path
    $file = $baseDir . str_replace('\\', '/', $class) . '.php';

    // If the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
