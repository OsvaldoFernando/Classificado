var App_usuarios = function () {


	var preenche_endereco = function () {

		$('[name=user_bilhete]').focusout(function () {

			// alert('usuario bilhete');

			var user_bilhete = $(this).val();

			alert(BASE_URL);

			$.ajax({

				type: 'post',
				url: BASE_URL + 'restrita/usuarios/preenche_endereco',
				dataType: 'json',
				data: {user_bilhete: user_bilhete},
				beforeSend: function () {

				//	Definir disable e apagar erros de validação

				},
				success: function (response) {

					alert(response.mensagem);
				},

				error: function (response) {

				}
			});

		});

	}

	var envia_imagem_usuario = function () {

		$(document).on('change', '[name="user_foto_file"]',function () {

			// Recuperando as propriedades da imagem
			var file_data = $('[name="user_foto_file"]').prop('files')[0];

			var form_data = new FormData();

			form_data.append('user_foto_file', file_data);


			$.ajax({

				type: 'post',
				url: BASE_URL + 'restrita/usuarios/upload_file',
				dataType: 'json',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,

				beforeSend: function () {

					//	Definir disable e apagar erros de validação
					$('#user_foto').html('');
				},
				success: function (response) {

					if (response.erro === 0) {

						$('#box-foto-usuario').html("<input type='hidden' name='user_foto' value='" + response.user_foto + "'> <img width='100' alt='Usuário image' src='" + BASE_URL + "/uploads/usuarios/small/" + response.user_foto + "' class='rounded-circle'>");
					} else {
						//Caso tiver erro no upload chamamos a mensagem que é um método do controlador
						$('#user_foto').html(response.mensagem);
					}

				},

			});

		});

	}

	return {


		// neste caso a função está sendo inicializado
		init: function () {
			preenche_endereco();
			envia_imagem_usuario();
		}
	}


}(); //Inicializar ao carregar a view

jQuery(document).ready(function () {

	$(window).keydown(function (event) {

		if (event.keyCode == 13) {

			event.preventDefault();
			return false;
		}
	});

	App_usuarios.init();

});

