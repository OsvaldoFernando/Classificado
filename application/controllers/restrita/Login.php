<?php

//Controller responsáel pela área de login do na área restrita/*administrativa

defined('BASEPATH') or exit('entrada proibida');

class Login extends CI_Controller
{
	public function index()
	{

		$data = array(
			'titulo' => 'Login na área restrita',
		);

		$this->load->view('restrita/layout/header');
		$this->load->view('restrita/login/index');
		$this->load->view('restrita/layout/footer');
	}

	public function auth()
	{
		/*
		 * Array
		(
			[email] => osvaldo@osvaldo.com
			[password] => 123456
			[remember] => on
		)
		 */


		$identity = $this->input->post('email');
		$password = $this->input->post('password');
		$remember = ($this->input->post('remember' ? TRUE : FALSE));

		if ($this->ion_auth->login($identity, $password, $remember)) {

			/*
			 * Só os com perfis de administrador
			 */
			if ($this->ion_auth->is_admin()) {
				redirect('restrita');
			} else {
				redirect('/');
			}
		} else {
			/*
			 * Erro de login
			 */
			$this->session->set_flashdata('erro', 'Verifique sua credenciais de acesso');
			redirect('restrita/' . $this->router->fetch_class());
		}

	}

	public function logout()
	{
		/*
		 * Encerramos a sessão do usuário
		 */
		$this->ion_auth->logout();

		//Chamar de novo o formulário de login
		redirect('restrita/' . $this->router->fetch_class());

	}
}
