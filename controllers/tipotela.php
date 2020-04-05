<?php

/**
 * 
 */
class Tipotela extends Controller{
	
	function __construct(){
		parent::__construct();
		$this->view->tipostela = [];
	}

	function render(){
		$tipostela = $this->model->getTipostelaForProduct();
		$this->view->tipostela = $tipostela;
	}
}

?>