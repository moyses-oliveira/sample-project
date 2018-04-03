<?php

return [
    # TITLE
    'nav::acl::user-employee' => 'Funcionário',
    'nav::acl::group' => 'Grupo',
    'App\Acl\Controller\Auth::TITLE' => 'Home',
    'App\Acl\Controller\App::TITLE' => 'Applicação',
    'App\Acl\Controller\Module::TITLE' => 'Modulo',
    'App\Acl\Controller\Profile::TITLE' => 'Perfil',
    'App\Acl\Controller\Group::TITLE' => 'Grupo',
    'App\Acl\Controller\User::TITLE' => 'Usuário',
    'App\Acl\Controller\Category::TITLE' => 'Categoria',
    'App\Acl\Controller\Me::TITLE' => 'Meu Perfil',
    'App\Acl\Controller\UserEmployee::TITLE' => 'Funcionário',
    
    # ERRORS
    'Data\Service\Acl\App::ERROR_REPEATED' => 'Já existe um App cadastrado com esse Alias ou Nome.',
    'Data\Service\Acl\Module::ERROR_REPEATED' => 'Já existe um modulo cadastrado com esse Alias nesse App.',
    'Data\Service\Acl\Profile::ERROR_REPEATED' => 'Já existe um perfil cadastrado com esse Alias ou Nome.',
    'Auth\Login\Error::EMAIL' => 'Usuário não encontrado.',
    'Auth\Login\Error::Login' => 'Senha inválida.',
    'Auth\Login\Error::PASS' => 'Senha inválida.',
];
