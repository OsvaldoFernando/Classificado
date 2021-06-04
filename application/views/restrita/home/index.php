<div class="main-wrapper main-wrapper-1">

	<!-- Navebar -->
	<?php $this->load->view('restrita/layout/navbar'); ?>

	<!-- Siderbar -->
	<?php $this->load->view('restrita/layout/siderbar'); ?>

	<!-- Main Content -->
	<div class="main-content">

		<section class="section">
			<div class="section-body">

				<h1>Home da área restrita</h1>

				<?php
				echo '<pre>';
				print_r($this->session->userdata()); //Quando deixas em branco sem parâmetro você printa tudo que existe na sessão
				echo '</pre>';
				?>

			</div>
		</section>

		<!-- Siderbar configurações -->
		<?php $this->load->view('restrita/layout/sidebar_configuracoes'); ?>

	</div>


