<?php echo View::make('admin.header')->render() ?>
<?php if (!Auth::userCan('8')) page_restricted(); ?>

<h3 class="page-header">
	Especialidades
	<a href="?page=especialidades-new" class="btn btn-default btn-sm">Agregar Especialidad</a>
</h3>

<link href="<?php echo asset_url('css/vendor/dataTables.bootstrap.css') ?>" rel="stylesheet">
<script src="<?php echo asset_url('js/vendor/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/dataTables.bootstrap.js') ?>"></script>
<script>
	$(document).ready(function() {
		EasyLogin.options.datatables = <?php echo json_encode(trans('datatables')); ?>;
		EasyLogin.admin.especialidadesDT();
	});
</script>

<?php if (Session::has('marca_added')): ?>
	<div class="alert alert-success alert-dismissible">
		<span class="close" data-dismiss="alert">&times;</span>
		<?php _e('admin.marca_cremarcasated') ?>
		<a href="?page=categoria-edit&id=<?php echo Session::get('marca_id'); ?>" class="alert-link"><?php _e('admin.editumarca') ?></a>
	</div>
	<?php Session::deleteFlash(); ?>
<?php endif ?>

<?php if (!Config::get('auth.require_username')): ?>
	<style>#users tr th:nth-child(2) {display: none;}</style>
<?php endif; ?>

<form action="" method="POST" id="especialiades_form">
	<table class="table table-striped table-bordered table-hover table-dt" id="especialidades">
		<thead>
			<tr>
				<th><input type="checkbox" class="select-all" value="1"></th>
				<th><?php _e('categorias.header_id_padre') ?></th>
				<th><?php _e('categorias.header_nombre') ?></th>
				<th><?php _e('admin.action') ?></th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</form>

<!-- Delete marcas Modal -->
<div class="modal fade" id="deleteEspecialidadModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<form action="deleteEspecialidad" class="ajax-form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Confirme la accion</h4>
				</div>
				<div class="modal-body">
					<div class="alert"></div>
					<input type="hidden" name="categoria_id">
	          		<p><?php _e('admin.confirm_delete_categoria', array('categorias' => '<b class="categorias"></b>')) ?></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php _e('admin.no') ?></button>
					<button type="submit" class="btn btn-danger"><?php _e('admin.yes') ?></button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php echo View::make('admin.footer')->render() ?>