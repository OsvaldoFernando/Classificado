<?php if ($this->router->fetch_class() != 'login'): ?>

	<footer class="main-footer">
		<div class="footer-left">
			<a href="templateshub.net">Templateshub</a></a>
		</div>
		<div class="footer-right">
		</div>
	</footer>

<?php endif; ?>


</div>
</div>
<!-- General JS Scripts -->
<script src="<?php echo base_url('public/restrita/'); ?>assets/js/app.min.js"></script>
<!-- JS Libraies -->
<!-- Page Specific JS File -->
<!-- Template JS File -->
<script src="<?php echo base_url('public/restrita/'); ?>assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="<?php echo base_url('public/restrita/'); ?>assets/js/custom.js"></script>
<script src="<?php echo base_url('public/restrita/'); ?>assets/js/util.js"></script>

<!--<script src="https://cdnj.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>-->

<script src="<?php echo base_url('public/'); ?>restrita/assets/bootbox/bootbox.min.js"></script>


<?php if (isset($scripts)): ?>

	<?php foreach ($scripts as $escript): ?>

		<script src="<?php echo base_url('public/restrita/' . $escript); ?>"></script>

	<?php endforeach; ?>

<?php endif; ?>

<script>

	//Chamando evento do Bootbox
	$('.delete').on("click", function (event) { //O nome da classe é o delete o nome do evento será on click

		event.preventDefault();

		//Chamando a url do botão confirma
		var redirect = $(this).attr('href'); //Recuperar a url que será requisitado quando clicar no botão de excluir

		bootbox.confirm({
			title: $(this).attr('data-confirm'),
			//Centralizar o modal
			centerVertical: true,
			message: "<p class='text-danger'> Esta operação não poderá ser revertida</p>",
			buttons: {
				confirm: {
					label: 'Sim. pode excluír',
					className: 'btn-danger'
				},
				cancel: {
					label: 'Não, cancelar',
					className: 'btn-primary'
				}
			},
			callback: function (result) {

				if (result) {
					window.location.href = redirect;
				}

			}
		});

	});


</script>

</body>


<!-- blank.html  21 Nov 2019 03:54:41 GMT -->
</html>
