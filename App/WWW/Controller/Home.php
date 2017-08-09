<?php
namespace App\Www\Controller;
class Home extends \Spell\MVC\AbstractController{

	public function index(){
		$batatinha = 'variable batatinha';
		$this->render(compact('batatinha'));
	}
	
	public function login(){
		
	}
	
}