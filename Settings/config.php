<?php

namespace Spell\MVC\Flash;

use Spell\Flash\DBAL;
use Spell\Flash\SMTP;
use Spell\Flash\Path;
use Spell\Data\Doctrine\DBALCollection;
use Spell\Data\Service\SMTPConfigCollection;
use Spell\MVC\Router\RouteCollection;
use Spell\MVC\UI\Layout\ThemeCollection;

$domain = $_SERVER['HTTP_HOST'];
if(!trim($_SERVER['REQUEST_URI'], '/'))
    header("location: /acl");

$root = realpath(implode(DIRECTORY_SEPARATOR, [__DIR__, '..']));

$db = (object)[
    'host'=>getenv('DB_PRIMARY_HOST'),
    'user'=>getenv('DB_PRIMARY_USER'),
    'pass'=>getenv('DB_PRIMARY_PASS')  
];

$dbalCollection = new DBALCollection();
$dbalCollection->add('default', $db->host, 'spell', $db->user, $db->pass);
$dbalCollection->add('acl', $db->host, 'acl', $db->user, $db->pass);
$dbalCollection->add('brain', $db->host, 'brain', $db->user, $db->pass);
$dbalCollection->add('nb', $db->host, 'nb', $db->user, $db->pass);
$dbalCollection->add('ifreak', $db->host, 'ifreak', $db->user, $db->pass);
DBAL::setCollection($dbalCollection);

$themes = new ThemeCollection();
$themes->add('panel', Path::combine([$root, 'App', 'Theme', 'adminlte']), 'index.php', 'Spell Panel');
$themes->add('adminto', Path::combine([$root, 'App', 'Theme', 'adminto']), 'index.php', 'Adminto');
$themes->add('adminto-www', Path::combine([$root, 'App', 'Theme', 'adminto-www']), 'index.php', 'Front');
$themes->add('notification', Path::combine([$root, 'App', 'Theme', 'notification']), 'theme.php', 'Notification');
Theme::setCollection($themes);

$routes = new RouteCollection();
$routes->add('acl', $domain . '/acl', 'Acl', 'adminto');
$routes->add('cms', $domain . '/cms', 'Cms', 'adminto');
$routes->add('cns', $domain . '/cns', 'Cns', 'adminto');
$routes->add('pms', $domain . '/pms', 'Pms', 'adminto');
$routes->add('unit', $domain . '/unit', 'Unit', 'adminto');
$routes->add('unit', $domain . '/ifreak', 'Ifreak', 'adminto-www');
$routes->add('doctrine', $domain . '/doctrine', 'Doctrine', 'adminto');

Route::setCollection($routes);

$smtp = new SMTPConfigCollection();
$smtp->add('default', 'smtp.gmail.com', getenv('SMTP_EMAIL'), getenv('SMTP_PASS'), 465, 'ssl');
SMTP::setCollection($smtp);
