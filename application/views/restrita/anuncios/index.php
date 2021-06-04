<div class="main-wrapper main-wrapper-1">

	<!-- Navebar -->
	<?php $this->load->view('restrita/layout/navbar'); ?>

	<!-- Siderbar -->
	<?php $this->load->view('restrita/layout/siderbar'); ?>

	<!-- Main Content -->
	<div class="main-content">

		<section class="section">
			<div class="section-body">

				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header d-block">
								<h4><?php echo $titulo;?></h4>
							</div>
							<div class="card-body">

							<!-- Mensagem de sucesso-->
								<?php if ($mensagem = $this->session->flashdata('sucesso')): ?>

								<div class="alert alert-success text-white alert-dismissible show fade">
									<div class="alert-body">
										<button class="close" data-dismiss="alert">
											<span>&times;</span>
										</button>

<!--										This is a success alert.-->
										<?php echo $mensagem;?>

									</div>
								</div>


								<?php endif; ?>
								<!-- Mensagem de Erro-->

								<?php if ($mensagem = $this->session->flashdata('erro')): ?>

								<div class="alert alert-danger text-white alert-dismissible show fade">
									<div class="alert-body">
										<button class="close" data-dismiss="alert">
											<span>&times;</span>
										</button>

<!--										This is a danger alert.-->
										<?php echo $mensagem;?>

									</div>
								</div>

								<?php endif; ?>

								<div class="table-responsive">
									<table class="table table-striped data-table">
										<thead>
										<tr>
<!--											<th>Imagem</th>-->
											<th>Título</th>
											<th>Preço</th>
											<th>Categoria pai</th>
											<th>Categoria filha</th>
											<th>Publicado</th>
											<th class="nosort">Operações</th>
										</tr>
										</thead>
										<tbody>

										<?php foreach ($anuncios as $anuncio):?> <!-- masters é o que estamos enviando do nosso controlador -->

										<tr>
<!--											<td>--><?php //echo $anuncio->categoria_id;?><!--</td>-->
											<td><?php echo $anuncio->anuncio_titulo;?></td>
											<td><?php echo 'AOA '.number_format($anuncio->anuncio_preco, 2);?></td>
											<td><?php echo $anuncio->anuncio_categoria_pai_id;?></td>
											<td><?php echo $anuncio->anuncio_categoria_id;?></td>

											<td><?php echo ($anuncio->anuncio_publicado == 1 ? ' <div class="badge badge-success badge-shadow">Sim</div>' : ' <div class="badge badge-danger badge-shadow">Não</div>');?></td>

											<td>
												<a data-toggle="tooltip" data-placement="top" title="Editar" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/core/' . $anuncio->anuncio_id) ;?>" class="btn btn-primary mr-2"><i class="fas fa-edit"></i></a>

												<a data-toggle="tooltip" data-placement="top" title="Excluír" href="<?php echo base_url('restrita/' . $this->router->fetch_class() . '/delete/' . $anuncio->anuncio_id) ;?>" class="btn btn-warning delete" data-confirm="Tem certeza da exlusão do registro?"><i class="fas fa-trash"></i></a>
											</td>
										</tr>

										<?php endforeach;?>

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</section>

		<!-- Siderbar configurações -->
		<?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>

	</div>


