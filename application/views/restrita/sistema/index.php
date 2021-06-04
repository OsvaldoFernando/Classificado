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

							<!-- Mensagem de sucesso-->
							<?php if ($mensagem = $this->session->flashdata('sucesso')): ?>

								<div class="alert alert-success text-white alert-dismissible show fade">
									<div class="alert-body">
										<button class="close" data-dismiss="alert">
											<span>&times;</span>
										</button>

										<!--										This is a success alert.-->
										<?php echo $mensagem; ?>

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
										<?php echo $mensagem; ?>

									</div>
								</div>

							<?php endif; ?>

							<!--	Formulário			-->
							<form method="post" name="form_index">

								<div class="card-header">
									<h4> <?php echo $titulo; ?></h4>
								</div>
								<div class="card-body">

									<div class="form-row">

										<div class="form-group col-md-4">
											<label>Razão social</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="sistema_razao_social"
													   value="<?php echo(isset($sistema) ? $sistema->sistema_razao_social : set_value('sistema_razao_social')); ?>">
											</div>
											<?php echo form_error('sistema_razao_social', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-4">
											<label>Nome fantasia</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-user text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="sistema_nome_fantasia"
													   value="<?php echo(isset($sistema) ? $sistema->sistema_nome_fantasia : set_value('sistema_nome_fantasia')); ?>">
											</div>
											<?php echo form_error('sistema_nome_fantasia', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group  col-md-4">
											<label>NIF</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-id-card text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="sistema_nif"
													   value="<?php echo(isset($sistema) ? $sistema->sistema_nif : set_value('sistema_nif')); ?>">
											</div>
											<?php echo form_error('sistema_nif', '<div class="text-danger">', '</div>'); ?>
										</div>

									</div>

									<div class="form-row">

										<div class="form-group col-md-4">
											<label>Telefone fixo</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-blender-phone text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="sistema_telefone_fixo"
													   value="<?php echo(isset($sistema) ? $sistema->sistema_telefone_fixo : set_value('sistema_telefone_fixo')); ?>">
											</div>
											<?php echo form_error('sistema_telefone_fixo', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-4">
											<label>Telefone móvel</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-phone text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="sistema_telefone_movel"
													   value="<?php echo(isset($sistema) ? $sistema->sistema_telefone_movel : set_value('sistema_telefone_movel')); ?>">
											</div>
											<?php echo form_error('sistema_telefone_movel', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-4">
											<label>AGT</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-bullseye text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="sistema_agt"
													   value="<?php echo(isset($sistema) ? $sistema->sistema_agt : set_value('sistema_agt')); ?>">
											</div>
											<?php echo form_error('sistema_agt', '<div class="text-danger">', '</div>'); ?>
										</div>

									</div>

									<div class="form-row">

										<div class="form-group col-md-4">
											<label>E-mail</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-envelope text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="sistema_email"
													   value="<?php echo(isset($sistema) ? $sistema->sistema_email : set_value('sistema_email')); ?>">
											</div>
											<?php echo form_error('sistema_email', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-4">
											<label>Título website</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-road text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="sistema_site_titulo"
													   value="<?php echo(isset($sistema) ? $sistema->sistema_site_titulo : set_value('sistema_site_titulo')); ?>">
											</div>
											<?php echo form_error('sistema_site_titulo', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-4">
											<label>CEP</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-directions text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="sistema_cep"
													   value="<?php echo(isset($sistema) ? $sistema->sistema_cep : set_value('sistema_cep')); ?>">
											</div>
											<?php echo form_error('sistema_cep', '<div class="text-danger">', '</div>'); ?>
										</div>

									</div>

									<div class="form-row">

										<div class="form-group col-md-2">
											<label>Número sistema</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-location-arrow text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="sistema_numero"
													   value="<?php echo(isset($sistema) ? $sistema->sistema_numero : set_value('sistema_numero')); ?>">
											</div>
											<?php echo form_error('sistema_numero', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-2">
											<label>Bairro</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-map-marker-alt text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="sistema_bairro"
													   value="<?php echo(isset($sistema) ? $sistema->sistema_bairro : set_value('sistema_bairro')); ?>">
											</div>
											<?php echo form_error('sistema_bairro', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-2">
											<label>Cidada - Sigla</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-city text-info"></i>
													</div>
												</div>
												<input type="text" class="form-control" name="sistema_cidade"
													   value="<?php echo(isset($sistema) ? $sistema->sistema_cidade : set_value('sistema_cidade')); ?>">
											</div>
											<?php echo form_error('sistema_cidade', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class="form-group col-md-6">
											<label>Província</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-road text-info"></i>
													</div>
												</div>

												<select class="custom-select" name="sistema_provincia">
													<option value="BE" <?php echo($sistema->sistema_provincia == 'BE' ? 'selected' : ''); ?>>
														Bengo
													</option>
													<option value="BA" <?php echo($sistema->sistema_provincia == 'BA' ? 'selected' : ''); ?>>
														Benguela
													</option>
													<option value="BI" <?php echo($sistema->sistema_provincia == 'BI' ? 'selected' : ''); ?>>
														Bié
													</option>
													<option value="CB" <?php echo($sistema->sistema_provincia == 'CB' ? 'selected' : ''); ?>>
														Cabinda
													</option>
													<option value="CN" <?php echo($sistema->sistema_provincia == 'CN' ? 'selected' : ''); ?>>
														Cunene
													</option>
													<option value="HO" <?php echo($sistema->sistema_provincia == 'HO' ? 'selected' : ''); ?>>
														Huambo
													</option>
													<option value="HU" <?php echo($sistema->sistema_provincia == 'HU' ? 'selected' : ''); ?>>
														Huíla
													</option>
													<option value="KK" <?php echo($sistema->sistema_provincia == 'KK' ? 'selected' : ''); ?>>
														Cuando Cubango
													</option>
													<option value="KN" <?php echo($sistema->sistema_provincia == 'KN' ? 'selected' : ''); ?>>
														Cuanza Norte
													</option>
													<option value="KS" <?php echo($sistema->sistema_provincia == 'KS' ? 'selected' : ''); ?>>
														Cuanza Sul
													</option>
													<option value="LA" <?php echo($sistema->sistema_provincia == 'LA' ? 'selected' : ''); ?>>
														Luanda
													</option>
													<option value="LN" <?php echo($sistema->sistema_provincia == 'LN' ? 'selected' : ''); ?>>
														Lunda Norte
													</option>
													<option value="LS" <?php echo($sistema->sistema_provincia == 'LS' ? 'selected' : ''); ?>>
														Lunda Sul
													</option>
													<option value="ME" <?php echo($sistema->sistema_provincia == 'ME' ? 'selected' : ''); ?>>
														Malanje
													</option>
													<option value="MO" <?php echo($sistema->sistema_provincia == 'MO' ? 'selected' : ''); ?>>
														Moxico
													</option>
													<option value="NB" <?php echo($sistema->sistema_provincia == 'NB' ? 'selected' : ''); ?>>
														Namibe
													</option>
													<option value="UE" <?php echo($sistema->sistema_provincia == 'UE' ? 'selected' : ''); ?>>
														Uíge
													</option>
													<option value="ZE" <?php echo($sistema->sistema_provincia == 'ZE' ? 'selected' : ''); ?>>
														Zaíre
													</option>

												</select>

											</div>
											<?php echo form_error('sistema_provincia', '<div class="text-danger">', '</div>'); ?>
										</div>

									</div>

								</div>

								<div class="card-footer">
									<button type="submit" class="btn btn-primary">Enviar</button>
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


