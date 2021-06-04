<?php

/*
 * Controller responsável por gerenciar as categorias filhas
 */

defined('BASEPATH') or exit('Acesso proibido');

class Categoria extends CI_Controller
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

		$this->load->model('categorias_model');
	}

	public function index()
	{
		$data = array(
			'titulo' => 'Categorias cadastradas',

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

//			'categorias' => $this->core_model->get_all('categorias'), //Como vai trazer todos os dados da tabela deve referenciar o nome da tabela
			'categorias' => $this->categorias_model->get_all_categorias(), //Chamando a função do arquivo Categorias_model
		);

		// Debug para confirmar se existe retorno dos dado vindo do banco de dado usuários
//		echo '<pre>';
//		print_r($data['masters']);
//		exit();

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/categorias/index');
		$this->load->view('restrita/layout/footer');

	}

	public function core($categoria_id = null)
	{

		//Casting que recebe ele mesmo
		$categoria_id = (int)$categoria_id;


		/*
		 * Verificar se a categoria pai contém valor
		 */

		if (!$categoria_id) {

			/*
			 * Cadastrando
			 */

			$this->form_validation->set_rules('categoria_nome', 'Nome da categoria', 'trim|required|min_length[4]|max_length[45]|callback_valida_nome_categoria');
			$this->form_validation->set_rules('categoria_pai_id', 'Categoria pai', 'trim|required');

			/*
			 * Verifico se o meu formulário foi validado
			 */

			if ($this->form_validation->run()) {


//					array
//					(
//						[categoria_nome] => Games
//						[categoria_classe_icone] => lni - game
//						[categoria_ativa] => 1
//    					[categoria_id] => 1
//					)

				$data = elements(

					array(
						'categoria_nome',
						'categoria_pai_id',
						'categoria_ativa',

					), $this->input->post()
				);

				/*
				 * Definindo o meta link da categoria
				 */

				$data['categoria_meta_link'] = url_amigavel($data['categoria_nome']);

				$data = html_escape($data);
//					Antes de fazer atualização um debug

//					echo '<pre>';
//					print_r($data);
//					exit();

				$this->core_model->insert('categorias', $data);
				redirect('restrita/' . $this->router->fetch_class());

			} else {
				/*
				 * Erro de validação. Se não foi validado, colamos toda view
				 */

				$data = array(
					'titulo' => 'Cadastrar categoria',

					//Trazer o Select 2
					'styles' => array(
						'assets/bundles/select2/dist/css/select2.min.css',
					),

					'scripts' => array(
						'assets/bundles/select2/dist/js/select2.full.min.js',
					),


					//Para filtar o select, nesse caso retornando apenas categorias ativas
					'masters' => $this->core_model->get_all('categorias_pai', array('categoria_pai_ativa' => 1))
				);

				// Debug para confirmar se existe retorno dos dado vindo do banco de dado usuários
//					echo '<pre>';
//					print_r($data['categoria']);
//					exit();

				$this->load->view('restrita/layout/header', $data);
				$this->load->view('restrita/categorias/core');
				$this->load->view('restrita/layout/footer');
			}

		} else {
			//Se contém valor = VAMOS EDITAR

			/*
			 * Categoria foi informada, contudo devemos garantir sua existência na base de dado
			 */

			if (!$categoria = $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))) {//Pegar pelo id

				$this->session->set_flashdata('erro', 'Categoria não foi encontrada');

				redirect('restrita/' . $this->router->fetch_class());

			} else {
				/*
				 * Categoria foi enncotrada, passamos para as validações
				 */

				$this->form_validation->set_rules('categoria_nome', 'Nome da categoria', 'trim|required|min_length[4]|max_length[45]|callback_valida_nome_categoria');
				$this->form_validation->set_rules('categoria_pai_id', 'Categoria pai', 'trim|required');

				/*
				 * Verifico se o meu formulário foi validado
				 */

				if ($this->form_validation->run()) {


//					array
//					(
//						[categoria_nome] => Games
//						[categoria_classe_icone] => lni - game
//						[categoria_ativa] => 1
//    					[categoria_id] => 1
//					)

					$data = elements(

						array(
							'categoria_nome',
							'categoria_pai_id',
							'categoria_ativa',

						), $this->input->post()
					);

					/*
					 * Definindo o meta link da categoria
					 */

					$data['categoria_meta_link'] = url_amigavel($data['categoria_nome']);

					$data = html_escape($data);
//					Antes de fazer atualização um debug

//					echo '<pre>';
//					print_r($data);
//					exit();

					$this->core_model->update('categorias', $data, array('categoria_id' => $categoria->categoria_id));
					redirect('restrita/' . $this->router->fetch_class());

				} else {
					/*
					 * Erro de validação. Se não foi validado, colamos toda view
					 */

					$data = array(
						'titulo' => 'Editar categoria',
						'categoria' => $categoria, //(Objeto)Vou enviar o objeto categoria que recuperamos lá em cima da existência da base de dado

						//Trazer o Select 2
						'styles' => array(
							'assets/bundles/select2/dist/css/select2.min.css',
						),

						'scripts' => array(
							'assets/bundles/select2/dist/js/select2.full.min.js',
						),


						//Para filtar o select, nesse caso retornando apenas categorias ativas
						'masters' => $this->core_model->get_all('categorias_pai', array('categoria_pai_ativa' => 1))
					);

					// Debug para confirmar se existe retorno dos dado vindo do banco de dado usuários
//					echo '<pre>';
//					print_r($data['categoria']);
//					exit();

					$this->load->view('restrita/layout/header', $data);
					$this->load->view('restrita/categorias/core');
					$this->load->view('restrita/layout/footer');
				}
			}
		}


	}

	/*
	 * Serve para não serem repetidos
	 */
	public function valida_nome_categoria($categoria_nome)
	{
		//Recuperar se vei do meu post do categira_nome

		$categoria_id = $this->input->post('categoria_id');

		//Verificamos se contém valor
		if (!$categoria_id) {
			/*
			 * Cadastrando, não precisamos informar o id
			 */

			//Verificar no banco de dado se tenho uma categoria_nome existente lá
			if ($this->core_model->get_by_id('categorias', array('categoria_nome' => $categoria_nome))) {

				$this->form_validation->set_message('valida_nome_categoria', 'Esta categoria já existe');

				return false;

			} else {

				return true;
			}

			//Existe
		} else {

			/*
			 * Editando, precisamos informar o id
			 */

			//Verificar no banco de dado se tenho uma categoria_nome existente lá
			if ($this->core_model->get_by_id('categorias', array('categoria_nome' => $categoria_nome, 'categoria_id !=' => $categoria_id))) {

				$this->form_validation->set_message('valida_nome_categoria', 'Esta categoria já existe');

				return false;

			} else {

				return true;
			}

		}
	}

	public function delete($categoria_id = null)
	{

		$categoria_id = (int) $categoria_id;
		/*
		 * Verificar se ele veio do método/foi informado ou se existe no banco de dado
		 */

		if (!$categoria_id || !$categoria = $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))) {//Pegar pelo id

			$this->session->set_flashdata('erro', 'Categoria não foi encontrada');

			redirect('restrita/' . $this->router->fetch_class());

		}

		/*
		 * Não permitir que uma categoria ativa seja excluida
		 */

		if ($categoria->categoria_ativa == 1) {//Pegar pelo id

			$this->session->set_flashdata('erro', 'Não é permitido excluir uma categoria que esteja ativa');

			redirect('restrita/' . $this->router->fetch_class());

		}
		//Se passou por essas duas verificação chamamos o método

		$this->core_model->delete('categorias', array('categoria_id' => $categoria->categoria_id));

		redirect('restrita/' . $this->router->fetch_class());

	}
}
