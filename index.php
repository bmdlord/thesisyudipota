<?php


# All folders to be included must be include in this array.
# Do not put any file in this folder for they 
# Use as public helper on the System.
$folders = [
	'config',
	'helpers',
	'frontend'
];

# Include each folder from the $folders variable in a loop.
foreach($folders as $folder) {
	# Get each file from this folders using function glob().
	foreach(glob($folder . '/*.php') as $file) {
		# Include all the files.
		include_once($file);
	}
}

# Register an autoloading class file from
# backend\core.
spl_autoload_register(function($class) {
	$class = str_replace('\\', '/', $class) . '.php';
	if(file_exists($class)) {
		include_once($class);
	}
});

# Use the class Modules
use backend\core\Modules;

# Run the Modules class.
(new Modules())->run();

?>
