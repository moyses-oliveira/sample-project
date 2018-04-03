<?php

namespace App\Acl\Controller\Extension;

use Spell\MVC\Flash\Route;
use Spell\Flash\Path;
use Data\Service\File\Gallery;

/**
 *
 * @author moyses-oliveira
 */
trait Wysiwyg {


    public function uploadWysiwyg()
    {
        if(!isset($_FILES['image']))
            return $this->json403(['']);
        
        $attach = $_FILES['image'];
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        if(!in_array(strtolower($ext), ['jpg', 'png', 'bmp', 'gif', 'jpeg']))
            return $this->json400(['Invalid file type.']);

        $path = ['Public', 'upload', 'wysiwyg'];
        Path::make([Route::getPath()] + $path);
        
        $gallery = new Gallery($path);
        
        
        $src = Route::getServerName() . Route::getRoot() . $gallery->upload($attach, 1200, 900);
        $response = [
            'data' => compact('src'),
            'success' => true,
            'status' => 200
        ];
        return $this->json($response, 200);
    }
}
