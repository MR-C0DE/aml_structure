<?php
// Recursive function to include all files in a directory and its subdirectories
function includeAllControllers($directory)
{
    if (is_dir($directory)) {
        // Get a list of files and directories in the specified directory
        $items = scandir($directory);
        foreach ($items as $item) {
            if ($item != '.' && $item != '..') {
                $path = $directory . '/' . $item;
                if (is_dir($path)) {
                    includeAllControllers($path); // Recursive call if it's a subdirectory
                } else {
                    if (pathinfo($path, PATHINFO_EXTENSION) === 'php') {
                        // Include only PHP files
                        require_once $path;

                        // Extract the class name from the file name
                        $class_name = ucfirst(pathinfo($item, PATHINFO_FILENAME));

                        // Check if the class exists
                        if (class_exists($class_name)) {
                            // Create an instance of the class (if needed)
                            $instance = new $class_name();
                            unset($instance); // Clean up the instance if not used
                        }
                    }
                }
            }
        }
    }
}
