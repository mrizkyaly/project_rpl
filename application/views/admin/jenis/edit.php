<?php  
	// Notifikasi error
echo validation_errors('<div class="alert alert-warning">','</div>');

	// Form Open
echo form_open(base_url('admin/jenis/edit/' .$jenis->id_jenis), 'class="form-horizontal"');
?>

<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title"><?php echo $title ?></h3>
	</div>
	<form role="form">
		<div class="card-body">
			<div class="form-group">
				<label for="exampleInputEmail1">Jenisname</label>
				<input type="text" name="nama_jenis" class="form-control" placeholder="Nama Jenis" value="<?php echo $jenis->nama_jenis ?>" required>
			</div>
			<div class="form-group">
				<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
				<button type="reset" name="reset" class="btn btn-info"><i class="fa fa-times"></i> Reset</button>
			</div>
		</div>
	</form>
</div>

<?php echo form_close(); ?>