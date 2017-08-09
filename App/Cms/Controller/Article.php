<?php

namespace App\Cms\Controller;

use App\Acl\Controller\AbstractController;
use Spell\MVC\Flash\Route;
use Spell\Flash\Path;
use Spell\Flash\Localization;
use Data\Service\File\Gallery;

class Article extends AbstractController {

    public function __settings()
    {
        $this->setTitle(Localization::T(__CLASS__ . '::TITLE'));
    }

    public function index($fkGroup = null)
    {
        $this->setSubtitle(Localization::T('SUBTITLE_DATA'));

        if(!$fkGroup):
            $groupOptions = $this->getEm()->getRepository('\Data\Entity\Cms\ArticleGroup')->options();
            return $this->render(compact('fkGroup', 'groupOptions'));
        endif;
        $entity = new \Data\Entity\Cms\ArticleGroup();
        $group = $entity->load($fkGroup)->getVrcName();

        $this->setSubtitle($group);
        return $this->render(compact('fkGroup', 'group'));
    }

    public function datatable($fkGroup)
    {
        /* @var $repository \Data\Repository\Cms\Article */
        $repository = $this->getEm()->getRepository('\Data\Entity\Cms\Article');
        $_GET['fkGroup'] = $fkGroup;
        return $this->json($repository->loadData($_GET));
    }

    public function create($fkGroup)
    {
        return $this->form($fkGroup);
    }

    public function update($fkGroup, $pk)
    {
        $entity = (new \Data\Entity\Cms\Article)->load($pk);

        if(!$entity)
            return $this->error('Page can\'t be found!', 404);

        return $this->form($fkGroup, $entity->toArray());
    }

    private function form($fkGroup, $data = [])
    {
        $theme = $this->getTheme();
        $theme->addCss('library/trumbowyg/ui/trumbowyg.min.css');
        $theme->addCss('library/fileupload/jquery.fileupload.css');
        $theme->addCss('library/spell/css/Document.css');
        $theme->addCss('library/spell/css/Gallery.css');
        $theme->addJs('library/trumbowyg/trumbowyg.min.js');
        $theme->addJs('library/trumbowyg/plugins/upload/trumbowyg.upload.min.js');
        $theme->addJs('library/trumbowyg/trumbowyg.bootstrap.js');
        $theme->addJs('library/fileupload/jquery.ui.widget.js');
        $theme->addJs('library/fileupload/jquery.fileupload.js');
        $theme->addJs('library/spell/js/Document.js');
        $theme->addJs('library/spell/js/Gallery.js');
        $id = $data['id'] ?? null;
        $action = $data ? Route::link(Route::getModule(), 'save', $data['id']) : Route::link(Route::getModule(), 'save');
        $this->getView()->setFile('form.php');
        $categoryOptions = $this->getEm()->getRepository('\Data\Entity\Cms\ArticleCategory')->options($fkGroup);
        $saved = $this->getSessionMessage(__CLASS__ . '::saved');


        /* @var $attachmentRepository \Data\Repository\Cms\ArticleAttachment */
        $attachmentRepository = $this->getEm()->getRepository('\Data\Entity\Cms\ArticleAttachment');
        $attachments = !!$id ? $attachmentRepository->getFromArticle($id) : [];

        /* @var $imageRepository \Data\Repository\Cms\ArticleImage */
        $imageRepository = $this->getEm()->getRepository('\Data\Entity\Cms\ArticleImage');
        $images = !!$id ? $imageRepository->getFromArticle($id) : [];

        return $this->render(compact('data', 'action', 'saved', 'categoryOptions', 'fkGroup', 'attachments', 'images'));
    }

    public function save(?string $pk = null)
    {
        $inspector = new \Data\Inspector\Cms\Article();
        $entity = (new \Data\Entity\Cms\Article)->load($pk);

        if(!$entity)
            return $this->json403();

        $response = (new \Data\Service\Cms\Article())->save($inspector, $entity, $_POST);
        $response['redirect'] = Route::link(Route::getModule(), 'update', $response['data']['fkGroup'], $response['data']['id']);

        if($response['success'])
            $this->setSessionMessage(__CLASS__ . '::saved', 'SAVED');

        return $this->json($response, 200);
    }

    public function uploadWysiwyg()
    {
        if(!isset($_FILES['image']))
            return $this->json403(['']);

        $attach = $_FILES['image'];
        $ext = pathinfo($attach['name'], PATHINFO_EXTENSION);
        $filename = md5(uniqid()) . ".$ext";
        $path = ['Public', 'upload', 'cms', 'wysiwyg', $filename];
        $destination = implode(DIRECTORY_SEPARATOR, array_merge([Route::getPath()], $path));
        move_uploaded_file($attach['tmp_name'], $destination);
        $src = Route::getServerName() . Route::getRoot() . Path::combine($path, '/');
        $response = [
            'data' => compact('src'),
            'success' => true,
            'status' => 200
        ];
        return $this->json($response, 200);
    }

    public function uploadDocument()
    {
        if(!isset($_FILES['spell_document']))
            return $this->json403(['']);

        $attach = $_FILES['spell_document'];
        $ext = pathinfo($attach['name'], PATHINFO_EXTENSION);
        $name = pathinfo($attach['name'], PATHINFO_FILENAME);
        $filename = md5(uniqid()) . ".$ext";
        $path = ['Public', 'upload', 'cms', 'document', $filename];
        $destination = implode(DIRECTORY_SEPARATOR, array_merge([Route::getPath()], $path));
        move_uploaded_file($attach['tmp_name'], $destination);
        $src = Route::getServerName() . Route::getRoot() . Path::combine($path, '/');

        $response = [
            'data' => compact('src', 'name', 'ext'),
            'success' => true,
            'status' => 200
        ];
        return $this->json($response, 200);
    }

    public function uploadGallery()
    {
        if(!isset($_FILES['spell_gallery']))
            return $this->json403();

        $attach = $_FILES['spell_gallery'];
        $name = $attach['name'];
        $ext = pathinfo($name, PATHINFO_EXTENSION);

        if(!in_array(strtolower($ext), ['jpg', 'png', 'bmp', 'gif', 'jpeg']))
            return $this->json400(['Invalid file type.']);

        $alt = $title = pathinfo($name, PATHINFO_FILENAME);
        $gallery = new Gallery(['Public', 'upload', 'cms', 'gallery']);
        $gallery->addSize('small', 400, 300);
        $gallery->addSize('medium', 800, 600);
        $gallery->addSize('large', 1200, 900);
        $src = $gallery->upload($attach);
        $summary = '';
        $thumb = Gallery::toSize($src, 'small');
        $response = [
            'data' => compact('src', 'thumb', 'name', 'ext', 'alt', 'title', 'summary'),
            'success' => true,
            'status' => 200
        ];
        return $this->json($response, 200);
    }

}
