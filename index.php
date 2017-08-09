<?php
date_default_timezone_set("America/Sao_Paulo");
header('Content-Type: text/html; charset=UTF-8');

//require_once implode(DIRECTORY_SEPARATOR, [__DIR__, 'vendor', 'spell', 'autoload.php']);
require_once implode(DIRECTORY_SEPARATOR, [__DIR__, 'vendor', 'autoload.php']);
require_once implode(DIRECTORY_SEPARATOR, [__DIR__, 'Settings', 'autoload.php']);
require_once implode(DIRECTORY_SEPARATOR, [__DIR__, 'Settings', 'config.php']);

$bootstrap = new Spell\MVC\Bootstrap(__DIR__, $routes);