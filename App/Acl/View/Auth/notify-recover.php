<?php
/* @var $user \Data\Entity\Acl\User */
use Spell\UI\HTML\Tag;
$container = Tag::div();
$container->appendChild(Tag::mk('h3')->setContent('Olá ' . $user->getVrcName() . '!'));
$container->appendChild(Tag::mk('h5')->setContent('Segue sua senha para acessar o painel administrativo akitemcarro.com.br'));
$container->appendChild(Tag::mk('h4')->setContent('Senha de acesso: <span>' . $pass . '</span>'));

echo $container->render();