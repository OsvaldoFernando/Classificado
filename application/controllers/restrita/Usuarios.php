<?php

/*
 * Controller responsável por gerenciar os usuários
 */

defined('BASEPATH') or exit('Acesso proibido');

class Usuarios extends CI_Controller
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
		$data = array(
			'titulo' => 'Usuários cadastrados',

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

			'usuarios' => $this->ion_auth->users()->result(),
		);

		// Debug para confirmar se existe retorno dos dado vindo do banco de dado usuários
//		echo '<pre>';
//		print_r($data);
//		exit();

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/usuarios/index');
		$this->load->view('restrita/layout/footer');

	}

	public function core($usuario_id = null)
	{
		/*
		 * Esse método será responsável pela edição e criação de usuários
		 */

		$usuario_id = (int)$usuario_id;

		if (!$usuario_id) {
			/*
			 * Cadastra novo usuário
			 */

//				Validações
			$this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[3]|max_length[45]');
			$this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required|min_length[3]|max_length[45]');
			$this->form_validation->set_rules('user_bilhete', 'Bilhete', 'trim|required|exact_length[14]');
			$this->form_validation->set_rules('phone', 'Telefone', 'trim|required|min_length[8]|max_length[10]|callback_valida_telefone');
			$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|max_length[120]|callback_valida_email');
			$this->form_validation->set_rules('user_endereco', 'Endereço', 'trim|required|min_length[5]|max_length[45]');
			$this->form_validation->set_rules('user_numero_endereco', 'Número endereço', 'trim|max_length[45]');
			$this->form_validation->set_rules('user_bairro', 'Bairro', 'trim|required|min_length[3]|max_length[45]');
			$this->form_validation->set_rules('user_provincia', 'Província', 'trim|required|max_length[45]');
			$this->form_validation->set_rules('user_cidade', 'Morada', 'trim|required|min_length[4]|max_length[45]');
			$this->form_validation->set_rules('user_foto', 'Avatar', 'trim|required');

			//				No caso de edição de usuário não tornamos a senha obrigatório
			$this->form_validation->set_rules('password', 'Senha', 'trim|required|min_length[6]|max_length[200]');
			$this->form_validation->set_rules('confirma_senha', 'Connfirma senha', 'trim|matches[password]');

			if ($this->form_validation->run()) {
				/*
				 * perfeito formulário foi encontrado.... agora passamos para as validações
				 */

//				echo '<pre>';
//				print_r($this->input->post()); //Para saber tudo que vem do POST
//				exit();

				/*
				 * Prepara dados para ser enviado
				 */

				$username = $this->input->post('first_name') . '-' . $this->input->post('last_name');
				$password = $this->input->post('password');
				$email = $this->input->post('email');

				$additional_data = elements(
					array(
						'first_name',
						'last_name',
						'user_bilhete',
						'phone',
						'user_endereco',
						'user_numero_endereco',
						'user_bairro',
						'user_provincia',
						'user_cidade',
						'active',
						'user_foto',
					), $this->input->post()
				);

				$group = array($this->input->post('perfil')); // Sets user to admin.

//					Verificar se foi criado
				if ($this->ion_auth->register($username, $password, $email, $additional_data, $group)) {

					$this->session->set_flashdata('sucesso', 'Usuário criado com sucesso');

				} else {

					$this->session->set_flashdata('erro', $this->ion_auth->errors());

				}

				redirect('restrita/' . $this->router->fetch_class());


			} else {

				/*
				 * Erro de validação
				 */
				$data = array(
					'titulo' => 'Cadastrando usuário',

					'scripts' => array(
						'assets/mask/jquery.mask.min.js',
						'assets/mask/custom.js',
						'assets/js/usuarios.js',
					),

					'grupos' => $this->ion_auth->groups()->result(),
				);


//					echo '<pre>';
//					print_r($data);
//					exit();

				$this->load->view('restrita/layout/header', $data);
				$this->load->view('restrita/usuarios/core');
				$this->load->view('restrita/layout/footer');
			}

		} else {
			/*
			 * Verificar se o usuario_id existe no banco de dados
			 */
			if (!$usuario = $this->ion_auth->user($usuario_id)->row()) {

//				exit('Usuário não encontrado');
				$this->session->set_flashdata('erro', 'Usuário não foi encontrado'); // Quando for passado um id que não existe
				redirect('restrita/' . $this->router->fetch_class()); //Vai cair sempre no método index para renderizar

			} else {

//				exit('Sucesso... Usuário existe.');


//				Validações
				$this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[3]|max_length[45]');
				$this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required|min_length[3]|max_length[45]');
				$this->form_validation->set_rules('user_bilhete', 'Bilhete', 'trim|required|exact_length[14]');
				$this->form_validation->set_rules('phone', 'Telefone', 'trim|required|min_length[8]|max_length[10]|callback_valida_telefone');
				$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|max_length[120]|callback_valida_email');
				$this->form_validation->set_rules('user_endereco', 'Endereço', 'trim|required|min_length[5]|max_length[45]');
				$this->form_validation->set_rules('user_numero_endereco', 'Número endereço', 'trim|max_length[45]');
				$this->form_validation->set_rules('user_bairro', 'Bairro', 'trim|required|min_length[3]|max_length[45]');
				$this->form_validation->set_rules('user_provincia', 'Província', 'trim|required|max_length[45]');
				$this->form_validation->set_rules('user_cidade', 'Morada', 'trim|required|min_length[4]|max_length[45]');
				$this->form_validation->set_rules('user_foto', 'Avatar', 'trim|required');

				//				No caso de edição de usuário não tornamos a senha obrigatório
				$this->form_validation->set_rules('password', 'Senha', 'trim|min_length[6]|max_length[200]');
				$this->form_validation->set_rules('confirma_senha', 'Connfirma senha', 'trim|matches[password]');

				if ($this->form_validation->run()) {
					/*
					 * perfeito formulário foi encontrado.... agora passamos para as validações
					 */

					/*
			 * Array
				(
					[first_name] => Admin
					[last_name] => istrator
					[user_bilhete] => 002054351LA035
					[phone] => 926219731
					[email] => admin@admin.com
					[user_endereco] => Malanje
					[user_numero_endereco] => 09
					[user_bairro] => Maxinde
					[user_provincia] => ME
					[user_cidade] => Malanje
					[active] => 1
					[perfil] => 1
					[user_foto] => user-5.png
				)
			 */

					/*
					 * Prepara dados para ser enviado
					 */

					$data = elements(
						array(
							'first_name',
							'last_name',
							'password',
							'user_bilhete',
							'phone',
							'email',
							'user_endereco',
							'user_numero_endereco',
							'user_bairro',
							'user_provincia',
							'user_cidade',
							'active',
							'user_foto',
						), $this->input->post()

					);

					/*
					 * Remover do array data o password caso o mesmo não seja informado, pós não é obrigatório
					 */
					if (!$data['password']) {
						unset($data['password']);
					}

//					echo '<pre>';
//					print_r($data);
//					exit();
//

					/*
					 * Populamos o $id com o ID do objeto (é mais seguro)
					 */
					$id = $usuario_id;

					if ($this->ion_auth->update($id, $data)) {

						/*
						 * Atualizamos o grupo de acesso de usuário
						 */
						$perfil = (int)$this->input->post('perfil'); //Recuperar o grupo para ser adicionado ao novo grupo

						$this->ion_auth->remove_from_group(NULL, $id); //Remover o grupo de usuário

						$this->ion_auth->add_to_group($perfil, $id); //Adicionando ao novo grupo, passando o meu id do usuário


						$this->session->set_flashdata('sucesso', 'Usuário atualizado com sucesso');
					} else {
						$this->session->set_flashdata('erro', $this->ion_auth->errors());
					}

					redirect('restrita/' . $this->router->fetch_class());
				} else {

					/*
					 * Erro de validação
					 */
					$data = array(
						'titulo' => 'Editando usuário',

						'scripts' => array(
							'assets/mask/jquery.mask.min.js',
							'assets/mask/custom.js',
							'assets/js/usuarios.js',
						),

						'usuario' => $usuario,
						'perfil' => $this->ion_auth->get_users_groups($usuario->id)->row(),
						'grupos' => $this->ion_auth->groups()->result(),
					);


//					echo '<pre>';
//					print_r($data);
//					exit();

					$this->load->view('restrita/layout/header', $data);
					$this->load->view('restrita/usuarios/core');
					$this->load->view('restrita/layout/footer');
				}


			}
		}
	}

	public function upload_file()
	{
		$config['upload_path'] = './uploads/usuarios/';
		$config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg|JPEG';
		$config['encrypt_name'] = true;
		$config['max_size'] = 1048; //Max 1M
		$config['max_width'] = 500;
		$config['max_height'] = 500;
		$config['min_width'] = 350;
		$config['min_height'] = 340;

		/*
		 * Carregando a biblioteca upload e passando como parâmetro o $config
		 */
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('user_foto_file')) {

			$data = array(
				'erro' => 0,
				'foto_enviada' => $this->upload->data(),
				'user_foto' => $this->upload->data('file_name'),
				'mensagem' => 'Foto foi enviada com sucesso',
			);

			/*
			 * Criando uma cópia da imagem um pouco menor (resize)
			 */

			$config['image_library'] = 'gd2';
			$config['source_image'] = './uploads/usuarios/' . $this->upload->data('file_name');
			$config['new_image'] = './uploads/usuarios/small/' . $this->upload->data('file_name');
			$config['width'] = 300;
			$config['height'] = 280;

			$this->load->library('image_lib', $config);

			/*
			 * Verificando se houve erro no resize
			 */

			if (!$this->image_lib->resize()) {
				$data['erro'] = 3;
				$data['erro'] = $this->image_lib->display_errors('<span class="text-danger">', '</span>');
			}
		} else {

			/*
			 * Erro no upload da imagem
			 */

			$data = array(
				'erro' => 3,
				'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>'),
			);
		}
		echo json_encode($data);

	}

	public function valida_telefone($phone)
	{
		$usuario_id = $this->input->post('usuario_id');

		if (!$usuario_id) {
			/*
			 * Cadastrando
			 */

			if ($this->core_model->get_by_id('users', array('phone' => $phone))) {
				$this->form_validation->set_message('valida_telefone', 'Este telefone já existe');
				return false;

			} else {
				return true;
			}

		} else {
			/*
			 * Editando
			 */

			if ($this->core_model->get_by_id('users', array('phone' => $phone, 'id !=' => $usuario_id))) {

				$this->form_validation->set_message('valida_telefone', 'Este telefone já existe');

				return false;
			} else {
				return true;
			}
		}
	}

	public function valida_email($email)
	{
		$usuario_id = $this->input->post('usuario_id');

		if (!$usuario_id) {
			/*
			 * Cadastrando
			 */

			if ($this->core_model->get_by_id('users', array('email' => $email))) {
				$this->form_validation->set_message('valida_email', 'Este e-mail já existe');
				return false;

			} else {
				return true;
			}

		} else {
			/*
			 * Editando
			 */

			if ($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $usuario_id))) {

				$this->form_validation->set_message('valida_email', 'Este e-mail já existe');

				return false;
			} else {
				return true;
			}
		}
	}

	public function delete($usuario_id = NULL)
	{
		$usuario_id = (int)$usuario_id;

		/*
		 * Se não tem nenhum valor na variável $usuario_id ou tem um valor mais não existe no banco de dado ou não foi feito está consulta renderizamos na view
		 */
		if (!$usuario_id || !$usuario = $this->ion_auth->user($usuario_id)->row()) {
			$this->session->set_flashdata('erro', 'Usuário não foi encontrado');
			redirect('restrita/' . $this->router->fetch_class());
		}

		/*
		 * Usuário administrador não deve ser excluído
		 */
		if ($this->ion_auth->is_admin($usuario->id)) {
			$this->session->set_flashdata('erro', 'Não é permitido excluír um Administrador');
			redirect('restrita/' . $this->router->fetch_class());
		}

		/*
		 * Excluír usuário e a imagem na pasta upload
		 */
		if ($this->ion_auth->delete_user($usuario->id)) {//Exlusão do usuário

			/*
			 * Perfeito, excluímo usuário, passamos para exclusão das imagens do usuario directório upload/usuario
			 */
			/*


			 * Recuperamos o nome da imagem
			 */
			$user_foto = $usuario->user_foto;

			$imagem_grande = FCPATH . 'uploads/usuarios/' . $user_foto;
			$imagem_pequena = FCPATH . 'uploads/usuarios/small' . $user_foto;

			if (file_exists($imagem_grande)) {
				unlink($imagem_grande);
			}

			if (file_exists($imagem_pequena)) {
				unlink($imagem_pequena);
			}

			$this->session->set_flashdata('sucesso', 'Usuário excluído com sucesso');

		} else {
			/*
			 * Não foi possível excluír
			 */
			$this->session->set_flashdata('erro', $this->ion_auth->errors());
		}

		redirect('restrita/' . $this->router->fetch_class());

	}

	//	public function preenche_endereco()
//	{
//		if (!$this->input->is_ajax_request) {
//			exit('Ação não permitida');
//		}
//
//		$this->form_validation->set_rules('user_bilhete', 'Bilhete', 'trim|required|exact_length[14]');
//
//		$retorno = array();
//
//		if ($this->form_validation->run()) {
//			/*
//			 * Bilhete validado quanto ao seu formato
//			 * Passamos então para o inicio da requisição
//			 */
//
//		} else {
//
//			/*
//			 * Erros da validação
//			 */
//
//		}
//	}
}

