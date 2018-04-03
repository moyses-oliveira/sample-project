<?php

namespace App\Acl\Controller;

use Spell\Flash\Path;
use Spell\MVC\Flash\App;
use Spell\MVC\Flash\Route;
use Spell\Flash\Localization;
use Spell\Server\Session;
use Spell\UI\HTML\Tag;
use App\UI\Breadcrumb;

abstract class AbstractController extends \Spell\MVC\AbstractController {

    /**
     *
     * @var string 
     */
    private $title = '';

    /**
     *
     * @var string
     */
    private $subtitle = '';

    /**
     *
     * @var \Spell\Server\Session 
     */
    private $session = null;

    /**
     *
     * @var bool 
     */
    protected $isPublic = false;

    /**
     *
     * @var bool
     */
    protected $isAuth = true;

    /**
     *
     * @var type 
     */
    private $breadcrumb = null;

    public function __construct()
    {
        $this->session = new Session();
        $this->getSession()->start('spellphp');
        $this->breadcrumb = new Breadcrumb();
        Localization::init();
    }

    public function __settings()
    {
        $title = Localization::T(get_called_class() . '::TITLE');
        $home = Tag::mk('i', 'fa fa-home')->render() . ' &nbsp;Home';
        $homeUrl = $GLOBALS['home'] ?? Route::getRoot() . Path::combine(['acl', 'auth', 'dashboard'], '/');
        $this->getBreadcrumb()->add($home, $homeUrl);
        $this->setTitle($title);
    }

    public function authenticate()
    {
        $auth = $this->getSession()->get('auth');
        $superuser = !!$this->getSession()->get('superuser');
        if($this->isPublic)
            return $this;

        if(!$this->isPublic && !$auth)
            return $this->mkLogin();

        if(!$this->isAuth)
            return $this;

        $app = strtolower(App::getAlias());
        if(!$superuser && !in_array([$app, Route::getModule()], $auth))
            return $this->error('You have no permission to access this page.', 400);

        return $this;
    }

    public function getBreadcrumb(bool $clean = false): Breadcrumb
    {
        if($clean)
            $this->breadcrumb = new Breadcrumb();

        return $this->breadcrumb;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        if(Route::getAction() === 'index')
            $this->getBreadcrumb()->add($title);
        else
            $this->getBreadcrumb()->add($title, Route::link(Route::getModule(), 'index'));
    }

    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
        if(Route::getAction() !== 'index')
            $this->getBreadcrumb()->add($subtitle);
    }

    public function setTheme($theme)
    {
        parent::setTheme($theme);
        $GLOBALS['acl'] = $this->getSession()->get('acl');
        $GLOBALS['user'] = $this->getSession()->get('user');
        $GLOBALS['profiles'] = $this->getSession()->get('profiles');
        return $this;
    }

    /**
     * 
     * @return Session
     */
    public function getSession(): Session
    {
        return $this->session;
    }

    protected function error($message, $code)
    {
        $view = $this->getTheme()->getView('content');
        $view->setPath($this->getTheme()->getPath())->setFile('error.php')->setData(compact('message', 'code'));
        echo $this->getTheme()->render();
        exit;
    }

    protected function getSessionMessage(string $key)
    {
        $data = $this->getSession()->get($key);
        $this->getSession()->set($key, null);
        return $data;
    }

    protected function setSessionMessage(string $key, $value)
    {
        $this->getSession()->set($key, $value);
    }

    protected function redirect(string $url)
    {
        header('Location: ' . $url);
        exit;
    }

    protected function mkLogin()
    {
        $this->redirect($GLOBALS['loginUrl']);
    }

    protected function render($data = array(), $code = 200)
    {
        $GLOBALS['breadcrumb'] = $this->breadcrumb;
        $this->getTheme()->getHead()->setTitle($this->title, $this->subtitle);
        parent::render($data, $code);
    }

}
