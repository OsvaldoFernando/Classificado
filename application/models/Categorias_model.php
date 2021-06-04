<?php

defined('BASEPATH') or exit('Acesso proibido');

class Categorias_model extends CI_Model
{

	public function get_all_categorias()
	{
		//Consulta
		$this->db->select([

			'categorias.*', //Da tabela Categoria quero tudo
			'categorias_pai.categoria_pai_nome',  //Da tabela categorias_pai quero o campo da mesma categoria_pai_nome
		]);

		//JOIN
		$this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = categorias.categoria_pai_id'); //Nome da tabela que vou fazer o join. Ele recebe o id da categoria pai, esta é a coluna a ser referenciado

		//ORDENAR
		$this->db->order_by('categorias.categoria_id', 'DESC'); //Só para não repetir o registro
//		$this->db->order_by(1, 'DESC');

		return $this->db->get('categorias')->result(); //Retornando um array de objeto
	}
}
