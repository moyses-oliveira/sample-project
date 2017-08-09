<?php
namespace Spell\Flash;
$root = realpath(implode(DIRECTORY_SEPARATOR, [__DIR__, '..']));

// Function Autoloader
$functions = glob(implode(DIRECTORY_SEPARATOR, [$root, 'Library', 'Function', '*.php']));
foreach($functions as $func)
	require_once $func;

// Smart Spell Autoloader
Autoloader::init($root);
Autoloader::add('App', 'App', '.php');
Autoloader::add('Data', 'Data', '.php');
Autoloader::add('Model', 'Model', '.php');

Localization::config($root, 'pt-br');
