<?php

/*
 * Função que serão utilizada tanto na área público como na área privada
 */

defined('BASEPATH') or exit('Acesso proibido');

class Anuncios_model extends CI_Model
{
	/* Funçãoo que lista todos os anuncios do anunciante logado e também lista todos anuncios para área restrita*/

	public function get_all($user_id = null)
	{
		$this->db->select([
			'anuncios.*',
			'categorias.categoria_nome',
			'categorias_pai.categoria_pai_nome',
			'users.id',
			'users.first_name',
			'anuncios_fotos.foto_nome',
		]);

			/*
			 * Vou verificar se o meu usuário id foi informado ou veio
			 * se foi informado o $user_id retorna apenas os anuncios daqueles usuários (anaunciante)
			 */

		if ($user_id) {

			$this->db->where('anuncios.anuncio_user_id', $user_id); //anuncio_user_id é uma coluna da tabela anuncios e é chave estrangeira
		}

		/*
		 * Começo agora a fazer os Join, primeiro será de categoria PAi.
		 */

		$this->db->join('categorias', 'categorias.categoria_id = anuncios.anuncio_categoria_id', 'LEFT'); //Existe na tabela anuncios o campo ANUNCIO_CATEGORIA_ID
		$this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = categorias.categoria_pai_id', 'LEFT'); //Existe na tabela categoria o campo CATEGORIA_PAI_ID
		$this->db->join('anuncios_fotos', 'anuncios_fotos.foto_anuncio_id = anuncios.anuncio_id', 'LEFT'); //Existe na tabela anuncios o campo ANUNCIO_ID
		$this->db->join('users', 'users.id = anuncios.anuncio_user_id', 'LEFT'); //Existe na tabela anuncios o campo ANUNCIO_USER_ID

		$this->db->group_by('anuncios.anuncio_id'); //Para não repetir o registro

		return $this->db->get('anuncios')->result();

		/*
		 * Este módulo será utilizada em toda aplicação vamos carregar no autoload
		 */
	}
}

?>
