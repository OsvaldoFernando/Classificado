<?php

/*
 * Controller responsável por gerenciar as categorias filhas
 */

defined('BASEPATH') or exit('Acesso proibido');

class Sistema extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		/*
		 * Definir se há uma sessão válida
		 */

		if (!$this->ion_auth->logged_in()) {
			redirect('restrita/login'); //Se estiver logado
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
		/*
		 *   stdClass Object
(
    stdClass Object
(
     [sistema_id] => 1
    [sistema_razao_social] => Anuncios Inc
    [sistema_nome_fantasia] => Anúncios legais
    [sistema_nif] => 80.838.809/0001-26
    [sistema_agt] => 683.90228-49
    [sistema_telefone_fixo] => (41) 3232-3030
    [sistema_telefone_movel] => (41) 9999-9999
    [sistema_email] => anuncioslegais@contato.com.br
    [sistema_site_titulo] => Anúncios legais
    [sistema_cep] => 80510-000
    [sistema_endereco] => Rua da Programação
    [sistema_numero] => 54
    [sistema_bairro] => Centro
    [sistema_cidade] => Curitiba
    [sistema_provincia] => PR
    [sistema_data_alteracao] => 2020-09-16 02:44:54
)
)
		 *
		 */

		$this->form_validation->set_rules('sistema_razao_social', 'Razão social', 'trim|required|min_length[4]|max_length[130]');
		$this->form_validation->set_rules('sistema_nome_fantasia', 'Razão social', 'trim|required|min_length[4]|max_length[130]');
		$this->form_validation->set_rules('sistema_nif', 'NIF', 'trim|required|max_length[14]');
		$this->form_validation->set_rules('sistema_agt', 'AGT', 'trim|max_length[14]');
		$this->form_validation->set_rules('sistema_telefone_fixo', 'Telefone fixo', 'trim|max_length[14]');
		$this->form_validation->set_rules('sistema_telefone_movel', 'Telefone', 'trim|required|max_length[14]');
		$this->form_validation->set_rules('sistema_email', 'E-mail', 'trim|required|valid_email|max_length[90]');
		$this->form_validation->set_rules('sistema_site_titulo', 'Título do website', 'trim|required|min_lenght[5]|max_lenght[200]');
		$this->form_validation->set_rules('sistema_cep', 'CEP', 'trim|exact_length[4]');
		$this->form_validation->set_rules('sistema_site_titulo', 'Título do website', 'trim|required|min_length[4]|max_length[230]');
		$this->form_validation->set_rules('sistema_endereco', 'Endereço', 'trim|min_lenght[5]|max_lenght[130]');
		$this->form_validation->set_rules('sistema_numero', 'Número', 'trim|required|max_length[25]');
		$this->form_validation->set_rules('sistema_bairro', 'Bairro', 'trim|required|min_length[4]|max_length[90]');
		$this->form_validation->set_rules('sistema_provincia', 'Cidade', 'trim|required|exact_length[2]');
		$this->form_validation->set_rules('sistema_cidade', 'Província', 'trim|required|min_length[5]|max_length[43]');


		//Verificar se a validação rodou aplicamos já um debug em tudo que está vindo do post
		if ($this->form_validation->run()) {

//			echo '<pre>';
//			print_r($this->input->post());
//			exit();

			/*
			 * Array
(
    [sistema_razao_social] => Anuncios Inc
    [sistema_nome_fantasia] => Anúncios legais
    [sistema_nif] => 002054351LA035
    [sistema_telefone_fixo] =>
    [sistema_telefone_movel] => +244926219731
    [sistema_agt] =>
    [sistema_email] => anuncioslegais@contato.com
    [sistema_site_titulo] => Anúncios legais
    [sistema_cep] => 0000
    [sistema_numero] => 001
    [sistema_bairro] => Maxinde
    [sistema_cidade] => Malanje
    [sistema_provincia] => BE
)
			 */

			$data = elements(
				array(
					'sistema_razao_social',
					'sistema_nome_fantasia',
					'sistema_nif',
					'sistema_telefone_fixo',
					'sistema_telefone_movel',
					'sistema_agt',
					'sistema_email',
					'sistema_site_titulo',
					'sistema_cep',
					'sistema_numero',
					'sistema_bairro',
					'sistema_cidade',
					'sistema_provincia',
				), $this->input->post()
			);

			$data = html_escape($data);
			$this->core_model->update('sistema', $data, array('sistema_id' => 1));
			redirect('restrita/'.$this->router->fetch_class());

		} else {

			//Erro de validação e quando temos erro pegamos tudo que está fora e renderizamos outra vez mais a view

			$data = array(
				'titulo' => 'Gerenciar as informações do website',

				'scripts' => array(
					'assets/mask/jquery.mask.min.js',
					'assets/mask/custom.js',
				),

				'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1)), //Como vai trazer todos os dados da tabela deve referenciar o nome da tabela é 1 porque só terá mesmo sistema
			);

			// Debug para confirmar se existe retorno dos dado vindo do banco de dado usuários
//			echo '<pre>';
//			print_r($data['sistema']);
//			exit();

			$this->load->view('restrita/layout/header', $data);
			$this->load->view('restrita/sistema/index');
			$this->load->view('restrita/layout/footer');
		}
	}
}
