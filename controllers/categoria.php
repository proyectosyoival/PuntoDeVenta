<?php

/**
 * 
 */
class Categoria extends Controller{
	
	function __construct(){
		parent::__construct();
		$this->view->categorias = [];
	}

	function render(){
		$categorias = $this->model->getCategoriesForProduct();
		$this->view->categorias = $categorias;
	}
}

?>