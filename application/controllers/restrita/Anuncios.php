<?php

/*
 * Controller responsável por gerenciar as categorias filhas
 */

defined('BASEPATH') or exit('Acesso proibido');

class Anuncios extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

//		/*
//		 * Definir se há uma sessão válida
//		 */
//
		if (!$this->ion_auth->logged_in()) {
			redirect('restrita/login'); //Se não estiver logado
		}

//
//		/*
//		 * Definir se é admin
//		 * se não for será renderizado para parte pública
//		 */
//
//		if (!$this->ion_auth->is_admin()) {
//			redirect('/');//Parte pública
//		}
//
		//*********** ESTE MÓDULO SERÁ REQUISITADO VIA AJAX REQUEST, por isso não podemos deixar is_admin porque o anuncioante não administrador não vai permitir ********
	}

	public function index()
	{
		$data = array(
			'titulo' => 'Anúncios cadastrados',

			'styles' => array(
				'assets/bundles/datatables/datatables.min.css',
				'assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
			),

			'scripts' => array(
				'assets/bundles/datatables/datatables.min.js',
				'assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
				'assets/bundles/jquery-ui/jquery-ui.min.js',
				'assets/js/page/datatables.js',
			),

		);


		//Vou verificar se quem esta logado é um administrador

		if ($this->ion_auth->is_admin()) {

			$data['anuncios'] = $this->anuncios_model->get_all(); //Não é informado nenhum parâmetro quando é admin

		}else{

			$data['anuncios'] = $this->anuncios_model->get_all($this->session->userdata('user_id')); //Recupero da sessão o usuário logado
		}

		// Debug para confirmar se existe retorno dos dado vindo do banco de dado usuários
//		echo '<pre>';
//		print_r($data['anuncios']);
//		exit();

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/anuncios/index');
		$this->load->view('restrita/layout/footer');

	}

}
