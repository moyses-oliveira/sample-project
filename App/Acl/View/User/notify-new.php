<?php
/* @var $user \Data\Entity\Acl\User */
use Spell\UI\HTML\Tag;
$container = Tag::div();
$container->appendChild(Tag::mk('h3')->setContent('Bem vindo ' . $user->getVrcName() . '!'));
$container->appendChild(Tag::mk('h5')->setContent('Um usuário com este e-mail foi cadastrado no painel administrativo do nosso sistema.'));
$container->appendChild(Tag::mk('h4')->setContent('Senha de acesso: <span>' . $pass . '</span>'));

echo $container->render();