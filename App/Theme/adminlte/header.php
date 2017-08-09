<?php
use Spell\UI\HTML\Tag;
global $user;
$username = $user['name'] ?? null;

// variables
$trPng = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=';
$trImg = Tag::mk('img', false, true)->setAttr('src', $trPng);

//tags
$header = Tag::mk('header', 'main-header');
    $aLogo = Tag::mk('a', 'logo')->setAttr('href', '#');
        $spanLogoMini = Tag::mk('span', 'logo-mini', true)->appendChild($trImg);
        $spanLogoLg = Tag::mk('span', 'logo-lg', true)->appendChild($trImg);
    $aLogo->appendChild($spanLogoMini)->appendChild($spanLogoLg);
    
    $nav = Tag::mk('nav', 'navbar navbar-static-top');
        
        $toggle = Tag::mk('a', 'sidebar-toggle');
        $toggle->setAttr('data-toggle', 'offcanvas')->setAttr('role', 'button');
        $toggle->appendChild(Tag::mk('span','sr-only', true)->setContent('Toggle navigation'));
            $iconBar = Tag::mk('span','icon-bar', true)->render();
        $toggle->appendChild($iconBar)->appendChild($iconBar)->appendChild($iconBar);
        
        $div = Tag::div('navbar-custom-menu');
            $ul = Tag::mk('ul', 'nav navbar-nav');
                $li = Tag::mk('li', 'dropdown user user-menu');
                    $lia = Tag::mk('a', 'dropdown-toggle')->setAttr('href', '#');
                    $lia->setAttr('data-toggle', 'dropdown');
                    $icon = Tag::mk('i', 'fa fa-user')->render();
                    $lia->appendChild(Tag::mk('span', 'hidden-xs')->setContent($icon . ' &nbsp;'. $username));
                    $dd = Tag::mk('ul', 'dropdown-menu');
                        $ddli = Tag::mk('li', 'user-body');
                            $row = Tag::div('row');
                                $divsenha = Tag::div('col-xs-12 text-center');
                                    $asenha = Tag::mk('a', 'btn btn-block btn-default');
                                    $asenha->setAttr('href', '#')->setContent('Alterar Senha');
                                $divsenha->appendChild($asenha);
                                $divlogin = Tag::div('col-xs-12 text-center');
                                    $alogin = Tag::mk('a', 'btn btn-block btn-default');
                                    $alogin->setAttr('href', '/acl/auth/logout')->setContent('Logout');
                                $divlogin->appendChild($alogin);
                            $row->appendChild($divsenha)->appendChild($divlogin);
                         $ddli->appendChild($row);
                    $dd->appendChild($ddli);
                $li->appendChild($lia)->appendChild($dd);
            $ul->appendChild($li);
        $div->appendChild($ul);
    $nav->appendChild($toggle)->appendChild($div);
$header->appendChild($aLogo)->appendChild($nav);

echo $header->render();