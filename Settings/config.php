<?php

namespace Spell\MVC\Flash;

use Spell\Flash\DBAL;
use Spell\Flash\SMTP;
use Spell\Flash\Path;
use Spell\Data\Doctrine\DBALCollection;
use Spell\Data\Service\SMTPConfigCollection;
use Spell\MVC\Router\RouteCollection;
use Spell\MVC\UI\Layout\ThemeCollection;

$GLOBALS['home'] = '/' . Path::combine(['acl', 'auth', 'dashboard'], '/');
$GLOBALS['loginUrl'] = '/acl/auth/login';
if (!trim($_SERVER['REQUEST_URI'], '/'))
    header('location: ' . $GLOBALS['home']);

$domain = $_SERVER['HTTP_HOST'];

$root = realpath(implode(DIRECTORY_SEPARATOR, [__DIR__, '..']));

$db = (object)[
    'host'=>getenv('DB_PRIMARY_HOST'),
    'user'=>getenv('DB_PRIMARY_USER'),
    'pass'=>getenv('DB_PRIMARY_PASS'), 
    'db'=>getenv('DB_PRIMARY_DB')  
];

$dbalCollection = new DBALCollection();
$dbalCollection->add('default', $db->host, $db->db, $db->user, $db->pass);
DBAL::setCollection($dbalCollection);

$themes = new ThemeCollection();
$themes->add('adminto', Path::combine([$root, 'App', 'Theme', 'adminto']), 'index.php', 'Adminto');
$themes->add('notification', Path::combine([$root, 'App', 'Theme', 'notification']), 'theme.php', 'Notification');
Theme::setCollection($themes);

$routes = new RouteCollection();
$routes->add('acl', $domain . '/acl', 'Acl', 'adminto');
$routes->add('cms', $domain . '/cms', 'Cms', 'adminto');
$routes->add('cns', $domain . '/cns', 'Cns', 'adminto');
$routes->add('pms', $domain . '/pms', 'Pms', 'adminto');
$routes->add('doctrine', $domain . '/doctrine', 'Doctrine', 'adminto');

Route::setCollection($routes);

$smtp = new SMTPConfigCollection();
$smtp->add('default', getenv('SMTP_HOST'), getenv('SMTP_EMAIL'), getenv('SMTP_PASS'), getenv('SMTP_PORT'), getenv('SMTP_SECURITY'));
SMTP::setCollection($smtp);
