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
					<div class="col-12 col-md-12 col-lg-12">

						<div class="card">

							<!--	Formulário			-->
							<form method="post" name="form_core" accept-charset="utf-8" enctype="multipart/form-data">

								<div class="card-header">
									<h4> <?php echo $titulo; ?></h4>
								</div>
								<div class="card-body">

									<div class="form-row">

										<div class="form-group col-md-4">
											<label>Nome</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="first_name"
													   value="<?php echo(isset($usuario) ? $usuario->first_name : set_value('first_name')); ?>">
											</div>
											<?php echo form_error('first_name', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-8">
											<label>Sobrenome</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="last_name"
													   value="<?php echo(isset($usuario) ? $usuario->last_name : set_value('last_name')); ?>">
											</div>
											<?php echo form_error('last_name', '<div class="text-danger">', '</div>'); ?>
										</div>

									</div>

									<div class="form-row">

										<div class="form-group  col-md-4">
											<label>Bilhete</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-id-card text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="user_bilhete"
													   value="<?php echo(isset($usuario) ? $usuario->user_bilhete : set_value('user_bilhete')); ?>">
											</div>
											<?php echo form_error('user_bilhete', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-4">
											<label>Telefone</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-phone text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="phone"
													   value="<?php echo(isset($usuario) ? $usuario->phone : set_value('phone')); ?>">
											</div>
											<?php echo form_error('phone', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-4">
											<label>E-mail</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-envelope text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="email"
													   value="<?php echo(isset($usuario) ? $usuario->email : set_value('email')); ?>">
											</div>
											<?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
										</div>

									</div>

									<div class="form-row">

										<div class="form-group col-md-2">
											<label>Endereço</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-map-marker-alt text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="user_endereco"
													   value="<?php echo(isset($usuario) ? $usuario->user_endereco : set_value('user_endereco')); ?>">
											</div>
											<?php echo form_error('user_endereco', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-2">
											<label>Número endereço</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-road text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="user_numero_endereco"
													   value="<?php echo(isset($usuario) ? $usuario->user_numero_endereco : set_value('user_numero_endereco')); ?>">
											</div>
											<?php echo form_error('user_numero_endereco', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-4">
											<label>Bairro</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-directions text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="user_bairro"
													   value="<?php echo(isset($usuario) ? $usuario->user_bairro : set_value('user_bairro')); ?>">
											</div>
											<?php echo form_error('user_bairro', '<div class="text-danger">', '</div>'); ?>
										</div>


										<div class="form-group col-md-2">
											<label>Província</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-location-arrow text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="user_provincia"
													   value="<?php echo(isset($usuario) ? $usuario->user_provincia : set_value('user_provincia')); ?>">
											</div>
											<?php echo form_error('user_provincia', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-2">
											<label>Morada</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-city text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="user_cidade"
													   value="<?php echo(isset($usuario) ? $usuario->user_cidade : set_value('user_cidade')); ?>">
											</div>
											<?php echo form_error('user_cidade', '<div class="text-danger">', '</div>'); ?>
										</div>

									</div>

									<div class="form-row">

										<div class="form-group col-md-3">
											<label>Estado</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-check-circle text-info"></i>
													</div>
												</div>

												<select class="custom-select" name="active">

													<?php if (isset($usuario)): ?>

														<option value="0" <?php echo($usuario->active == 0 ? 'selected' : ''); ?>>
															Não
														</option>
														<option value="1" <?php echo($usuario->active == 1 ? 'selected' : ''); ?>>
															Sim
														</option>

													<?php else: ?>

														<option value="0">Não</option>
														<option value="1">Sim</option>

													<?php endif; ?>

												</select>

											</div>
											<?php echo form_error('active', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-3">
											<label>Perfil de acesso</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user-tie text-info"></i>
													</div>
												</div>

												<select class="custom-select" name="perfil">

													<?php foreach ($grupos as $grupo): ?>

														<?php if (isset($usuario)): ?>

															<option value="<?php echo $grupo->id; ?>" <?php echo($perfil->id == $grupo->id ? 'selected' : ''); ?>><?php echo $grupo->description; ?></option>

														<?php else: ?>

															<option value="<?php echo $grupo->id; ?>"><?php echo $grupo->description; ?></option>


														<?php endif; ?>

													<?php endforeach; ?>

												</select>

											</div>
											<?php echo form_error('perfil', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-3">
											<label>Senha</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-lock text-info"></i>
													</div>
												</div>
												<input type="password" class="form-control" name="password">
											</div>
											<?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-3">
											<label>Confirma senha</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-lock text-info"></i>
													</div>
												</div>
												<input type="password" class="form-control" name="confirma_senha">
											</div>
											<?php echo form_error('confirma_senha', '<div class="text-danger">', '</div>'); ?>
										</div>

									</div>

									<div class="form-row">

										<div class="form-group col-md-4.5">
											<label>Avatar</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-image text-info"></i>
													</div>
												</div>
												<input type="file" class="form-control" name="user_foto_file">
											</div>
											<?php echo form_error('user_foto', '<div class="text-danger">', '</div>'); ?>
											<div id="user_foto"></div>
										</div>

										<div class="form-group col-md-4">

											<?php if (isset($usuario)): ?>

												<div id="box-foto-usuario">

													<input type="hidden" name="user_foto"
														   value="<?php echo $usuario->user_foto; ?>">
													<img width="100" alt="Usuário image"
														 src="<?php echo base_url('uploads/usuarios/' . $usuario->user_foto); ?>"
														 class="rounded-circle">

												</div>

											<?php else: ?>

												<div id="box-foto-usuario">


												</div>

											<?php endif; ?>


											<?php if (isset($usuario)): ?>

												<input type="hidden" name="usuario_id"
													   value="<?php echo $usuario->id; ?>">

											<?php endif; ?>


										</div>

									</div>

								</div>

								<div class="card-footer">
									<button type="submit" class="btn btn-primary">Enviar</button>
									<a href="<?php echo base_url('restrita/' . $this->router->fetch_class()); ?>"
									   class="btn btn-dark">Voltar</a>
								</div>
						</div>




					</div>

					</form>
				</div>

			</div>


	</div>


</div>
</section>

<!-- Siderbar configurações -->
<?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>

</div>


