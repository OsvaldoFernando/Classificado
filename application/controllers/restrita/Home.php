<?php

//Controller responsáel pela área restrita do projeto

defined('BASEPATH') OR exit('entrada proibida');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		/*
		 * Definir se há uma sessão válida
		 */

		if (!$this->ion_auth->logged_in()) {
			redirect('restrita/login'); //Se não estiver logado
		}

		/*
		 * Definir se é admin
		 * se não for será renderizado para parte pública
		 */

		if (!$this->ion_auth->is_admin()) {
			redirect('/');//Parte pública
		}
	}

	public function index()
	{

		$this->load->view('restrita/layout/header');
		$this->load->view('restrita/home/index');
		$this->load->view('restrita/layout/footer');
	}
}
