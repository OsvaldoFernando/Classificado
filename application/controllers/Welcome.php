<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function funcao()
	{
		echo 'Essa é a primeira função que vem do controller (welcome)';
	}
}
